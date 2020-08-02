<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()){

}
if (Common::getUserRole()){

}

?>

<h1>Welcome admin, add a product below: </h1>
<form method="POST">
    <label for="product_name">Product Name</label>
    <br>
    <input id="product_name" type="text" name="product_name" required>
    <br>
    <label for="quantity">Quantity</label>
    <br>
    <input id="quantity" type="number" name="quantity">
    <br>
    <label for="price">Price</label>
    <br>
    <input id="price" type="text" name="price" required>
    <br>
    <label for="description">Description</label>
    <br>
    <input id="description" type="text" name="description">
    <br>
    <input type="submit" name="add_product" value="Submit">
    <br>
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
$filter = 'created';
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
}
$sort = 'ASC';
if(isset($_POST['sort'])){
    $sort = $_POST['sort'];
}
$search = '';
if(isset($_POST['search'])){
    $search = $_POST['search'];
}
$orders = DBH::getAllOrders($filter, $sort, $search);
?>

<?php if(!empty($orders)) : ?>
<br>
    <html>
    <form method="POST">
        <label for="sort">Sort: </label>
        <select id="sort" name="sort">
            <option value="ASC">Lowest to Highest</option>
            <option value="DESC">Highest to Lowest</option>
        </select>
        <label for="by">Filter: </label>
        <select id="by"name="filter">
            <option value="price">Price</option>
            <option value="quantity">Quantity</option>
            <option value="name">Name</option>
        </select>
        <label for="search" >Search: </label>
        <input id="search" type="text" name="search" placeholder="SEARCH" value="<?php echo $search; ?>">
        <input type="submit" name="sort" value="SORT">
    </form>
    </html>
<br>
<table border="2">
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
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?php echo Common::get($order, "OrderID"); ?></td>
        <td><?php echo Common::get($order, "productID"); ?></td>
        <td><?php echo Common::get($order, "quantity"); ?></td>
        <td><?php echo Common::get($order, "price"); ?></td>
        <td><?php echo Common::get($order, "created"); ?></td>
        <td><?php echo Common::get($order, "modified"); ?></td>
        <td><?php echo Common::get($order, "userID"); ?></td>
        <td><?php echo Common::get($order, "paidTotal"); ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <?php echo DBH::getProfit(); ?>
    </tr>

</table>

<?php else: ?>
<p>No orders at this time</p>

<?php endif; ?>



