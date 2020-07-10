<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    session_start();
    include('common.inc.php');
    $db = getDB();
    $query = "SELECT * FROM Products where ID = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $_SESSION['cart'] = array ();
    foreach($results as $row){
        array_push($_SESSION['cart'], $row);
    }
    header('Location: index.php');
}
else {
    echo "bad request 403";
}

