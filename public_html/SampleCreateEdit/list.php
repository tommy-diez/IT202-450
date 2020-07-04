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
    <p>Products</p>
    <ul>
        <?php foreach ($results as $row): ?>
            <li>
                 <?php echo get($row, "id"); ?>
                 <?php echo get($row, "name"); ?>
                 <?php echo get($row, "quantity"); ?>
                 <?php echo get($row, "price"); ?>
                 <?php echo get($row, "description");?>
                 <?php echo get($row, "modified");?>
                 <?php echo get($row, "created");?>
                <a href="delete.php?id=<?php echo get($row, 'id')?>">Delete Product</a>
                <a href="add_order.php?id=<?php echo get($row, 'id')?>">Add Product to Cart</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No products available at this time, sadly</p>
<?php endif; ?>

