<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $productID = $_POST['product'];
    $quantity = $_POST['quantity'];
    /*
    echo $id;
    echo $productID;
    echo $quantity;
    */
    modifyCart($id, $quantity, $productID);
    $e = $stmt->errorInfo();
    if ($e[0] != "00000"){
        echo var_export($e, true);
    }
    header('Location:index.php');
}


