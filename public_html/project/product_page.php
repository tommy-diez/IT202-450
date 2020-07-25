<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (isset($_GET['id'])){
    $results = DBH::getProductInfo($id);
    $product_id = $_GET['id'];

}
else {
    Common::flash("Invalid request");
    die(header("Location: " . Common::url_for("home")));
}
?>
<html>

    <?php if (!empty($results)): ?>
        <?php foreach ($results as $col): ?>
            <tr>
                <td>
                    <h1><?php echo Common::get($col, "name"); ?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>IMAGE WILL GO HERE</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h1><?php echo Common::get($col, "description"); ?></h1>
                </td>
            </tr>
        <?php endforeach; ?>
        <form method="POST">
            <label for="number">How many?: </label>
            <input type="number" name="quantity" id="number">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="submit" name="add_cart" placeholder="ADD TO CART">
        </form>
        <?php if(isset($_POST['cart'])){
            $quantity = $_POST['quantity'];
            $product_id = $_POST['product_id'];
            Common::addToCart($product_id, $quantity);
        }
        ?>

    <?php else: Common::flash("BAD REQUEST");

    endif;
    ?>





