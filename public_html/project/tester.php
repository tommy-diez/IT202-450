<?php
include 'includes/common.inc.php';
try {
    $db = $common->getDB();
    $stmt = $db->prepare("SELECT * FROM Users");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_export($results, true);
}
catch (Exception $e) {
    echo $e;
}
