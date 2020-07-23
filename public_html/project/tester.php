<?php
include 'includes/common.inc.php';

    $db = $common->getDB();
    $stmt = $db->prepare("SELECT * FROM Users");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_export($results, true);
