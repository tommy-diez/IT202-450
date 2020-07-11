<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $productID = $_POST['product'];
    $quantity = $_POST['quantity'];
    echo $id;
    echo $productID;
    echo $quantity;
    modifyCart($id, $quantity, $productID);
    header('Location:index.php');
}
?>

