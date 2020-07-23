<?php
include 'includes/config.php';
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabse;charset=utf8mb4";
//$this->db =
$db = new PDO($connection_string, $dbuser, $dbpass);
    $stmt = $db->prepare("SELECT * FROM Users where id=8");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $results['id'];
