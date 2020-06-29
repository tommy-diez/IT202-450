<?php
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
?>

<html>
<head>
</head>
<body>
    <form method="POST">
        <input type="text" name="search" placeholder="SEARCH" value="<?php echo $search; ?>">
        <select name="sort">
            <option value="1">Lowest to Highest Price</option>
            <option value="2">Highest to Lowest Price</option>
        </select>
    </form>
</body>
</html>

<?php
    if (isset($search)) {
        require('common.inc.php');
        if (isset($_POST['sort'])) {
            $sort = $_POST['sort'];
            if ($sort = 1) {
                $query = file_get_contents(__DIR__ . "/queries/SEARCH_TABLE_PRODUCTS.sql");
            } else {
                $query = file_get_contents(__DIR__ . "queries/SEARCH_TABLE_PRODUCTS_DESC.sql");
            }
        }
        else {
            $query = file_get_contents(__DIR__ . "/queries/SEARCH_TABLE_PRODUCTS.sql"); //default case
        }
        if(isset($query) && !empty($query)){
            try{
                $db = getDB();
                $stmt = $db->prepare($query);
                $stmt->bindValue(':thing', $search);
                $stmt -> execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
?>

<?php if(isset($results) && count($results) > 0) :?>

<h1>Results</h1>
<ul>
    <?php foreach ($results as $row):?>
    <li>
        <?php echo get($row, "product_name"); ?>
        <?php echo get($row, "id"); ?>
        <?php echo get($row, "name"); ?>
        <?php echo get($row, "quantity"); ?>
        <?php echo get($row, "price"); ?>
        <?php echo get($row, "description");?>
        <?php echo get($row, "modified");?>
        <?php echo get($row, "created");?>
        <a href="delete.php?id=<?php echo get($row, 'id')?>">Delete Product</a>
    </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
    <p>No products match your search</p>
<?php endif; ?>
