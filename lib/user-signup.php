<?php
    require "db.php";
    echo "hello";

    function testInput($data) {
        if($data == NULL) {
            return "";
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function clearSignupAttempt(){
        unset($_POST["username"]);
        unset($_POST["email"]);
        unset($_POST["password"]);
    }

    try {
        $username = $email = $password = "";
        $username = testInput($_POST["username"]);
        $email = testInput($_POST["email"]);
        $password = testInput($_POST["password"]);
    
        $newUser = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "admin" => false,
            "purchaseHistory" => []
        ];
        insertUser($newUser);

        clearSignupAttempt();
        header("Location: /");
    } catch (Exception $e) {
        clearSignupAttempt();
        echo $e;
    }
?>