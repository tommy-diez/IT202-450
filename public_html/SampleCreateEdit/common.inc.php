<?php

function get($arr, $key)
{
    if (isset($arr[$key])) {
        return $arr[$key];
    }
    return "";
}

function getDB()
{
    global $db;
    if (!isset($db)) {
        require_once("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        $db = new PDO($connection_string, $dbuser, $dbpass);
    }
    return $db;
}

function getOrderID($length = 5){
    $chars = '0123456789';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, $charLength - 1)];
    }
    return $randomString;
}

function getCart($id){
    $sql = "SELECT * FROM Cart WHERE userID = :userID";
    $db = getDB();
    $stmt = $db->prepare($sql);
    $stmt->bindValue('userID', $id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $stmt->closeCursor(PDO::FETCH_ASSOC);
    return $results;

}

