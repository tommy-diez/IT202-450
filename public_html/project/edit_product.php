<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()) {

}
$admin = DBH::isUserAdmin($_SESSION['user']['id']);
if (!$admin) {
    Common::flash("Access denied");
    header('Location: home.php');
}
if(isset($_POST['update'])):
$id = $_POST['id'];
$results = DBH::getProductInfo($id);
    ?>

<h1>Welcome admin, add a product below: </h1>
    <form method="POST">
        <label for="product_name">Product Name</label>
        <input id="product_name" type="text" name="product_name" value="<?php Common::get($results, "name"); ?>">
        <label for="quantity">Quantity</label>
        <input id="quantity" type="number" name="quantity" value="<?php echo Common::get($results, "quantity"); ?>">
        <label for="price">Price</label>
        <input id="price" type="text" name="price" required value="<?php echo Common::get($results, "price"); ?>">
        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="<?php echo Common::get($results, "description"); ?>">
        <input type="submit" name="edit" value="Submit">
    </form>
<br>
<?php endif;
Common::flash("Invalid Request");
header('Location: home.php');
?>

<?php if(isset($_POST['edit'])){
    $name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $result = DBH::editProduct();
    if($result){
        Common::flash('Product updated successfully');
        header('Location: admin.php');
    }
}
?>