<?php
if (isset($_GET['id'])){
    include('header.php');
    require ('common.inc.php');
    session_start();
    $id = $_GET['id'];
    $price = $_GET['price'];
    $userID = $_SESSION['user']['id'];
    $quantity = 1;
    $query = file_get_contents(__DIR__ . "/queries/QUERY_INSERT_CART.sql");
    if (isset($query) && !empty($query)) {
        try {
            $db = getDB();
            $stmt = $db->prepare($query);
            $stmt->bindValue(':userID', $userID);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':quantity', $quantity);
            $stmt->bindValue(':price', $price);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "No query";
    }
}
else {
    echo "Invalid request";
}

?>

<?php if(isset($results)): ?>
    <h1>My Cart</h1>
    <ol>
        <?php foreach ($results as $row): ?>
            <li>
                <?php //echo get($row, "id"); ?>
                <?php echo get($row, "name"); ?>
                <?php //echo get($row, "quantity"); ?>
                <?php echo get($row, "price"); ?>
                <?php echo get($row, "description");?>
                <form>
                    <select>How many</select>
                </form>
            </li>
        <?php endforeach; ?>
    </ol>
    <button>Submit Order</button>
<?php else: ?>
    <p>Cart Is Empty</p>
<?php endif; ?>
