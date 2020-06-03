<?php

//connecting to database
require("config.php");
try {
    $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    $db = new PDO($con_string, $dbuser, $dbpass);

    //query
    $stmt = $db->prepare("CREATE TABLE `Users` (
                `id` int auto_increment not null,
                `email` varchar(100) not null unique,
                `created` timestamp default current_timestamp,
                `modified` timestamp default current_timestamp on update current_timestamp,
                PRIMARY KEY (`id`)
                ) CHARACTER SET utf8 COLLATE utf8_general_ci");
    $r = $stmt->execute();
    echo var_export($stmt->errorInfo(), true);
    echo var_export($r, true);
}

catch(exception $e) {
    echo $e->getMessage();
}

?>


