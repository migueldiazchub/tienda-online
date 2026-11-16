<?php
  require "../lib/db.php";
  include "../lib/session-control.php";
  if(!$loggedIn){
    http_response_code(401);
    die();
  }

  $shoppingCart = $_SESSION["shopCart"];
  $cartControlClass = "";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar sesión</title>
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
    <main id="cart-content">
      <ul id=cart-list>
        <?php
            if(count($shoppingCart) == 0 || is_null($shoppingCart)){
              $cartControlClass = "hidden";
              echo "<h2>No hay artículos en el carrito de compra</h2>";
            } else {
              $index = 0;
              foreach($shoppingCart as $item){
                echo 
                  '<a class="cart-item" href="./articulo.php?itemId=' . $item["id"] . '">
                      <div class="cart-item-info">
                        <img
                            src=' . $item["imageSource"] . '
                            class="cart-item-image"
                        />
                        <div class="cart-item-details">
                            <h2 class="cart-item-title">' . $item["name"] . '</h2>
                            <p class="cart-item-price"><b>Precio total:</b> ' . $item["price"] * $item["quantity"] . '€</p>
                            <p class="cart-item-quantity"><b>Cantidad a comprar:</b> ' . $item["quantity"] . '</p>
                        </div>
                      </div>
                      <button id=' . $index++ . ' class="action-delete-from-cart">
                          Eliminar del carrito
                      </button>
                  </a>';
              }
            }
        ?>
      </ul>
      <section id="cart-control" class=<?php echo $cartControlClass ?>>
        <button id="action-confirm-purchase" class="cart-control-action">
          Confirmar compra
        </button>
        <button id="action-cancel-purchase" class="cart-control-action">
          Cancelar
        </button>
      </section>
    </main>
    <script src="./scripts/carrito.js"></script>
</body>
</html>

<!-- href="./articulo.php?itemId=' . $item["id"] . ' -->