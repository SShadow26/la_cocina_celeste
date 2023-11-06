const sideMenu = document.querySelector("aside");
const menuBtn = document.getElementById("menu-btn");
const closeBtn = document.getElementById("close-btn");

const darkMode = document.querySelector(".dark-mode");

menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

darkMode.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode-variables");
  darkMode.querySelector("span:nth-child(1)").classList.toggle("active");
  darkMode.querySelector("span:nth-child(2)").classList.toggle("active");
});

Orders.forEach((order) => {
  const tr = document.createElement("tr");
  const trContent = `
        <td>${order.productName}</td>
        <td>${order.productNumber}</td>
        <td>${order.paymentStatus}</td>
        <td class="${
          order.status === "Declined"
            ? "danger"
            : order.status === "Pending"
            ? "warning"
            : "primary"
        }">${order.status}</td>
        <td class="primary">Details</td>
    `;
  tr.innerHTML = trContent;
  document.querySelector("table tbody").appendChild(tr);
});


function redirigir() {
  var operacion = document.getElementById("operacion").value;
  switch (operacion) {
      case "create":
          window.location.href = "../views/create_admin.php";
          break;
      case "read":
          window.location.href = "../views/read_admin.php";
          break;
      case "update":
          window.location.href = "../views/update_admin.php";
          break;
      case "delete":
          window.location.href = "../views/delete_admin.php";
          break;
      case "read_resta":
          window.location.href = "../views/read_restaurante.php";
          break;
      case "update_resta":
          window.location.href = "../views/update_restaurante.php";
          break;
      case "read_turis":
          window.location.href = "../views/read_turista.php";
          break;
      case "update_turis":
          window.location.href = "../views/update_turista.php";
          break;
      default:
          // Manejo de errores o acción por defecto si es necesario
          break;
  }
}