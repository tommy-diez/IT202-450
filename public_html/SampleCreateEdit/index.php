<?php
include('header.php');

?>
<html>
    <link rel="stylesheet" href="style.css">
    <body>
    <h1>Welcome to our ECommerce Platform</h1>
    <br>
    <h2><?php echo "Welcome, " . $_SESSION["user"]["first_name"]; ?></h2>
    <br>
    </body>
</html>

<?php
require('common.inc.php');
session_start();

$query = file_get_contents(__DIR__ . "/queries/SELECT_ALL_TABLE_ASC.sql");
if (isset($query) && !empty($query)){
    try{
        $db = getDB();
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
            <?php echo get($row, "id"); ?>
        </td>
        <td>
            <?php echo get($row, "name"); ?>
        </td>
        <td>
            <?php echo get($row, "quantity"); ?>
        </td>
        <td>
            <?php echo get($row, "price"); ?>
        </td>
        <td>
            <?php echo get($row, "description");?>
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
  $cart = getCart($_SESSION['user']['id']);
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
            <?php echo get($item, 'productID'); ?>
        </td>
        <td>
            <?php echo get($item, 'quantity'); ?>
        </td>
        <td>
            <?php echo get($item, 'userID'); ?>
        </td>
        <td>
            <a href="edit_cart.php?id=<?php echo get($item, 'userID');?>">Edit Cart</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php else: echo "<div>Cart is Empty</div>"; ?>

<?php endif; ?>


