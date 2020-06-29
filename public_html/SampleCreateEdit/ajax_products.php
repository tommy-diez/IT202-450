<?php
require('common.inc.php');
$query = file_get_contents(__DIR__ . 'queries/SELECT_ALL_TABLE_ASC.sql');
$result = array("status"=>"200");
if (isset($query) && !empty($query)){
    try{
        $db = getDB();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result['status'] = 200; //successful connection
        $result['results'] = $results;
    }
    catch(Exception $e){
        $result['status'] = 400;
        $result['error'] = $e->getMessage();
    }
}
echo json_encode($result);
?>

