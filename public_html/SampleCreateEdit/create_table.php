<?php
?>
<html>
    <head>
    </head>
    <body>
        <form method="POST">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" required>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity">
            <label for="price"></label>
            <input type="text" name="price" required>
            <label for="description"></label>
            <input type="text" name="description">
            <input type="submit">
        </form>
    </body>
</html>

<?php
require("common.inc.php");

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$description = $_POST['description'];


$db = getDB();
$query = "INSERT INTO `Products`(name, quantity, price, description) 
            VALUES(product_name, quantity, price, description)";
$stmt = $db->prepare($query);
$stmt->bindValue(':product_name', $product_name);
$stmt->bindValue(':quantity', $quantity);
$stmt->bindValue(':price', $price);
$stmt->bindValue(':description', $description);
$stmt->execute();


?>


