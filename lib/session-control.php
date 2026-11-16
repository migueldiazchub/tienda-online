<?php
    session_start();
    
    function logout(){
      session_unset();
      session_destroy();
      header("Location: /");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])){
      logout();
    }

    $loggedIn = false;
    $isAdmin = false;

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
      $loggedIn = true;
      if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]){
          $isAdmin = true;
      }
    }

    //valores iniciales para los enlaces
    $navLoginHref = "/src/login.php";
    $navLoginContent = "Iniciar sesión";
    
    $navCart = "hidden";
    $navAdminClass = "hidden";

    if($loggedIn){
      $navLoginHref = "/src/cuenta.php";
      $navLoginContent = $_SESSION["username"];

      $navCart = "nav-link";

      if($isAdmin){
        $navAdminClass = "nav-link";
      }
    }
?>