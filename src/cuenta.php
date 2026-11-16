<?php
  require "../lib/db.php";
  include "../lib/session-control.php";

  $userIdString = (string) $_SESSION["userId"];
  $purchaseHistory = null;
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
    <?php
        echo $_SESSION["userId"] , "<br>";
        echo $_SESSION["username"];
    ?>
    <ul id=purchase-history>
        <?php
            if(!$isAdmin){
              $purchaseHistory = getUserPurchases($userIdString);
              foreach($purchaseHistory as $purchase){                
                $state = "";
                $dateInfo = "";
                $dateAsked = "dateResolved";
                if($purchase->state == "pending"){
                  $state = "Pendiente";
                  $dateInfo = " de petición";
                  $dateAsked = "dateRequested";
                } elseif($purchase->state == "confirmed"){
                  $state = "Confirmada";
                  $dateInfo = " de confirmación";
                } elseif($purchase->state == "rejected"){
                  $state = "Rechazada";
                  $dateInfo = " de rechazo";
                }

                $itemList = "";
                $priceTotal = 0;
                foreach($purchase->items as $item){
                        $itemData = getItemById($item->item_id);
                        $itemList = $itemList .
                          '<li>
                            <p><b>Artículo: </b>' . $itemData->name . '</p>
                            <p><b>Cantidad: </b>' . $item->quantity . '</p>
                          </li>';
                        $priceTotal += $itemData->price * $item->quantity;
                      }

                echo 
                  '<article class="pending-purchase">
                    <p><b>Estado: </b>' . $state . '</p>
                    <time><b>Fecha' . $dateInfo . ': </b>' . $purchase->dateRequested . '</time>
                    <ul>' . 
                      $itemList
                    . '</ul>
                    <p><b>Precio total: </b>' . $priceTotal . '€</p>
                  </article>';
              }
            }
        ?>        
    </ul>
    <button id="action-logout">Logout</button>
    <script src="./scripts/cuenta.js"></script>
</body>
</html>