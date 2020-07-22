<?php
include_once(__DIR__ . "/partial-pages/header.php");
?>

<html>
<link rel="stylesheet" href="style.css">
<body>
<br>
<h1>Login</h1>
<br>
<form class="login-form" method="POST">
    <label for ="email">Email</label><br>
    <input type="email" id="email" name="email"/>
    <br>
    <br>
    <label for="password">Password</label><br>
    <input type="password" id="password" name ="password"/>
    <br>
    <br>
    <input type="submit" name="login" value="LOGIN"/>
</form>
<div id="footer" class="container-fluid">
    Tommy Diez (c) 2020
</div>
</body>
</html>

<?php

