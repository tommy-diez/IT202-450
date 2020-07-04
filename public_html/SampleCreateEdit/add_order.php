<?php
if (isset($_GET['id'])){
    require ('common.inc.php');
    session_start();
    $id = $_GET['id'];
    $query = "
    SELECT * FROM PRODUCTS
    where id= :id;
    
    UPDATE Products 
    SET quantity = quantity-1
    WHERE id = :id;
    
    ";

    if (isset($query) && !empty($query)) {
        try {
            $db = getDB();
            $stmt = $db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $name = $results['name'];
            $quantity = 1;
            $price = $results['price'];
            $query2 = file_get_contents(__DIR__ . "/queries/QUERY_INSERT_CART.sql");
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

