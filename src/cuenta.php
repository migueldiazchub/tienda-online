<?php
  require "../lib/db.php";
  include "../lib/session-control.php";

  $userIdString = (string) $_SESSION["userId"];
  $purchaseHistory = getUserPurchases($userIdString);
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
    <?php
        echo $_SESSION["userId"] , "<br>";
        echo $_SESSION["username"];
    ?>
    <ul id=purchase-history>
        <?php
            foreach($purchaseHistory as $purchase){
              $state = "";
              if($purchase->state == "pending"){
                $state = "Pendiente";
              } elseif($purchase->state == "confirmed"){
                $state = "Confirmada";
              } elseif($purchase->state == "rejected"){
                $state = "Rechazada";
              }
              $itemList = "";
              foreach($purchase->items as $item){
                      $itemData = getItemById($item->item_id);
                      $itemList = $itemList .
                        '<li>
                          <p><b>Artículo: </b>' . $itemData->name . '</p>
                          <p><b>Cantidad: </b>' . $item->quantity . '</p>
                        </li>';
                    }

              echo 
                '<article class="pending-purchase">
                  <p><b>Estado: </b>' . $state . '</p>
                  <time><b>Fecha: </b>' . $purchase->dateRequested . '</time>
                  <ul>' . 
                    $itemList
                  . '</ul>
                  <p><b>Precio total: </b>€</p>
                </article>';
            }
        ?>        
    </ul>
    <form id="logout" action="/lib/session-control.php" method="post">
      <input name="logout" type="hidden" value="true">
      <input type="submit" value="logout">
    </form>
</body>
</html>