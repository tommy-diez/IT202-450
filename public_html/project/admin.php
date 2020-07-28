<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()){

}
$admin = DBH::isUserAdmin($_SESSION['user']['id']);
if(!$admin){
    Common::flash("Access denied");
    header('Location: home.php');
}
?>

<?php if(isset($results) && !empty($results)): ?>
<h1>Welcome admin, add a product below: </h1>
<form method="POST">
    <label for="product_name">Product Name</label>
    <input id="product_name" type="text" name="product_name" required>
    <label for="quantity">Quantity</label>
    <input id="quantity" type="number" name="quantity">
    <label for="price">Price</label>
    <input id="price" type="text" name="price" required>
    <label for="description">Description</label>
    <input id="description" type="text" name="description">
    <input type="submit" name="add_product" value="Submit">
</form>
<br>

<h1>Update an existing product: </h1>
<?php endif; ?>
<?php
$products = DBH::getAllProducts();
?>

<?php if(isset($products) && !empty($products)): ?>
    <?php foreach ($products as $product): ?>
        <tr>
            <td>
                <?php echo Common::get($product, "id"); ?>
            </td>
            <td>
                <?php echo Common::get($product, "name"); ?>
            </td>
            <td>
                <?php echo Common::get($product, "quantity"); ?>
            </td>
            <td>
                <?php echo Common::get($product, "price"); ?>
            </td>
            <td>
                <?php echo Common::get($product, "description");?>
            </td>
            <td>
                <form method="POST" action="edit_product.php">
                    <input type="hidden" name="id" value="<?php echo Common::get($product, "id"); ?>">
                    <input type="submit" name="update" value="EDIT">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(isset($_POST['add_product']) && !empty($_POST['add_product']))
{
    DBH::createItem($_POST['product_name'], $_POST['quantity'], $_POST['price'], $_POST['description']);
}
?>


