<?php
include_once(__DIR__ . "/partial-pages/header.php");
if(Common::is_logged_in()){

}
$user = get_current_user();
?>

<h1>Welcome, <?php echo Common::get_username(); ?></h1>
<h1>View your account below</h1>

