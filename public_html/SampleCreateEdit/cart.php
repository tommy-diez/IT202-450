<?php
    if (isset($_POST['add_cart_submit'])) {
        require 'common.inc.php';
        session_start();
        $orderID = $_SESSION['orderID'];
        $userID = $_SESSION['user']['id'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];
        echo $orderID;
        echo $userID;
        echo $productID;
        echo $quantity;
        $db = getDB();
        $query = "
              UPDATE Products
              SET quantity = quantity - :quantity
              WHERE id = :id;
              
              INSERT INTO Cart(orderID, productID, quantity, userID)
              VALUES(:orderID, :id, :quantity, :userID);";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $productID);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':orderID', $orderID);
        $stmt->execute();
        $e = $stmt->errorInfo();
        if ($e[0] != "00000") {
            echo var_export($e, true);
        } else {
            echo "Value successfully inserted";
            //header('Location: list.php');
        }

    }
    else{
        echo "Invalid Request";
    }

