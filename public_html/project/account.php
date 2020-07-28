<?php
include_once(__DIR__ . "/partial-pages/header.php");
if(Common::is_logged_in()){

}

?>

<h1>Welcome, <?php echo $_SESSION['user']['first_name']; ?></h1>
<h1>View your previous purchases below</h1>
<br>
<a href="edit_account.php"><h2>Would you like to edit your account?</h2></a>

<?php
$results = DBH::getPreviousOrders($_SESSION['user']['id']);
?>

<?php if (!empty($results)): ?>

<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Date</th>
        <th>Total</th>
    </tr>
    <?php foreach ($results as $row): ?>
        <tr>
            <td>
                <?php echo Common::get($row, "OrderID"); ?>
            </td>
            <td>
                <?php echo Common::get($row, "productID"); ?>
            </td>
            <td>
                <?php echo Common::get($row, "quantity"); ?>
            </td>
            <td>
                <?php echo Common::get($row, "price"); ?>
            </td>
            <td>
                <?php echo Common::get($row, "created");?>
            </td>
            <td>
                <?php echo Common::get($row, "paidTotal"); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else:
Common::flash('No previous orders');
?>

<?php endif; ?>