<?php
require('common.inc.php');
$query = file_get_contents(__DIR__, "/queries/SELECT_ALL_TABLE.sql");
if (isset($query) && !empty($query)){
    try{
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
        <?php foreach ($results as $row): ?>{
            <li>
                <?php echo get($row, "id");
                 echo get($row, "name");
                 echo get($row, "quantity");
                 echo get($row, "price");
                 echo get($row, "description");
                 echo get($row, "modified");
                 echo get($row, 'created');
                 ?>
            </li>
        <?php endforeach; ?>
    </ul>
}

<?php else: ?>
<p>No products available at this time, sadly</p>

<?php endif; ?>
