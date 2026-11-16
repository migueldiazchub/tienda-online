<?php
  require "../lib/db.php";
  include "../lib/session-control.php";
  //no estar logeado como admin da un error 404 para ocultar el recurso
  //en caso de entrar mediante la url
  if(!$isAdmin){
    http_response_code(404);
    die();
  }

  $pendingPurchases = getPendingPurchases();
  $resolvedPurchases = getResolvedPurchases();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Compras pendientes</title>
    <link rel="stylesheet" href="./styles/style.css">
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
    <main id="purchases-content">
      <ul id="pending-purchase-list" class="purchase-list">
          <?php
              foreach($pendingPurchases as $purchase){
                $userData = getUserById($purchase->user_id);

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
                  '<article id=' . $purchase->_id . ' class="purchase-made pending-purchase">
                    <section class="purchase-info">
                      <p><b>Usuario: </b>' . $userData->username . '</p>
                      <time><b>Fecha: </b>' . $purchase->dateRequested . '</time>
                      <ul>' . 
                        $itemList
                      . '</ul>
                      <p><b>Precio total: </b>' . $priceTotal . '€</p>
                    </section>
                    <section class="purchase-actions">
                      <button class="action-approve-purchase purchase-action">
                        Aprobar compra
                      </button>
                      <button class="action-reject-purchase purchase-action">
                        Rechazar compra
                      </button>
                    </section>
                  </article>';
              }
          ?>
      </ul>
      <hr class="separator" />
      <ul id="resolved-purchase-list" class="purchase-list">
          <?php
              foreach($resolvedPurchases as $purchase){
                $userData = getUserById($purchase->user_id);

                $resolveState = "";
                if($purchase->state == "confirmed"){
                  $resolveState = "Confirmada";
                } elseif($purchase->state == "rejected"){
                  $resolveState = "Rechazada";
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
                  '<article class="purchase-made">
                    <p><b>Usuario: </b>' . $userData->username . '</p>
                    <time><b>Fecha de petición: </b>' . $purchase->dateRequested . '</time>
                    |
                    <time><b>Fecha de resolución: </b>' . $purchase->dateResolved . '</time>
                    <ul>' . 
                      $itemList
                    . '</ul>
                    <p><b>Precio total: </b>' . $priceTotal . '€</p>
                    <p><b>Estado: </b>' . $resolveState . '</p>
                  </article>';
              }
          ?>
      </ul>
    </main>
    <script src="./scripts/gestion-compras.js"></script>
</body>
</html>