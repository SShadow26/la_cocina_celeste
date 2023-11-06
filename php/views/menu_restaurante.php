<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['idUsuario'])) {
    echo '
    <script>
        alert("Por favor debes iniciar sesión");
        window.location = "../../html/login.html";
    </script>
    ';
    session_destroy();
    die();
} else {
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/normalize.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style_create_menu.css">
    <title>Actualizacion de datos de Restaurante</title>
</head>

<body>
    <h2>Creacion de Menus</h2>
    <form method="post" action="../controllers/procesar_crear_menu.php" class="table">
        <input type="hidden" name="accion" value="crear">

        <label for="nombreMenu">Menu:</label>
        <input type="text" name="nombreMenu" required><br>

        <label for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" required><br>

        <label for="costoMenu">Costo:</label>
        <input type="number" name="costoMenu" required><br>

        <a type="submit" class="btn" href="javascript:void(0);" onclick="document.getElementById('submitBtn').click();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Crear Menu
        </a>
        <input type="submit" id="submitBtn" value="Crear Usuario Administrador" style="display: none;">


        <button id="btn" href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Volver
        </button>
    </form>

    <script>
        // Obtener el botón por su ID
        var boton = document.getElementById("btn");

        // Agregar un evento de clic al botón
        boton.addEventListener("click", function () {
            // Redirigir a la otra página dentro del mismo archivo
            window.location.href = "../models/panel_restaurante.php";
        });
    </script>
</body>
</html>