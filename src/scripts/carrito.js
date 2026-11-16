// petición de quitar del carrito
const deleteButtons = document.querySelectorAll(".action-delete-from-cart");
for (let element of deleteButtons) {
  element.addEventListener("click", async function () {
    const index = this.id;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/shopcart-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`cartAction=deleteItem&index=${index}`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
}

// petición de confirmar compra
document
  .getElementById("action-confirm-purchase")
  .addEventListener("click", async function () {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/shopcart-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`cartAction=requestPurchase`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });

// petición de cancelar compra
document
  .getElementById("action-cancel-purchase")
  .addEventListener("click", async function () {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/shopcart-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`cartAction=cancelPurchase`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
