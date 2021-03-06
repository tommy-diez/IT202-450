<?php
session_start();

class Common

{

    private $db;

    public static function is_logged_in($redirect = true)
    {
        if (Common::get($_SESSION, "user", false)) {
            return true;
        }
        if ($redirect) {
            Common::flash("You must be logged in to access this page");
            die(header("Location: " . Common::url_for("login")));
        } else {
            return false;
        }
    }

    public static function getUserRole($redirect = true){
        if (Common::get($_SESSION['user'], "role", false)){
            return true;
        }
        if ($redirect) {
            Common::flash("Access denied");
            die(header('Location: ' . Common::url_for("home")));
        } else{
            return false;
        }
    }

    public static function get_username()
    {
        $user = Common::get($_SESSION, "user", false);
        $name = "";
        if ($user) {
            $name = Common::get($user, "first_name", false);
            if (!$name) {
                $name = Common::get($user, "email", false);
            }
        }
        return $name;
    }

    public static function url_for($lookup)
    {
        $path = __DIR__ . "/../$lookup.php";
        $r = explode("public_html", $path, 2);
        if (count($r) > 1) {
            return $r[1];
        }
        Common::flash("Error finding path", "danger");
        return "project/home.php";
    }

    public static function get($arr, $key, $default = "")
    {
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return $default;
    }

    public function getDB() {
        if (!isset($this->db)) {
            $dbdatabase = $dbuser = $dbpass = $dbhost = NULL;
            require_once(__DIR__ . "/config.php");
            if (isset($dbhost) && isset($dbdatabase) && isset($dbpass) && isset($dbuser)){
                $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                $this->db = new PDO($connection_string, $dbuser, $dbpass);
            }
            else {
                error_log("Missing db config details");
            }
        }
        return $this->db;
    }

    public static function flash($message, $type = "info")
    {
        if (!isset($_SESSION["messages"])) {
            $_SESSION["messages"] = [];
        }
        array_push($_SESSION["messages"], ["message"=>$message, "type"=>$type]);
        error_log(var_export($_SESSION["messages"], true));
    }

    public static function getFlashMessages()
    {
        $messages = $_SESSION["messages"];
        //error_log("Get Flash Messages(): " . var_export($messages, true));
        $_SESSION["messages"] = [];
        return $messages;
    }

    public static function addToCart($id, $name, $quantity, $price){
        if (isset($_SESSION["cart"])) {
            $arr = array("item" => $name, "quantity" => $quantity, "id"=>$id, "price"=>$price);
            array_push($_SESSION['cart'], $arr);
        }
    }

    public static function editCart($i, $quantity){
        $_SESSION['cart'][$i]['quantity'] = $quantity;
        header('Location: cart.php');
    }

    public static function deleteItem($i){
        unset($_SESSION['cart'][$i]);
        header('Location: cart.php');
    }


    public static function emptyCart()
    {
        $_SESSION['cart'] = array();
        header('Location: cart.php');
    }

    public static function getPaidTotal($cart)
    {
        $price = 0;
        foreach($cart as $item){
            $num_price = (float)($item['price']);
            $price += $num_price;
        }
        return $price;
    }

}

$common = new Common;

require_once(__DIR__ . "/db_helper.php");