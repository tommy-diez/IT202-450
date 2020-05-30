<?php

//connecting to database
require("config.php");
try {
    $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    $db = new PDO($con_string, $dbuser, $dbpass);
    $stmt = $db->prepare("UPDATE Users set email=:email WHERE email = :original");
    $stmt->bindValue(":email", "newemail@test.com");
    $stmt->bindValue(":original", "test@test.com");
    $r = $stmt->execute();

    //query

    //check
    echo var_export($stmt->errorInfo(), true);
    echo var_export($r, true);
}


catch(exception $e) {
    echo $e->getMessage();
}
