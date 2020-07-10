<?php
include 'header.php';
include 'common.inc.php';
session_start();
 ?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<form action ="edit_cart.php" method="post"">
    <input type = "number" name="productID" value = "<?php echo $task['message'];?>">
    <input type = "number" id="duedate" name = "duedate" value = "<?php echo $task['duedate'];?>">Change DueDate
    <input type = submit>
</form>
</html>

<?php

if (isset($_POST['submit'])) {
    if (isset($_GET['id'])) {
        include 'common.inc.php';
        $productID = $_GET['id'];
        $userID = $_SESSION['user']['id'];
        $newProductID = $_POST['product'];
        $quantity = $_POST['quantity'];
        modifyCart($productID, $newProductID, $quantity);
        header('Location:index.php');
    }
}

?>