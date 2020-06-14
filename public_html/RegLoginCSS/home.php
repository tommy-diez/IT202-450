<?php
include 'header.php';
//session_start();
echo "Welcome, " . $_SESSION["user"]["email"];
?>
<html>
    <h1>Home Page</h1>
    <br>
<div><?php echo "Welcome, " . $_SESSION["user"]["first_name"]; ?></div>
</html>



