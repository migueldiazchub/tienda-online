<?php
    session_start();

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
    
    $navClientClass = "hidden";
    $navAdminClass = "hidden";

    //si la sesión está iniciada, se muestran los enlaces correspondientes
    if($loggedIn){
      $navLoginHref = "/src/cuenta.php";
      $navLoginContent = $_SESSION["username"];

      if($isAdmin){
        $navAdminClass = "nav-link";
      } else {
        $navClientClass = "nav-link";
      }
    }
?>