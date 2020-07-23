<?php
include 'includes/config.php';
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabse;charset=utf8mb4";
//$this->db =
$db = new PDO($connection_string, $dbuser, $dbpass);
    $stmt = $db->prepare("SELECT * FROM Users");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($results);
