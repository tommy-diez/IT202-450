<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
require_once (__DIR__ . "/../includes/common.inc.php");
$logged_in = Common::is_logged_in(false);
?>
<link rel="stylesheet" type="text/css" href="../styles/style.css"
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<div id="navbar" class="container-fluid">
    <ul>
        <?php if($logged_in): ?>
        <li>
            <a href="<?php echo Common::url_for("home"); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo Common::url_for("cart"); ?>">My Cart</a>
        </li>
        <li>
            <a href="<?php echo Common::url_for("account"); ?>">My Account</a>
        </li>
        <?php endif; ?>
        <?php if(!$logged_in): ?>
        <li>
            <a href="<?php echo Common::url_for("login"); ?>">Login</a>
        </li>
        <li>
            <a href="<?php echo Common::url_for("register"); ?>">Register</a>
        </li>
        <?php else: ?>
        <li>
            <a href="<?php echo Common::url_for("logout"); ?>">Logout</a>
        </li>
        <?php endif; ?>
    </ul>
</div>

<div id="messages">
    <?php $flash_messages = Common::getFlashMessages(); ?>
    <?php if(isset($flash_messages) && count($flash_messages) > 0): ?>
        <?php foreach($flash_messages as $msg): ?>
    <div class="<?php echo Common::get($msg, "type"); ?>">
        <?php echo Common::get($msg, "message"); ?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
