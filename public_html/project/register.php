<?php
include_once(__DIR__ . "/partial-pages/header.php");
?>
<div>
    <form method="POST">
        <label for="first_name">First Name: </label>
        <input type="text" name="first_name" required>
        <label for="last_name">Last Name: </label>
        <input type="test" name="last_name">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required min="5">
        <br>
        <label for="cpassword">Confirm Password: </label>
        <input type="password" id="cpassword" name="cpassword" required min="5">
        <input type="submit" name="register" value="SUBMIT">
    </form>
</div>
<?php

/*
if (Common::get($_POST, "submit", false)){
    $email = Common::get($_POST, "email", false);
    $password = Common::get($_POST, "password", false);
    $cpassword = Common::get($_POST, "cpassword", false);
    $first_name = Common::get($_POST, "first_name", false);
    $last_name = Common::get($_POST, "last_name", false);
    if ($password != $cpassword) {
        Common::flash("Passwords do not match", "warning");
        die(header("Location: register.php"));
    }
    if(!empty($email) && !empty($password)){
        $result = DBH::register($first_name, $last_name, $email, $password);
        echo var_export($result, true);
        if(Common::get($result, "status", 400)==200) {
            Common::flash("Successfully registered! Please login", "success");
            die(header('Location: ' . Common::url_for('login')));
        }
        else {
            echo "Failure";
        }
    }
    else{
        Common::flash("Email and password must be filled", "warning");
        die(header("Location: register.php"));
    }
}
*/

if (isset($_POST["register"])) {
    if (isset($_POST["password"]) && isset ($_POST["cpassword"])) {
        if (isset($_POST["email"])) {
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            $email = $_POST["email"];
            //echo $password;
            //echo $cpassword;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                        if ($e[0] != "00000") {
                            echo var_export($e, true);
                        } else {
                            echo "<div>Account successfully created!";
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    echo "<br>Passwords do not match!";
                }

            }
            else {
                echo "<div>Must use valid email address</div>";
            }

        }
        else {
            echo "<div>Leave no fields empty</div>";
        }
    }
    else{
        echo "<div>Leave no fields empty</div>";
    }
}
?>
