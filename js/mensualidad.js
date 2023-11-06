var mensual = document.getElementById("mensual");
var anual = document.getElementById("anual");
var dosanios = document.getElementById("dosaños");

mensual.addEventListener("click", function() {
    mensual.classList.add("active");
    anual.classList.remove("active");
    dosanios.classList.remove("active");
});

anual.addEventListener("click", function() {
    mensual.classList.remove("active");
    anual.classList.add("active");
    dosanios.classList.remove("active");
});

dosanios.addEventListener("click", function() {
    mensual.classList.remove("active");
    anual.classList.remove("active");
    dosanios.classList.add("active");
});