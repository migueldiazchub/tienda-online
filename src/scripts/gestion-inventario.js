function stockControlSwitch(e) {
  e.target
    .closest("article")
    .querySelector(".inventory-item-control")
    .classList.toggle("hidden");
  e.target
    .closest("article")
    .querySelector(".item-stock-control")
    .classList.toggle("hidden");
}

function lowerStock(e) {
  const quantity = e.target.closest("section").querySelector(".stock-change");
  quantity.value--;
}

function raiseStock(e) {
  const quantity = e.target.closest("section").querySelector(".stock-change");
  quantity.value++;
}

const stockControlStart = document.querySelectorAll(".switch-to-stock-control");
for (let element of stockControlStart) {
  element.addEventListener("click", stockControlSwitch);
}

const stockControlCancel = document.querySelectorAll(
  ".action-stock-change-cancel",
);
for (let element of stockControlCancel) {
  element.addEventListener("click", stockControlSwitch);
}

const stockControlLower = document.querySelectorAll(".stock-lower-button");
for (let element of stockControlLower) {
  element.addEventListener("click", lowerStock);
}

const stockControlRaise = document.querySelectorAll(".stock-raise-button");
for (let element of stockControlRaise) {
  element.addEventListener("click", raiseStock);
}

// petición de modificar stock
const stockControlConfirm = document.querySelectorAll(
  ".action-stock-change-confirm",
);
for (let element of stockControlConfirm) {
  element.addEventListener("click", async function () {
    const id = this.closest("article").id;
    const quantity =
      this.closest("section").querySelector(".stock-change").value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/inventory-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`adminAction=updateStock&itemid=${id}&stockquantity=${quantity}`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
}

// petición de eliminar artículo
const deleteButtons = document.querySelectorAll(
  ".action-delete-from-inventory",
);
for (let element of deleteButtons) {
  element.addEventListener("click", async function () {
    const id = this.closest("article").id;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/inventory-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`adminAction=deleteItem&itemid=${id}`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
}
