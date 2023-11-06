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
    <meta name="keywords" content="reseñas gastronómicas, restaurantes, experiencias culinarias, La Cocina Celeste">
    <meta name="author" content="Arias Web Designers">
    <meta name="description" content="Explora reseñas gastronómicas de restaurantes y descubre nuevas experiencias culinarias en La Cocina Celeste.">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="La Cocina Celeste - Donde cada plato tiene su historia"/>
    <meta property="og:description" content="Explora reseñas gastronómicas de restaurantes y descubre nuevas experiencias culinarias en La Cocina Celeste.">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="resources/img/LaCocinaCeleste.png" type="image/x-icon">
    <link href="../../css/normalize.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/style_create_admin.css">
    <title>Create Administradores</title>
</head>
<body>
    <h2>Crear Usuario Administrador</h2>
    <form method="post" action="../controllers/procesar_create_admin.php" class="table">
        <input type="hidden" name="accion" value="crear">

        <label for="nomUsuario">Nombre:</label>
        <input type="text" name="nomUsuario" required><br>

        <label for="emailUsuario">Email:</label>
        <input type="email" name="emailUsuario" required><br>

        <label for="contraUsuario">Contraseña:</label>
        <input type="password" name="contraUsuario" required><br>

        <label for="nroEmpleado">Número de Empleado:</label>
        <input type="text" name="nroEmpleado" required><br>

        <a type="submit" class="btn" href="javascript:void(0);" onclick="document.getElementById('submitBtn').click();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Crear
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
            window.location.href = "../models/panel_admin.php";
        });
    </script>
</body>
</html>
