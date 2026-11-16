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
