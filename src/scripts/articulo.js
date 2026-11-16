//PENDING
function setTotalPrice() {}

document
  .getElementById("quantity-input")
  .addEventListener("change", function () {
    console.log("change");
    const button = document.getElementById("action-add-to-cart");
    if (this.value == 0) {
      button.disabled = true;
    } else {
      button.disabled = false;
    }
  });

document
  .getElementById("item-quantity-lower")
  .addEventListener("click", function () {
    const quantity = document.getElementById("quantity-input");
    if (quantity.value > 0) {
      if (--quantity.value == 0) {
        document.getElementById("action-add-to-cart").disabled = true;
      }
    }
  });

document
  .getElementById("item-quantity-raise")
  .addEventListener("click", function () {
    const quantity = document.getElementById("quantity-input");
    if (quantity.value < parseInt(quantity.max)) {
      if (++quantity.value != 0) {
        document.getElementById("action-add-to-cart").disabled = false;
      }
    }
  });

document
  .getElementById("action-cancel-item")
  .addEventListener("click", function () {
    window.location.href = "./tienda.php";
  });

// petición de añadir al carrito
document
  .getElementById("action-add-to-cart")
  .addEventListener("click", async function () {
    const itemid = new URLSearchParams(document.location.search).get("itemId");
    const quantity = document.getElementById("quantity-input").value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/shopcart-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`cartAction=addItem&itemid=${itemid}&quantity=${quantity}`);
    xhr.onloadend = () => {
      window.location.href = "/src/carrito.php";
    };
  });
