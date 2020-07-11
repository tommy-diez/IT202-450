<?php
$id = $_GET['id'];
include 'header.php';
include 'common.inc.php';
//session_start();
 ?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action ="edit_cart.php" method="POST">
    <label for="product">Product ID</label>
    <input id="product" type="number" name="product">
    <br>
    <label for="quantity">Quantity</label>
    <input id="quantity" type="number"  name="quantity">
    <br>
    <input name="submit" type="submit" value="SUBMIT">
</form>
</body>
</html>

<?php
$orderID = $_GET['id'];
//$userID = $_SESSION['user']['id'];
$newProductID = $_POST['product'];
$quantity = $_POST['quantity'];
//echo $productID;
echo $orderID;
echo $newProductID;
echo $quantity;
//modifyCart($orderID, $quantity, $newProductID);
//header('Location:index.php');
?>

