<?php

class DBH{

    private static function getDB()
    {
        global $common;
        if(isset($common)){
            return $common->getDB();
        }
        throw new Exception("Failed to find reference to common");
    }

    private static function response($data, $status = 200, $message = "")
    {
        return array("status"=>$status, "message"=>$message, "data"=>$data);
    }

    private static function verify_sql($stmt)
    {
        if(!isset($stmt)){
            throw new Exception("stmt object is undefined");
        }
        $e = $stmt->errorInfo();
        if($e[0] != '00000'){
            $error = var_export($e, true);
            error_log($error);
            throw new Exception("SQL Error: $error");
        }
    }

    public static function login($email, $pass)
    {
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/login.sql");
            $stmt = DBH::getDB()->prepare($query);
            $stmt->execute([":email" => $email]);
            DBH::verify_sql($stmt);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if (password_verify($pass, $user["password"])) {
                    unset($user["password"]);//TODO remove password before we return results
                    //TODO get roles
                    $query = file_get_contents(__DIR__ . "/../sql/queries/get_roles.sql");
                    $stmt = DBH::getDB()->prepare($query);
                    $stmt->execute([":user_id"=>$user["id"]]);
                    DBH::verify_sql($stmt);
                    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $user["roles"] = $roles;
                    return DBH::response($user);
                } else {
                    return DBH::response(NULL, 403, "Invalid email or password");
                }
            } else {
                return DBH::response(NULL, 403, "Invalid email or password");
            }
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return DBH::response(NULL, 400, "DB Error: " . $e->getMessage());
        }
    }

    public static function register($first_name, $last_name, $email, $pass)
    {
        try {
            /*$query = "INSERT INTO Users (first_name, last_name, email, password)
                                                VALUES (:first_name, :last_name, :email, :password)";
            //$query = file_get_contents(__DIR__ . "/../sql/queries/register.sql");
            */
            $stmt = DBH::getDB()->prepare("INSERT INTO Users (first_name, last_name, email, password) 
                                                VALUES (:first_name, :last_name, :email, :password)");
            $pass = password_hash($pass, PASSWORD_BCRYPT);
            $stmt->bindValue(':first_name', $first_name);
            $stmt->bindValue(':last_name', $last_name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $pass);
            $result = $stmt->execute();
            DBH::verify_sql($stmt);
            if($result){
                return DBH::response(NULL,200, "Registration successful");
            }
            else{
                return DBH::response(NULL, 400, "Registration unsuccessful");
            }
        }
        catch(Exception $e){
            error_log($e->getMessage());
            return DBH::response(NULL, 400, "DB Error: " . $e->getMessage());
        }
    }


    public static function getProductInfo($id){
        $query = file_get_contents(__DIR__ . "/../sql/queries/get_product_info.sql");
        try {
            $db = DBH::getDB();
            $stmt = $db->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            error_log($e->getMessage());
            return DBH::response(NULL, 400, "DB Error: " . $e->getMessage());
        }
        return $results;
    }

    public static function checkStock($id){
        $query = file_get_contents(__DIR__ . "/../sql/queries/check_stock.sql");
        try {
            $db = DBH::getDB();
            $stmt = $db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $results = $stmt->fetchAll();
            if ($results >= 1){
                return true;
            }
            else {
                return false;
            }
        }
        catch (Exception $e){
            error_log($e->getMessage());
            return DBH::response(NULL, 400, "DB Error: " . $e->getMessage());
        }
        return $results;
}

    public static function placeOrder($cart){
        $query = file_get_contents(__DIR__ . "/../sql/queries/place_order.sql");
        $order_id = Common::createOrderID();
        $paidTotal = Common::getPaidTotal($cart);
        foreach($cart as $item):
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $userID = $_SESSION['user']['id'];
        try {
            $db = DBH::getDB();
            $stmt = $db->prepare($query);
            $stmt->bindValue(':OrderID', $order_id);
            $stmt->bindValue('productID', $product_id);
            $stmt->bindValue('quantity', $quantity);
            $stmt->bindValue('userID', $userID);
            $stmt->bindValue(':paidTotal', $paidTotal);
            $result = $stmt->execute();
            DBH::verify_sql($query);
            if($result){
                return DBH::response(NULL,200, "Order placed successfully");
            }
            else{
                return DBH::response(NULL,200, "Order failed to be placed");
            }


        }
        catch(Exception $e){
            error_log($e->getMessage());
            return DBH::response(NULL, 400, "DB Error: " . $e->getMessage());
        }
        endforeach;
        

    }

}