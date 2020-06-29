<?php
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
        <select id="by"name="order">
            <option value="price">Price</option>
            <option value="quantity">Quantity</option>
            <option value="name">Name</option>
        </select>
        <input type="submit" name="submit" value="SUBMIT">
    </form>
</body>
</html>

<?php

if(isset($query) && !empty($query)){
    try{
        $db = getDB();
        $query = "SELECT * FROM Products WHERE name like CONCAT('%', :thing, '%') 
                    ORDER BY :order ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':thing', $search);
        $stmt->bindValue(':order', $order);
        $stmt->bindValue(':sort', $sort);
        $stmt -> execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
        echo $e->getMessage();
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
