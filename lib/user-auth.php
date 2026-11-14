<?php
    session_start();
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

    function authenticate($username, $password){
        $userList = getUsers();
        $userFound = false;

        foreach($userList as $user){
            if($user->username == $username && $user->password == $password){
                $userFound = true;
                $_SESSION["userId"] = $user->userId;
                $_SESSION["username"] = $user->username;
                break;
            }
        }

        return $userFound;
    }

    function clearLoginAttempt(){
        unset($_POST["username"]);
        unset($_POST["password"]);
    }

    $username = $password = "";
    $username = testInput($_POST["username"]);
    $password = testInput($_POST["password"]);

    if(authenticate($username, $password)){
        clearLoginAttempt();
        $_SESSION["loggedIn"] = true;
        header("Location: /");
    } else {
        clearLoginAttempt();
        echo "User not found";
        echo "<button onclick='back()'>volver</button>";
    }
?>

<script>
    function back(){
        window.location.href = "/";
    }
</script>