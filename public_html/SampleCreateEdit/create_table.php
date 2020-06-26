<?php
?>
<html>
    <head>
    </head>
    <body>
    <script src="js/validate_form.js"></script>
        <form method="POST" onsubmit="validate()">
            <label for="product_name">Product Name</label>
            <input id="product_name" type="text" name="product_name" required>
            <label for="quantity">Quantity</label>
            <input id="quantity" type="number" name="quantity">
            <label for="price">Price</label>
            <input id="price" type="text" name="price" required>
            <label for="description">Description</label>
            <input id="description" type="text" name="description">
            <input type="submit" name="submit" value ="Submit">
        </form>
    </body>
</html>

<?php
if(isset($_POST['submit'])) {

    require("common.inc.php");


    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];


    $db = getDB();
    $query = "INSERT INTO Products (name, quantity, price, description) 
            VALUES(:product_name, :quantity, :price, :description)";
    $stmt = $db->prepare($query);

    $stmt->bindValue(':product_name', $product_name);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':description', $description);
    $stmt->execute();
    $e = $stmt->errorInfo();
    if ($e[0] != "00000"){
        echo var_export($e, true);
    }
    else {
        echo "Successfully inserted product";
    }
}

?>