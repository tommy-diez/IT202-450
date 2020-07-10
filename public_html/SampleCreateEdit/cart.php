<?php
    if (isset($_POST['cart'])) {
        require 'common.inc.php';
        session_start();
        $userID = $_SESSION['user']['id'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];

        $db = getDB();
        $query = "
              UPDATE Products
              SET quantity = quantity - :quantity
              WHERE id = :id;
              
              INSERT INTO Cart(productID, quantity, userID)
              VALUES(:id, :quantity, :userID);";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $productID);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $e = $stmt->errorInfo();
        if ($e[0] != "00000") {
            echo var_export($e, true);
        } else {
            echo "Value successfully inserted";
            header('Location: index.php');
        }

    }
    else{
        echo "Invalid Request";
    }

