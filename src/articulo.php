<?php
  require "../lib/db.php";
  include "../lib/session-control.php";

  $itemId = htmlspecialchars($_GET["itemId"]);
  $item = getItemById($itemId);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Artículo</title>
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
    <main id="item-page">
      <section id="item-content">
        <img
          src=<?php echo $item->imageSource ?>
          id="item-page-image"
        />
        <section id="item-page-info">
          <section id="item-page-details">
            <h2 id="item-page-title">
              <?php echo $item->name ?>
            </h2>
            <p id="item-page-price-unit">
              Precio por unidad: <?php echo $item->price ?>€
            </p>
            <p id="item-page-quantity">
              Cantidad: <?php echo $item->quantity ?>
            </p>
          </section>
          <section id="item-purchase-control" action="../lib/shopcart-management.php" method="post">
            <div id="item-quantity-control">
              <button
                id="item-quantity-lower"
                class="quantity-change-button"
              >
                -
              </button>
                <label id="quantity-label">
                  Unidades: 
                  <input
                    id="quantity-input"
                    name="quantity"
                    type="number"
                    value="0"
                    min="0"
                    max=<?php echo $item->quantity ?>
                    readonly
                  />
                </label>
              <button
                id="item-quantity-raise"
                class="quantity-change-button"
              >
                +
              </button>
            </div>
            <div id="item-purchase-actions">
              <button
                id="action-cancel-item"
                class="item-purchase-button"
              >
                Cancelar
              </button>
              <button id="action-add-to-cart" class="item-purchase-button" disabled>Añadir al carrito</button>
            </div>
          </section>
        </section>
      </section>
    </main>
    <script src="./scripts/articulo.js"></script>
  </body>
</html> 

