<?php
include('header.php');

?>
<html>
<div class="container"
<form method="POST">
    <label class="row" for ="email">Email
    <input type="email" id="email" name="email"/>
    </label>
    <label class="row" for="password">Password
    <input type="password" id="password" name ="password"/>
    </label>
    <label class="row" for="cpassword">Confirm Password
    <input type="password" id="cpassword" name="cpassword"/>
    </label>
    <input class="row" type="submit" name="register" value="Register"/>
</form>
</html>

<?php
/*
echo var_export($_GET);
echo var_export($_POST, true);
echo var_export($_REQUEST, true);
*/

if (isset($_POST["register"])) {
    if (isset($_POST["password"]) && isset ($_POST["cpassword"])) {
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $email = $_POST["email"];
        //echo $password;
        //echo $cpassword;
        if ($password == $cpassword) {
            //echo "<br>Passwords match!";
            require 'config.php';
            $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
            try{
                $db = new PDO($con_string, $dbuser, $dbpass);
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $db->prepare("INSERT INTO Users (email, password) VALUES (:email, :password)");
                $stmt->bindValue(':email', $email);
                $stmt->bindValue('password', $hash);
                $stmt->execute();
                $e = $stmt->errorInfo();
                if ($e[0] != "00000"){
                    echo var_export($e, true);
                }
                else {
                    echo "<div>Account successfully created!";
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        } else {
            echo "<br>Passwords do not match!";
        }

    }
}
?>

