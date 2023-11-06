// Datos de ejemplo (puedes reemplazar esto con tus propios datos)
const elementos = [
  "Elemento 1",
  "Elemento 2",
  "Elemento 3",
  "Elemento 4",
  "Elemento 5",
  "Elemento 6",
  "Elemento 7",
  "Elemento 8",
  "Elemento 9",
  "Elemento 10",
];
const elementosPorPagina = 3;

// Obtener elementos del DOM
const elementList = document.getElementById("element-list");
const pagination = document.getElementById("pagination");

let paginaActual = 1;

function mostrarElementos() {
  const inicio = (paginaActual - 1) * elementosPorPagina;
  const fin = inicio + elementosPorPagina;
  const elementosPagina = elementos.slice(inicio, fin);

  elementList.innerHTML = "";
  elementosPagina.forEach((elemento) => {
    const li = document.createElement("li");
    li.textContent = elemento;
    elementList.appendChild(li);
  });

  mostrarControlesPaginacion();
}

function mostrarControlesPaginacion() {
  const totalPaginas = Math.ceil(elementos.length / elementosPorPagina);

  pagination.innerHTML = "";

  for (let i = 1; i <= totalPaginas; i++) {
    const button = document.createElement("button");
    button.textContent = i;
    button.className = "pagination-button";

    if (i === paginaActual) {
      button.classList.add("active");
    }

    button.addEventListener("click", () => {
      paginaActual = i;
      mostrarElementos();
    });

    pagination.appendChild(button);
  }
}

// Mostrar elementos en la página inicial
mostrarElementos();
