<?php
include_once(__DIR__ . "/partial-pages/header.php");
if (Common::is_logged_in()){

}
$cart = $_SESSION['cart'];
var_dump($cart);
?>
<?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
<br>
<h3>Cart</h3>
<table border="1">
    <tr>
        <th>Product</th>
        <th>Quantity</th>
    </tr>
    <?php foreach ($_SESSION['cart'] as $item): ?>
    <tr>
        <td>
            <?php echo Common::get($item, 'item_id'); ?>
        </td>
        <td>
            <?php echo Common::get($item, 'quantity'); ?>
        </td>
        <td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php else: echo "<div>Cart is Empty</div>"; ?>

<?php endif; ?>
