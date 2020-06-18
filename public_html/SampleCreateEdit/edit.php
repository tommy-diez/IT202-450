<html>
    <head>
    </head>
    <body>
    <h1>Edit Product</h1>
        <form method ="POST">
            <label for="id">Product ID: </label>
            <input type="text" name="id">
            <label for="product_name">Edit Product Name: </label>
            <input type="text" name="product_name">
            <label for="quantity">Edit Quantity: </label>
            <input type="number" name="quantity">
            <label for="price">Edit Price: </label>
            <input type="text" name="price">
            <label for="description">Edit Description: </label>
            <input type="text" name="description">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>


<?php
if (isset($_POST["submit"])) {
    require("common.inc.php");

    $name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    $db = getDB();
    $query = "UPDATE Products
          SET name= :name, quantity = :name, price= :price, description = :description
          WHERE id = :id";


    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':description', $description);
    $stmt->execute();
    $e = $stmt->errorInfo();
    if($e[0] != "00000"){
        var_export($e, true);
    }
    else {
        echo "Successfully updated record";
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo var_export($result, true);
}
?>


