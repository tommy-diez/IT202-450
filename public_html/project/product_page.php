<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (isset($_GET['id'])){
    $product_id = $_GET['id'];
    $results = DBH::getProductInfo($product_id);
    $reviews = DBH::getReviews($product_id);

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
            <input type="hidden" name="price" value="<?php echo Common::get($col, "price"); ?>">
            <input type="submit" name="add_cart" value="ADD TO CART">
        </form>
        <?php if(isset($_POST['add_cart'])){
            $id = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            Common::addToCart($id, $product_name, $quantity, $price);
            var_dump($_SESSION['cart']);
        }

        ?>

    <?php else: Common::flash("BAD REQUEST");

    endif;
    ?>
<?php if(!empty($reviews)): ?>
    <table border="1">
        <tr>
        <th>
            Rating
        </th>
        <th>
            Description
        </th>
        </tr>
        <?php foreach ($reviews as $review): ?>
            <tr>
                <td>
                    <h1><?php for ($x = 0; $x <= Common::get($review, "rating"); $x++) {
                    echo "⭐";
                        }
                        ?>
                    </h1>

                    </h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>IMAGE WILL GO HERE</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h1><?php echo Common::get($review, "description"); ?></h1>
                </td>
            </tr>
        <?php endforeach; ?>
        <form method="POST">

    </table>
<?php else: ?>
    <h3>No reviews for this product, yet</h3>

<?php endif; ?>



<?php if(DBH::ifPurchased($id, $product_id)): ?>
    <h2>Leave a Review</h2>
    <form>
        <label for="rating">RatingL </label>
        <input id="rating" type="number" name="rating" min="0" max="5">
        <label for="description">Explain: </label>
        <input id="description" type="text" name="description">
        <input type="submit" name="review" value="PLACE REVIEW">
    </form>

<?php else: ?>


<?php endif; ?>


