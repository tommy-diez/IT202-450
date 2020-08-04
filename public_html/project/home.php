<?php
include_once(__DIR__ . "/partial-pages/header.php");


$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$order = 'price';
if(isset($_POST['order'])){
    $order = $_POST['order'];
}

$sort = "ASC";
if(isset($_POST['sort'])){
    $sort = $_POST['sort'];
}

?>
<div>
    <h1>Welcome to our ECommerce Site, <?php echo $_SESSION['user']['first_name']; ?></h1>
</div>
<?php
/*
$db = $common->getDB();
$query = file_get_contents(__DIR__ . "/sql/queries/select_products.sql");
if (isset($query) && !empty($query)){
    try{
        $db = $common->getDB();
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
*/
?>
<html>
<head>
</head>
<body>
    <form method="POST">
        <input type="text" name="search" placeholder="SEARCH" value="<?php echo $search; ?>">
        <br>
        <h1>Order</h1>
        <label for="sort">Ascending or Descending?: </label>
        <select id="sort" name="sort">
            <option value="ASC">Lowest to Highest</option>
            <option value="DESC">Highest to Lowest</option>
        </select>
        <label for="by">By?: </label>
        <select id="by" name="order">
            <option value="price">Price</option>
            <option value="quantity">Quantity</option>
            <option value="name">Name</option>
            <option value="created">Recently added</option>
            <option value="amount_purchased">Popularity</option>
        </select>
        <input type="submit" name="submit" value="SUBMIT">
    </form>
</body>
</html>

<?php
$results = DBH::search($order, $sort, $search);
?>

<?php if(isset($results)): ?>
    <h3>Products</h3>
    <form>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product</th>
            <th>In Stock</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td>
                    <?php echo Common::get($row, "id"); ?>
                </td>
                <td>
                    <a href="product_page.php?id=<?php echo Common::get($row, "id"); ?>"><?php echo Common::get($row, "name"); ?></a>
                </td>
                <td>
                    <?php echo Common::get($row, "quantity"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "price"); ?>
                </td>
                <td>
                    <?php echo Common::get($row, "description");?>
                </td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else:
    Common::flash("No products are available at this time");
    ?>

<?php endif; ?>

