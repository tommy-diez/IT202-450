<?php
include(__DIR__ . '/../includes/common.inc.php');
error_reporting(-1); // reports all errors
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
/*
if(Common::is_logged_in()){

}
*/
$logged_in = Common::is_logged_in(false);
$admin = Common::getUserRole(false);
?>

<head>
<link rel="stylesheet" type="text/css" href="partial-pages/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<div id="navbar" class="container-fluid bg-info">
    <div class="row">
        <h1 class="col-md-2">EBiz </h1>
        <?php if($logged_in): ?>
            <a class="col-md-2 nav-item" href="<?php echo Common::url_for("home"); ?>">Home</a>
            <a class="col-md-2 nav-item" href="<?php echo Common::url_for("cart"); ?>">My Cart</a>
            <a class="col-md-2 nav-item" href="<?php echo Common::url_for("account"); ?>">My Account</a>
        <?php endif; ?>
        <?php if($admin): ?>
            <a class="col-md-2 nav-item" href="<?php echo Common::url_for("admin"); ?>"
        <?php endif; ?>
        <?php if(!$logged_in): ?>
            <a class="col-md-4 nav-item" href="<?php echo Common::url_for("login"); ?>">Login</a>
            <a class="col-md-4 nav-item" href="<?php echo Common::url_for("register"); ?>">Register</a>
        <?php else: ?>
            <a class="col-md-2 nav-item" href="<?php echo Common::url_for("logout"); ?>">Logout</a>
        <?php endif; ?>
    </div>
</div>

<div id="messages">
    <?php $flash_messages = Common::getFlashMessages(); ?>
    <?php if(isset($flash_messages) && count($flash_messages) > 0): ?>
        <?php foreach($flash_messages as $msg): ?>
    <div class="alert alert-<?php echo Common::get($msg, "type"); ?>">
        <?php echo Common::get($msg, "message"); ?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
