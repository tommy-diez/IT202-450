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
            <a href="delete.php?id=<?php echo get($row, 'id')?>">Delete Product</a>
        </td>
        <td>
        <form action="cart.php" method="POST">
            <input type="hidden" name="add_cart" value="<?php echo get($row, 'id')?>">
            <input type="number" name="cart_quantity">
            <input type="submit" name="add_cart_submit" value="Add_Cart">
        </form>
        </td>
    </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No products available at this time, sadly</p>
<?php endif; ?>

<?php
    $orderID = $_SESSION['orderID'];
    $query = file_get_contents(__DIR__ . "queries/SELECT_CART.sql");
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $orderID);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

<?php if (isset($products)) : ?>
<h1>My Cart</h1>
<?php foreach ($products as $product): ?>
    <tr>
        <td>
            <?php echo $product['orderID']; ?>
        </td>
        <td>
            <?php echo $product['productID']; ?>
        </td>
        <td>
            <?php echo $product['quantity']; ?>
        </td>
     </tr>
<?php endforeach ?>

<?php endif ?>

<div id="footer" class="container-fluid">
    Tommy Diez (c) 2020
</div>
