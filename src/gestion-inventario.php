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
    <main id="inventory-content">
      <form id="inventory-addition-form" action="../lib/inventory-management.php" method="post">
        <h2 id="inventory-addition-title">Añadir artículo: </h2>
        <input name="adminAction" type="hidden" value="addItem">
        <label class="inventory-addition-label">
          Nombre del artículo
          <input class="inventory-addition-input" name="itemname" type="text" placeholder="nombre" required>
        </label>
        <label class="inventory-addition-label">
          Precio del artículo
          <input class="inventory-addition-input" name="itemprice" type="text" placeholder="precio" required>
        </label>
        <label class="inventory-addition-label">
          Cantidad a añadir
          <input class="inventory-addition-input" name="itemquantity" type="text" placeholder="stock" required>
        </label>
        <label class="inventory-addition-label">
          URL de la imagen
          <input class="inventory-addition-input" name="imagesource" type="text" placeholder="url de imagen" required>
        </label>
        <input id="inventory-addition-submit" class="inventory-addition-input" type="submit" value="Añadir artículo">
      </form>
      <ul id=inventory-list>
        <?php
            foreach($itemList as $item){
              echo 
                '<article id=' . $item->_id . ' class="inventory-item">
                    <section class="inventory-item-info">
                      <img
                          src=' . $item->imageSource . '
                          class="inventory-item-image"
                      />
                      <section class="inventory-item-details">
                          <p class="inventory-item-id"><b>ID:</b> ' . $item->_id . '</p>
                          <p class="inventory-item-title"><b>Nombre:</b> ' . $item->name . '</p>
                          <p class="inventory-item-price"><b>Precio:</b> ' . $item->price . '€</p>
                          <p class="inventory-item-quantity"><b>Stock:</b> ' . $item->quantity . '</p>
                      </section>
                    </section>
                    <section class="inventory-control inventory-item-control">
                        <button class="switch-to-stock-control">
                            Modificar stock
                        </buton>
                        <button class="action-delete-from-inventory">
                            Eliminar
                        </buton>
                    </section>
                    <section class="inventory-control item-stock-control hidden">
                        <div class="item-stock-quantity-control">
                          <button
                            class="stock-lower-button"
                          >
                            -
                          </button>
                            <input
                              class="stock-change"
                              name="stockquantity"
                              type="number"
                              value="0"
                              readonly
                            />
                          <button
                            class="stock-raise-button"
                          >
                            +
                          </button>
                        </div>
                        <div class="stock-change-confirmation-control">
                          <button
                            class="action-stock-change-cancel"
                          >
                            Cancelar
                          </button>
                          <button class="action-stock-change-confirm">Modificar stock</button>
                        </div>
                    </section>
                </article>';
            }
        ?>
      </ul>
    </main>
    <script src="./scripts/gestion-inventario.js"></script>
  </body>
</html>
