<?php
  session_start();

  require "../lib/db.php";

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
      <figure>
        <a class="nav-link" href="/">Inicio</a>
      </figure>
      <nav>
        <a class="nav-link" href="/src/tienda.php">Tienda</a>
        <a class="nav-link" href="/src/contacto.php">Contacto</a>
        <a id="nav-link-cart" class="nav-link" href="/src/carrito.php"
          >Carrito</a
        >
        <a id="nav-link-login" class="nav-link" href="/src/login.php"
          >Iniciar sesión</a
        >
      </nav>
    </header>
    <main id="item-page">
      <section id="item-content">
        <img
          src=<?php echo $item->imageSource ?>
          id="item-page-image"
        />
        <section id="item-page-details">
          <h2 id="item-page-title">
            <?php echo $item->name ?>
          </h2>
          <p id="item-page-price-unit">
            Precio por unidad: <?php echo $item->price ?>€
          </p>
          <p id="item-page-quantity">
            <?php echo $item->quantity ?>
          </p>
          <form id="item-purchase-form" action="./tienda.php" method="post">
            <div id="item-quantity-control">
              <button
                onclick="lowerQuantity()"
                class="quantity-change-button"
                type="button"
              >
                -
              </button>
              <input
                id="quantity-input"
                name="quantity"
                type="number"
                value="0"
                min="0"
                max=<?php echo $item->quantity ?>
                readonly
              />
              <button
                onclick="raiseQuantity()"
                class="quantity-change-button"
                type="button"
              >
                +
              </button>
            </div>
            <div id="item-purchase-control">
              <button
                type="button"
                onclick="cancel()"
              >
                Cancelar
              </button>
              <button type="submit">Añadir al carrito</button>
            </div>
          </form>
        </section>
      </section>
    </main>
    <script>
      //PENDING
      function setTotalPrice(){}

      function lowerQuantity() {
        const quantity = document.getElementById("quantity-input");
        if (quantity.value > 0) {
          quantity.value--;
        }
      }

      function raiseQuantity() {
        const quantity = document.getElementById("quantity-input");
        if(quantity.value < parseInt(quantity.max)){
          quantity.value++;
        }
      }

      function cancel(){
        window.location.href = "./tienda.php";
      }
    </script>
  </body>
</html>
