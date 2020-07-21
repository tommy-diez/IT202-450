<?php
include_once(__DIR__ . "/partial-pages/header.php");

if(Common::is_logged_in()){

}
?>
<div>
    <h1>Welcome, <?php echo Common::get_username(); ?></h1>
</div>
