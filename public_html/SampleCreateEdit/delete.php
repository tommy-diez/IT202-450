<?php
require("common.inc.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = getDB();
    $query = "DELETE FROM Products WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $e = $stmt->errorInfo();
    if ($e[0] != "00000"){
        var_export($e, true);
    }
    else{
        echo "Product successfully deleted";
        die(header('Location: list.php'));
    }
}
else {
    echo "No id in url";
}

