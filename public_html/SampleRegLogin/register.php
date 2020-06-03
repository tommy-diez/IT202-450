
<html>
<form method = "POST">
    <label for = "email">Email
    <input type="email" id="email" name="email"/>
    </label>
    <label for="password">Password
    <input type="password" id="password" name ="password"/>
    </label>
    <label for="cpassword">Confirm Password
    <input type=password" id="cpassword" name="cpassword"/>
    </label>
    <input type="submit" name="register" value="Register"/>
</form>
</html>

<?php
echo var_export($_GET);
echo var_export($_POST, true);
echo var_export($_REQUEST, true);

