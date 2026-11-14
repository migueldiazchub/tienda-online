<?php
  session_start();

  require "../lib/db.php";

  $itemList = getItems();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tienda</title>
    <link rel="stylesheet" href="./styles/style.css" />
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
        <a id="nav-link-login" class="nav-link" href="/src/login.php"
          >Iniciar sesión</a
        >
      </nav>
    </header>
    <main id="shop-content">
      <?php
        foreach($itemList as $item){
          echo 
            '<a class="shop-item" href="./articulo.php?itemId=' . $item->itemId . '">
              <img
                src=' . $item->imageSource . '
                class="shop-item-image"
              />
              <h2 class="shop-item-title">' . $item->name . '</h2>
              <p class="shop-item-price">' . $item->price . '</p>
              <p class="shop-item-quantity">' . $item->quantity . '</p>
            </a>';
        }
      ?>
    </main>
  </body>
</html>
