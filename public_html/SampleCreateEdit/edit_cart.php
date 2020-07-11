<?php
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
    modifyCart($id, $quantity, $productID);
    header('Location: index.php');
}
else {
    echo "<h1>Invalid Request</h1>";
}

