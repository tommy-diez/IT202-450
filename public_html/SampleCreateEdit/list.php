<?php
include('header.php'); ?>
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
            <a href="add_to_cart.php?id=<?php echo get($row, 'id')?>">Add Product to Cart</a>
        </td>
    </tr>  <!--
            <li>
                 <?php echo get($row, "id"); ?>
                 <?php echo get($row, "name"); ?>
                 <?php echo get($row, "quantity"); ?>
                 <?php echo get($row, "price"); ?>
                 <?php echo get($row, "description");?>
                 <?//php echo get($row, "modified");?>
                 <?//php echo get($row, "created");?>
                <a href="delete.php?id=<?php echo get($row, 'id')?>">Delete Product</a>
                <a href="add_order.php?id=<?php echo get($row, 'id')?>&price=<?php echo get($row, 'price')?>">Add Product to Cart</a>
            </li>
            !-->
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No products available at this time, sadly</p>
<?php endif; ?>


<?php if (isset($_SESSION['cart'])) : ?>
<ol>
    <li>
        <?php echo $_SESSION['cart']['name'] ?>
    </li>
    <li>
        <?php echo $_SESSION['cart']['price'] ?>
    </li>
    <li>
        <?php echo $_SESSION['cart']['description'] ?>
    </li>
</ol>

<?php endif ?>


<div id="footer" class="container-fluid">
    Tommy Diez (c) 2020
</div>
