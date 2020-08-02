<?php
include_once(__DIR__ . "/partial-pages/header.php");
if(Common::is_logged_in()){

}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = DBH::getUserInfo($id);
}
else {
    Common::flash('Invalid Request');
    header('Location: home.php');
}

?>
<? if(!empty($user)) :
?>
<form>
    <form>
        <label for="password">Password: </label>
        <input id="password" type="password" name="password">
        <label for="cpassword" id="cpassword">Confirm Password: </label>
        <input id="cpassword" type="password" name="cpassword">
        <input type="submit" name="pass_reset" value="RESET">
    </form>
</form>

<?php
if(!empty($_POST['pass_reset'])){
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $result = DBH::resetPass($pass, $cpass, $id);
    if($result){
        Common::flash('Sucessfully updated password');
        header('Location: account.php');
    }
}
?>

<?php endif; ?>