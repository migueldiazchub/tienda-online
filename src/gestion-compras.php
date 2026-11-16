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
    <ul id=pending-purchase-list>
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
                '<article id=' . $purchase->_id . ' class="pending-purchase">
                  <p><b>Usuario: </b>' . $userData->username . '</p>
                  <time><b>Fecha: </b>' . $purchase->dateRequested . '</time>
                  <ul>' . 
                    $itemList
                  . '</ul>
                  <p><b>Precio total: </b>' . $priceTotal . '€</p>
                  <button class="action-approve-purchase">
                    Aprobar compra
                  </button>
                  <button class="action-reject-purchase">
                    Rechazar compra
                  </button>
                </article>';
            }
        ?>
    </ul>
    <hr />
    <ul id=resolved-purchase-list>
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
                '<article class="pending-purchase">
                  <p><b>Usuario: </b>' . $userData->username . '</p>
                  <time><b>Fecha de petición: </b>' . $purchase->dateRequested . '</time>
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
    <script src="./scripts/gestion-compras.js"></script>
</body>
</html>