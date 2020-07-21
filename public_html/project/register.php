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
        <input type="submit" name="submit" value="SUBMIT">
    </form>
</div>

<?php
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
    }
    else{
        Common::flash("Email and password must be filled", "warning");
        die(header("Location: register.php"));
    }
}