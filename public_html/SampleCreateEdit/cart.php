<?php
if (isset($_POST['add_cart_submit'])){
    session_start();
    $userID = $_SESSION['user']['id'];
    $productID= $_POST['add_cart'];
    $quantity = $_POST['cart_quantity'];
    $db = getDB();

    $query = "
              UPDATE Products
              SET quantity = quantity-:quantity
              WHERE id = :id;
              
              INSERT INTO Cart
              VALUES(:id, :quantity, :userID);";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $productID);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    header('Location: list.php');


}

