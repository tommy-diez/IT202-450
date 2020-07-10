<?php
include('header.php');
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
session_start();


if (isset($_POST["login"])) {
    if (isset($_POST["password"]) && isset ($_POST["email"])) {
        $password = $_POST["password"];
        $email = $_POST["email"];
        require 'config.php';
        $con_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{

                $db = new PDO($con_string, $dbuser, $dbpass);
                $stmt = $db->prepare("SELECT * from Users where email = :email LIMIT 1");
                $stmt->bindValue(':email', $email);
                $stmt->execute();
                $e = $stmt->errorInfo();
                if ($e[0] != "00000"){
                    echo var_export($e, true);
                }
                else {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($result){
                        $rpassword = $result["password"];
                        if(password_verify($password, $rpassword)){
                            echo "<div>Login credentials valid. You are logged in";
                            $_SESSION['user'] = array(
                                    "id"=>$result['id'],
                                    "email"=>$result["email"],
                                    "first_name"=>$result["first_name"],
                                    "last_name"=>$result["last_name"],

                            );
                            echo var_export($_SESSION, true);
                            header('Location: index.php');
                        }
                        else{
                            echo "<div>Invalid password";
                        }
                    }
                    else{
                        echo"<div>Invalid user";
                    }
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        } else {
            echo "<br>Passwords do not match!";
        }

}

?>

