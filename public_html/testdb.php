<?php

//connecting to database
require("config.php");
try {
    $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    $db = new PDO($con_string, $dbuser, $dbpass);

    //query
    $query = "CREATE TABLE `Users` (
                'id' int auto_increment not null,
                'email' varchar(100) not null unique,
                'created' timestamp default current_timestamp,
                PRIMARY KEY ('id')
                ) CHARACTER SET utf8 COLLATE utf8_general_ci";
    $stmt = $db->prepare($query);
    $r = $stmt->execute();
    echo var_export($r);

    echo "connected";
}
catch(exception $e){
    echo $e->getMessage();
}



?>


