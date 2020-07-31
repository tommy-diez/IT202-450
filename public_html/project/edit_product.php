<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()) {

}
if (Common::getUserRole()) {

}
if(isset($_POST['update'])):
    $id = $_POST['id'];
    $results = DBH::getProductInfo($id);

    ?>


    <h1>Edit the product below</h1>
    <form method="POST">
        <label for="product_name">Product Name</label>
        <input id="product_name" type="text" name="product_name" value="<?php Common::get($results, "name"); ?>">
        <br>
        <label for="quantity">Quantity</label>
        <input id="quantity" type="number" name="quantity" value="<?php echo Common::get($results, "quantity"); ?>">
        <br>
        <label for="price">Price</label>
        <input id="price" type="text" name="price" required value="<?php echo Common::get($results, "price"); ?>">
        <br>
        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="<?php echo Common::get($results, "description"); ?>">
        <br>
        <input type="submit" name="edit" value="Submit">
    </form>
    <br>
    <?php else:
    Common::flash("Invalid Request");
    header('Location: home.php');
    ?>
    <?php endif; ?>
    <?php if(isset($_POST['edit'])){
        $name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $result = DBH::editProduct($name, $quantity, $price, $description);
        if($result){
            Common::flash('Product updated successfully');
            header('Location: admin.php');
        }
        else {
            Common::flash('Failed to update product');
            header('Location: admin.php');
        }
    }

    ?>

