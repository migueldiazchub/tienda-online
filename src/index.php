<?php
  session_start();

  $navLoginHref = "/src/login.php";
  $navLoginContent = "Iniciar sesión";
  if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
    $navLoginHref = "/src/cuenta.php";
    $navLoginContent = $_SESSION["username"];
  }
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Inicio</title>
    <link rel="stylesheet" href="src/styles/style.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Inter"
    />
</head>
<body>
    <header>
      <figure>
        <a class="nav-link" href="/">Inicio</a>
      </figure>
      <nav>
        <a class="nav-link" href="/src/tienda.php">Tienda</a>
        <a class="nav-link" href="/src/contacto.php">Contacto</a>
        <a id="nav-link-cart" class="nav-link" href="/src/carrito.php"
          >Carrito</a
        >
        <a id='nav-link-login' class='nav-link' href=<?php echo $navLoginHref ?>
          ><?php echo $navLoginContent ?></a
        >
      </nav>
    </header>
    <form id="logout" action="/lib/logout.php">
      <input type="submit" value="logout">
    </form>
</body>
</html>

<?php
  echo json_encode($_SESSION);
?>