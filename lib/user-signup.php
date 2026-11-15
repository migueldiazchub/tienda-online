<?php
    require "db.php";

    function testInput($data) {
        if($data == NULL) {
            return "";
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
    
        header("Location: /");
    } catch (Exception $e) {
        echo $e;
    }
?>