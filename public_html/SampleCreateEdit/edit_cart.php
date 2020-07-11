<?php
include('header.php');
include 'common.inc.php';
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $productID = $_POST['product'];
    $quantity = $_POST['quantity'];
    $db = getDB();
    echo $id;
    echo $productID;
    echo $quantity;
    //var_export($db, true);
    $query = "
UPDATE
   Cart
SET
   productID = :newProductID, quantity = :quantity
WHERE
   orderID = :orderID";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':newProductID', $productID);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':orderID', $id);
    $e = $stmt->errorInfo();
    if ($e[0] != "00000"){
        echo var_export($e, true);
    }
    else{
        echo "Successfully updated cart";
        header('Location: index.php');
    }
    //header('Location: index.php');
}
else {
    echo "<h1>Invalid Request</h1>";
}

