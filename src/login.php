<?php
  session_start();
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
      <a id="nav-link-cart" class="nav-link" href="/src/carrito.php"
        >Carrito</a
      >
      <a id="nav-link-login" class="nav-link" href="/src/login.php"
        >Iniciar sesión</a
      >
    </nav>
  </header>
  <main id="login-content">
    <form id="form-login" action="/lib/user-auth.php" method="post">
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
  </main>
</body>
</html>
