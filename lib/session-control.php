<?php
  session_start();

  $navLoginHref = "/src/login.php";
  $navLoginContent = "Iniciar sesión";
  if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
    $navLoginHref = "/src/cuenta.php";
    $navLoginContent = $_SESSION["username"];
  }
?>