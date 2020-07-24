<?php
include_once (__DIR__ . 'partial-pages/header.php');
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

$arr = array(
    "name"=>"John",
    "age"=>"34",
    "profession"=>"carpenter",
    "country"=>"USA"
);
echo(Common::get($arr, "name"));

?>
