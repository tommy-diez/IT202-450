<?php
session_start();
echo "Welcome, " . $_SESSION["user"]["email"];
?>

<html>
<a href="logout.php">Log Out!</a>
</html>
