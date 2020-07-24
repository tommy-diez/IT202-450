<?php
include_once(__DIR__ . "/partial-pages/header.php");
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
if(Common::is_logged_in()){

}
?>
<div>
    <h1>Welcome to our ECommerce Site, <?php echo $_SESSION['user']['first_name']; ?></h1>
</div>
<?php
$db = $common->getDB();
var_dump($db);
$query = file_get_contents(__DIR__ . "/sql/queries/select_cart.sql");
if (isset($query) && !empty($query)){
    try{
        $db = $common->getDB();
        var_dump($db);
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
else{
    echo "No query";
}

?>

<?php if(isset($results)): ?>
    <h3>Products</h3>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product</th>
            <th>In Stock</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td>
                    <?php echo Common::get($row, "id"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "name"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "quantity"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "price"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "description");?>
                </td>
                <td>
                    <a href="order.php">Place an Order!</a>
                </td>
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="productID" value="<?php echo get($row, "id"); ?>">
                        <label for="number">How many?</label>
                        <input id="number" type="number" name="quantity">
                        <input type="submit" name="cart" value="ADD TO CART">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No products available at this time, sadly</p>
<?php endif; ?>

<?php
$cart = Common::getCart($_SESSION['user']['id']);
?>
<?php if(isset($cart) && !empty($cart)): ?>
    <br>
    <h3>Cart</h3>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>UserID</th>
        </tr>
        <?php //var_export($cart) ?>
        <?php foreach ($cart as $item): ?>
            <tr>
                <td>
                    <?php echo Common::get($item, 'productID'); ?>
                </td>
                <td>
                    <?php echo Common::get($item, 'quantity'); ?>
                </td>
                <td>
                    <?php echo Common::get($item, 'userID'); ?>
                </td>
                <td>
                    <form method="POST" action="edit_cart.php">
                        <input id="id" type="hidden" name="id" value="<?php echo get($item, 'orderID'); ?>">
                        <label for="product">Product ID</label>
                        <input id="product" type="number" name="product">
                        <br>
                        <label for="quantity">Quantity</label>
                        <input id="quantity" type="number"  name="quantity">
                        <br>
                        <input type="submit" name="submit" value="EDIT CART">
                    </form>
                    <!--<a href="edit_cart.php?id=<?php //echo get($item, 'orderID');?>">Edit Cart</a> !-->
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php else: echo "<div>Cart is Empty</div>"; ?>

<?php endif; ?>

