function switchLoginType() {
  const switchButton = document.getElementById("login-type-switch");
  if (switchButton.value == "signup") {
    document.getElementById("auth-form").classList.toggle("hidden");
    document.getElementById("signup-form").classList.toggle("hidden");
    switchButton.value = "login";
    switchButton.textContent = "Iniciar sesión";
  } else if (switchButton.value == "login") {
    document.getElementById("auth-form").classList.toggle("hidden");
    document.getElementById("signup-form").classList.toggle("hidden");
    switchButton.value = "signup";
    switchButton.textContent = "Registrarse";
  }
}
