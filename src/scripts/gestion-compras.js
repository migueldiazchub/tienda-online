// petición de aprobar compra
const approveButtons = document.querySelectorAll(".action-approve-purchase");
for (let element of approveButtons) {
  element.addEventListener("click", async function () {
    const id = this.closest("article").id;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/purchase-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`adminAction=approvePurchase&purchaseId=${id}`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
}

// petición de rechazar compra
const rejectButtons = document.querySelectorAll(".action-reject-purchase");
for (let element of rejectButtons) {
  element.addEventListener("click", async function () {
    const id = this.closest("article").id;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/lib/purchase-management.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`adminAction=rejectPurchase&purchaseId=${id}`);
    xhr.onloadend = () => {
      window.location.href = window.location.href;
    };
  });
}
