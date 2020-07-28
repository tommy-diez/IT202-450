<?php
include_once (__DIR__ . '/partial-pages/header.php');
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

$multi_arr = array(
$arr = array(
    "name"=>"John",
    "age"=>34,
    "profession"=>"carpenter",
    "country"=>"USA"
),
$arr2 = array(
    "name"=>"Mark",
    "age"=>15,
    "profession"=>"student",
    "country"=>"USA"
)
);
?>

<?php foreach ($multi_arr as $arr): ?>
<table border="1">
    <tr>
        <td>
            <?php echo Common::get($arr, 'name'); ?>
        </td>
        <td>
            <?php echo Common::get($arr, 'age'); ?>
        </td>
        <td>
            <?php echo Common::get($arr, 'profession'); ?>
        </td>
        <td>
            <?php echo Common::get($arr, 'country'); ?>
        </td>
    </tr>
</table>
    <?php endforeach; ?>

<?php
DBH::getUserInfo($_SESSION['user']['id']);
var_dump($results);


