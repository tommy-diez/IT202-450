<?php
include "header.php";
//session_start();
session_unset();
session_destroy();
echo "<div>You have been logged out</div>";
//echo var_export($_SESSION, true);
//get and delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);
}


?>
<link rel="stylesheet" href="style.css">
<div id="footer" class="container-fluid">
    Tommy Diez (c) 2020
</div>
