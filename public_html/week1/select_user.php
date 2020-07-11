<?php

//connecting to database
require("config.php");
try {
    $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    $db = new PDO($con_string, $dbuser, $dbpass);
    $stmt = $db->prepare("SELECT * FROM Users");
    $r = $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //query

    //check
    echo var_export($stmt->errorInfo(), true);
    echo var_export($r, true);
    echo var_export($results, true);
}


catch(exception $e) {
    echo $e->getMessage();
}
