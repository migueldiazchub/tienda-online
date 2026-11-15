<?php
    require "db.php";

    class User {
        public $userId;
        public $username;
        public $email;
        public $password;
        public $admin = false;
        public $purchaseHistory = [];

        function __construct($userId, $username, $email, $password){
            $this->userId = $userId;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
        }
    }

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
        unset($_POST["id"]);
        unset($_POST["username"]);
        unset($_POST["email"]);
        unset($_POST["password"]);
    }

    try {
        $userId = $username = $email = $password = "";
        $userId = testInput($_POST["id"]);
        $username = testInput($_POST["username"]);
        $email = testInput($_POST["email"]);
        $password = testInput($_POST["password"]);
    
        $newUser = new User($userId, $username, $email, $password);
        $data = getData();
        $data->users[] = $newUser;
    
        writeData(json_encode($data));

        clearSignupAttempt();
        header("Location: /");
    } catch (Exception $e) {
        clearSignupAttempt();
        echo $e;
    }
?>