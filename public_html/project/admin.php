<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()){

}
if (Common::getUserRole()){

}
$filter = 'created';
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
}
$sort = 'ASC';
if(isset($_POST['sort'])){
    $sort = $_POST['sort'];
}
?>

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

<?php $products = DBH::getAllProducts();
?>

<?php if(isset($products) && !empty($products)): ?>
    <table border="2">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Description</th>
        <th>EDIT</th>
        <th>DELETE</th>
    </tr>
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
            <td>
                <form method="POST" action="delete_product.php">
                    <input type="hidden" name="id" value="<?php echo Common::get($product, "id"); ?>">
                    <input type="submit" name="delete" value="DELETE">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
  
<?php endif; ?>

<?php if(isset($_POST['add_product']) && !empty($_POST['add_product']))
{
    $results = DBH::createItem($_POST['product_name'], $_POST['quantity'], $_POST['price'], $_POST['description']);
    if($results) {
        Common::flash('Product successfully created');
        header('Location: admin.php');
    }
    else{
        Common::flash('Failed to add product');
        header('Location: admin.php');
    }
}
?>

<?php
$orders = DBH::getAllOrders($filter, $sort);
?>
<html>
    <form method="POST">
        <label for="filter">Filter: </label>
        <input id="filter" type="text" name="filter">
        <label for="sort">Sort: </label>
        <input id="sort" type="text" name="sort">
        <input type="submit" name="sort" value="SORT">
    </form>
</html>

<?php if(!empty($orders)) : ?>
<br>
<table>
    <?php foreach ($orders as $order): ?>
    <tr>
        <th>OrderID</th>
        <th>productID</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Created</th>
        <th>Modified</th>
        <th>UserID</th>
        <th>PaidTotal</th>
    </tr>
    <tr>
        <td><?php echo Common::get($order, "orderID"); ?></td>
        <td><?php echo Common::get($order, "productID"); ?></td>
        <td><?php echo Common::get($order, "Quantity"); ?></td>
        <td><?php echo Common::get($order, "Price"); ?></td>
        <td><?php echo Common::get($order, "Created"); ?></td>
        <td><?php echo Common::get($order, "Modified"); ?></td>
        <td><?php echo Common::get($order, "UserID"); ?></td>
        <td><?php echo Common::get($order, "PaidTotal"); ?></td>
    </tr>
    <tr>
        <p><?php echo DBH::getProfit(); ?></p>
    </tr>
    <?php endforeach; ?>
</table>

<?php else: ?>
<p>No orders at this time</p>

<?php endif; ?>



