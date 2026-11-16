<?php
  include "../lib/session-control.php";
?>

<!doctype html>
<html lang="en">
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
  <main id="login-content">
    <form id="auth-form" class="login-form" action="/lib/user-auth.php" method="post">
      <label class="login-label">
        Nombre de usuario:
        <input
          class="login-input"
          name="username"
          type="text"
          placeholder="Escribe tu nombre de usuario..."
          required
        />
      </label>
      <label class="login-label">
        Contraseña:
        <input
          class="login-input"
          name="password"
          type="password"
          placeholder="Escribe tu contraseña..."
          required
        />
      </label>
      <input
        id="login-submit"
        class="login-input"
        type="submit"
        value="Iniciar sesión"
      />
    </form>
    <form id="signup-form" class="login-form hidden" action="/lib/user-signup.php" method="post">
    <label class="login-label">
        Nombre de usuario:
        <input
          class="login-input"
          name="username"
          type="text"
          placeholder="Escoge tu nombre de usuario..."
          required
        />
      </label>
      <label class="login-label">
        Correo electrónico: 
        <input
          class="login-input"
          name="email"
          type="text"
          placeholder="Escribe tu correo electrónico..."
          required
        />
      </label>
      <label class="login-label">
        Contraseña:
        <input
          class="login-input"
          name="password"
          type="password"
          placeholder="Escribe tu contraseña..."
          required
        />
      </label>
      <label class="login-label">
        Confirmar contraseña: 
        <input
          class="login-input"
          type="password"
          placeholder="Escribe tu contraseña de nuevo..."
          required
        />
      </label>
      <input
        id="login-submit"
        class="login-input"
        type="submit"
        value="Registrarse"
      />
    </form>
    <button id="login-type-switch" value="signup" onclick="switchLoginType()">Registrarse</button>
  </main>
  <!-- <script src="../lib/validate-client-login.js"></script> -->
  <script>
    function switchLoginType(){
      const switchButton = document.getElementById("login-type-switch");
      if(switchButton.value == "signup"){
        document.getElementById("auth-form").classList.toggle("hidden");
        document.getElementById("signup-form").classList.toggle("hidden");
        switchButton.value = "login";
        switchButton.textContent = "Iniciar sesión";
      } else if(switchButton.value == "login"){
        document.getElementById("auth-form").classList.toggle("hidden");
        document.getElementById("signup-form").classList.toggle("hidden");
        switchButton.value = "signup";
        switchButton.textContent = "Registrarse";
      }
    }
  </script>
</body>
</html>
