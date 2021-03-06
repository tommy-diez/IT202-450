<?php
include_once(__DIR__ . "/partial-pages/header.php");
if(Common::is_logged_in()){

}

?>
<h1>Welcome, <?php echo $_SESSION['user']['first_name']; ?></h1>
<h1>View your previous purchases below</h1>
<br>

<?php
$results = DBH::getPreviousOrders($_SESSION['user']['id']);
$account = DBH::getUserInfo($_SESSION['user']['id']);
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
<?php if (!empty($account)): ?>
<br>
<h2>Edit your account below</h2>
    <form method="POST">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo Common::get($account, "email"); ?>">
        <label for="first_name">First Name</label>
        <input id="first_name" type="text" name="first_name" value="<?php echo Common::get($account, "first_name"); ?>">
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" name="last_name" value="<?php echo Common::get($account, "last_name"); ?>">
        <input type="submit" name="edit_account" value="SUBMIT">
    </form>
<br>
<a href="edit_account.php?id=<?php echo $_SESSION['user']['id']; ?>">Would you like to reset your password? </a>
<?php if(!empty($_POST['edit_account'])){
        $result = DBH::updateUserInfo($_POST['email'], $_POST['first_name'], $_POST['last_name'], $_SESSION['user']['id'], );
        if($result){
            Common::flash('Account updated successfully');
            header('Login: account.php');
        }
        else {
            Common::flash('Failed to update');
            header('Login: account.php');
        }
    }

?>
<?php else:
Common::flash('No previous orders');
?>

<?php endif; ?>
