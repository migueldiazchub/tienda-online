<?php
  require "../lib/db.php";
  include "../lib/session-control.php";

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
      <figure id="logo">
        <a class="nav-link" href="/">
          <img id="logo-img" src="https://shop.critrole.eu/cdn/shop/files/CriticalRole_Logo_Black512x512_256x256_crop_center_c784cf6c-91ad-4f45-99a1-09a11d375e33.png?height=136&v=1641330409">
        </a>
      </figure>
      <nav>
        <a class="nav-link" href="/src/tienda.php">Tienda</a>
        <a class="nav-link" href="/src/contacto.php">Contacto</a>
        |
        <a id="nav-link-cart" class=<?php echo $navAdminClass ?> href="/src/gestion-inventario.php"
          >Gestionar inventario</a
        >
        <a id="nav-link-cart" class=<?php echo $navAdminClass ?> href="/src/gestion-compras.php"
          >Gestionar compras</a
        >
        <a id="nav-link-cart" class=<?php echo $navCart ?> href="/src/carrito.php"
          >Carrito</a
        >
        <a id='nav-link-login' class='nav-link' href=<?php echo $navLoginHref ?>
          ><?php echo $navLoginContent ?></a
        >
      </nav>
    </header>
    <main id="shop-content">
      <?php
        foreach($itemList as $item){
          echo 
            '<a class="shop-item" href="./articulo.php?itemId=' . $item->_id . '">
              <img
                src=' . $item->imageSource . '
                class="shop-item-image"
              />
              <h2 class="shop-item-title">' . $item->name . '</h2>
              <p class="shop-item-price">Precio: ' . $item->price . '€</p>
              <p class="shop-item-quantity">Stock disponible: ' . $item->quantity . '</p>
            </a>';
        }
      ?>
    </main>
  </body>
</html>
