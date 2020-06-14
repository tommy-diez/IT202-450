<?php
include('header.php');

?>
<html>
<link rel="stylesheet" href="style.css">
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <h2>Register an account with our banking portal!</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="reg-form">
                <form method="POST">
                    <label for="first_name">First Name</label><br>
                    <input type="text" id="first_name" name="first_name">
                    <br>
                    <br>
                    <label for="last_name">Last Name</label><br>
                    <input type="text" id="last_name" name="last_name">
                    <br>
                    <br>
                    <label for ="email">Email</label><br>
                    <input type="email" id="email" name="email"/>
                    <br>
                    <br>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name ="password"/>
                    <br>
                    <br>
                    <label for="cpassword">Confirm Password</label><br>
                    <input type="password" id="cpassword" name="cpassword"/>
                    <br>
                    <br>
                    <input type="submit" name="register" value="Register"/>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="footer" class="container-fluid">
Tommy Diez (c) 2020
</div>
</body>
</html>

<?php
/*
echo var_export($_GET);
echo var_export($_POST, true);
echo var_export($_REQUEST, true);
*/

if (isset($_POST["register"])) {
    if (isset($_POST["password"]) && isset ($_POST["cpassword"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
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
                $stmt = $db->prepare("INSERT INTO Users (first_name, last_name, email, password) 
                                                VALUES (:first_name, :last_name, :email, :password)");
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', $hash);
                $stmt->bindValue(':first_name', $first_name);
                $stmt->bindValue(':last_name', $last_name);
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

