<?php
include_once(__DIR__ . "/partial-pages/header.php");
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");


?>
<div>
    <h1>Welcome to our ECommerce Site, <?php echo $_SESSION['user']['first_name']; ?></h1>
</div>
<?php
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

