// botón de logout
document
  .getElementById("action-logout")
  .addEventListener("click", async function () {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/session-control.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("logout=true");
    xhr.onloadend = () => {
      window.location.href = "/";
    };
  });
