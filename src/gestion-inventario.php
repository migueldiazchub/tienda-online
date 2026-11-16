<?php
  require "../lib/db.php";
  include "../lib/session-control.php";
  //no estar logeado como admin da un error 404 para ocultar el recurso
  //en caso de entrar mediante la url
  if(!$isAdmin){
    http_response_code(404);
    die();
  }

  $itemList = getItems();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de inventario</title>
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
    <main id="inventory-content">
      <form action="../lib/inventory-management.php" method="post">
        <input name="adminAction" type="hidden" value="addItem">
        <input name="itemname" type="text" placeholder="name" required>
        <input name="itemprice" type="text" placeholder="price" required>
        <input name="itemquantity" type="text" placeholder="quantity" required>
        <input name="imagesource" type="text" placeholder="imageSource" required>
        <input type="submit">
      </form>
      <ul id=inventory-list>
        <?php
            foreach($itemList as $item){
              echo 
                '<article id=' . $item->_id . ' class="inventory-item">
                    <img
                        src=' . $item->imageSource . '
                        class="inventory-item-image"
                    />
                    <div class="inventory-item-details">
                        <p class="inventory-item-id"><b>ID:</b> ' . $item->_id . '</p>
                        <p class="inventory-item-title"><b>Nombre:</b> ' . $item->name . '</p>
                        <p class="inventory-item-price"><b>Precio:</b> ' . $item->price . '€</p>
                        <p class="inventory-item-quantity"><b>Stock:</b> ' . $item->quantity . '</p>
                    </div>
                    <div class="inventory-item-control">
                        <button class="action-delete-from-inventory">
                            Eliminar
                        </buton>
                    </div>
                </article>';
            }
        ?>
      </ul>
    </main>
    <script src="./scripts/gestion-inventario.js"></script>
  </body>
</html>
