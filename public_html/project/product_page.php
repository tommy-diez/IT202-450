<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (isset($_GET['id'])){
    $product_id = $_GET['id'];
    $results = DBH::getProductInfo($product_id);

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
            <input type="hidden" name="product_name" value="<?php echo Common::get($col, "name"); ?>">
            <input type="hidden" name="product_id" value="<?php echo Common::get($col, "id"); ?>">
            <input type="submit" name="add_cart" value="ADD TO CART">
        </form>
        <?php if(isset($_POST['add_cart'])){
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $product_name = $_POST['product_name'];
            Common::addToCart($id, $product_name, $quantity);
            var_dump($_SESSION['cart']);
        }

        ?>

    <?php else: Common::flash("BAD REQUEST");

    endif;
    ?>





