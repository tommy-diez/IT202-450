<?php
include_once (__DIR__ . 'partial-pages/header.php');

$arr = array(
    "name"=>"John",
    "age"=>"34",
    "profession"=>"carpenter",
    "country"=>"USA"
);
echo(Common::get($arr, "name");

?>
