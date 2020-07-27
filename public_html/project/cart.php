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
    <?php
    $i = 0;
    foreach ($_SESSION['cart'] as $item):?>
    <tr>
        <td>
            <?php echo Common::get($item, 'item'); ?>
        </td>
        <td>
            <?php echo Common::get($item, 'quantity'); ?>
        </td>
        <td>
            <form method="POST">
                <label for="new_quantity">How many?: </label>
                <input id="new_quantity" type="number" name="new_quantity">
                <input type="hidden" name="array_id" value="<?php echo $i ?>">
                <input type="submit" name="submit" value="CHANGE QUANTITY">
            </form>
        </td>
        <td>
            <form method="POST">
                <input type="hidden" name="array_id" value="<?php echo $i ?>">
                <input type="hidden" name="product_id" value="<?php Common::get($item, "id"); ?>">
                <input type="submit" name="delete" value="delete">
            </form>
        </td>
    </tr>
    <?php
    $i++;
    endforeach; ?>
    <form method="POST">
        <input type="submit" name="empty" value="EMPTY">
    </form>
</table>
<br>
<form method="POST">
    <input type="submit" name="order" value="PLACE ORDER">
</form>
<?php if(isset($_POST['submit']) && !empty($_POST['submit'])){
        $i = $_POST['array_id'];
        $quantity = $_POST['new_quantity'];
        Common::editCart($i, $quantity);
    }

    if(isset($_POST['empty']) && !empty($_POST['empty'])){
        Common::emptyCart();
    }

    if(isset($_POST['delete']) && !empty($_POST['delete'])){
        $i = $_POST['array_id'];
        $product_id = $_POST['product_id'];
        Common::deleteItem($i);
    }

    if(isset($_POST['order']) && !empty($_POST['order'])){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_order_id.sql");
            $stmt = $common->getDB()->prepare($query);
            $result = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $max = (int)$result["max"];
            $max += 1;
            $userID = $_SESSION['user']['id'];
            $paidTotal = Common::getPaidTotal($_SESSION['cart']);
            foreach ($_SESSION['cart'] as $item) {
                $id = Common::get($item, "id");
                $product_name = Common::get($item, "item");
                $price = Common::get($item, "price");
                $quantity = Common::get($item, "quantity");
                $result = DBH::placeOrder($max, $id, $quantity, $price, $userID, $paidTotal);
                if ($result) {
                    Common::flash('Order placed successfully');
                    Common::emptyCart();
                    header('Location: cart.php');
                } else {
                    Common::flash('Order failed to go through');
                }
            }
        }
        catch (Exception $e){

        }
    }
?>

<?php else: echo "<div>Cart is Empty</div>"; ?>

<?php endif; ?>
