<?php
require("common.inc.php");


$db=getDB();
$id = -1;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM Products WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

}
else{
    echo "No id provided in url";
}

?>

<html>
    <head>
    </head>
    <body>
        <h1>Edit Product</h1>
        <form method ="POST">
            <label for="product_name">Edit Product Name: </label>
            <input type="text" name="product_name" value="<?php echo get($product, 'name'); ?>">
            <label for="quantity">Edit Quantity: </label>
            <input type="number" name="quantity" value="<?php echo get($product, 'quantity'); ?>">
            <label for="price">Edit Price: </label>
            <input type="text" name="price" value="<?php echo get($product, 'price'); ?>">
            <label for="description">Edit Description: </label>
            <input type="text" name="description" value="<?php echo get($product, 'description'); ?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>


<?php
if (isset($_POST["submit"])) {
    $name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $id = $_GET['id'];
    if (!empty($name) && !empty($quantity) && !empty($price) && !empty($description)) {
        $db = getDB();
        $query = "UPDATE Products
          SET name= :name, quantity = :quantity, price= :price, description = :description
          WHERE id = :id";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':description', $description);
        $stmt->execute();
        $e = $stmt->errorInfo();
        if ($e[0] != "00000") {
            var_export($e, true);
        } else {
            echo "Successfully updated record";
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            //echo var_export($result, true);
            //header("Location: edit.php?id=$id");
        }
    }
    else {
        echo "Leave no field empty";
    }
}
?>


