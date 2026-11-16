<?php
  require "../lib/db.php";
  include "../lib/session-control.php";
  if(!$loggedIn){
    http_response_code(401);
    die();
  }

  $shoppingCart = $_SESSION["shopCart"];
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
      <figure>
        <a class="nav-link" href="/">Inicio</a>
      </figure>
      <nav>
        <a class="nav-link" href="/src/tienda.php">Tienda</a>
        <a class="nav-link" href="/src/contacto.php">Contacto</a>
        |
        <a id="nav-link-cart" class=<?php echo $navClientClass ?> href="/src/carrito.php"
          >Carrito</a
        >
        <a id="nav-link-cart" class=<?php echo $navAdminClass ?> href="/src/gestion-inventario.php"
          >Gestionar inventario</a
        >
        <a id="nav-link-cart" class=<?php echo $navAdminClass ?> href="/src/gestion-compras.php"
          >Gestionar compras</a
        >
        <a id='nav-link-login' class='nav-link' href=<?php echo $navLoginHref ?>
          ><?php echo $navLoginContent ?></a
        >
      </nav>
    </header>
    <main id="inventory-content">
      <ul id=inventory-list>
        <?php
            $index = 0;
            foreach($shoppingCart as $item){
              echo 
                '<a class="inventory-item" href="./articulo.php?itemId=' . $item["id"] . '">
                    <img
                        src=' . $item["imageSource"] . '
                        class="inventory-item-image"
                    />
                    <div class="inventory-item-details">
                        <h2 class="inventory-item-title">' . $item["name"] . '</h2>
                        <p class="inventory-item-price"><b>Precio total:</b> ' . $item["price"] * $item["quantity"] . '€</p>
                        <p class="inventory-item-quantity"><b>Cantidad a comprar:</b> ' . $item["quantity"] . '</p>
                    </div>
                    <div class="inventory-item-control">
                        <form action="../lib/shopcart-management.php" method="post">
                            <input name="cartAction" type="hidden" value="deleteItem">
                            <input name="index" type="hidden" value=' . $index++ . '>
                            <input type="submit" value="Eliminar del carrito">
                        </form>
                    </div>
                </a>';
            }
        ?>
      </ul>
      <form id="purchase-confirm" action="../lib/shopcart-management.php" method="post">
        <input name="cartAction" type="hidden" value="requestPurchase">
        <input type="submit" value="Confirmar compra">
      </form>
      <form id="purchase-cancel" action="../lib/shopcart-management.php" method="post">
        <input name="cartAction" type="hidden" value="cancelPurchase">
        <input type="submit" value="Cancelar">
      </form>
    </main>
</body>
</html>