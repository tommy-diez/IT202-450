<?php
if (Common::is_logged_in()){

}
include_once(__DIR__ . "/partial-pages/header.php");
$cart = DBH::getCart($_SESSION['user']['id']);
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
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php else: echo "<div>Cart is Empty</div>"; ?>

<?php endif; ?>
