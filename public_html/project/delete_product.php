<?php
include_once(__DIR__ . '/partial-pages/header.php');
if (Common::is_logged_in()) {

}
if (Common::getUserRole()) {

}
if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $result = DBH::deleteFunction($id);
    if ($result) {
        Common::flash('Product deleted successfully');
        header('Location: admin.php');
    }
}


