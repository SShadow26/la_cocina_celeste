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
<html>
<head>
    <title>Actualizar Usuario Admin</title>
    <link rel="stylesheet" type="text/css" href="../../css/style_update_admin.css">
</head>
<body>
    <h2>Actualizacion de Usuarios</h2>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el ID del usuario del formulario
    $idUsuario = $_POST["idUsuario"];
    $nuevoEmail = $_POST["nuevoEmail"];
    $nuevoNombre = $_POST["nuevoNombre"];
    
    // Validación básica de los campos
    if (empty($idUsuario) || empty($nuevoEmail) || empty($nuevoNombre)) {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    } else {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "rootCODEANDTECH";
        $dbname = "cocina_celeste";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para verificar si el usuario existe
        $verificarUsuario = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
        $resultado = $conn->query($verificarUsuario);

        if ($resultado !== false) {
            if ($resultado->num_rows == 0) {
                echo "<script>alert('Error: El usuario con ID $idUsuario no existe.');</script>";
            } else {
                // Consulta para actualizar el usuario administrador
                $sql = "UPDATE usuario SET emailUsuario = '$nuevoEmail', nomUsuario = '$nuevoNombre' WHERE idUsuario = $idUsuario";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Usuario actualizado con éxito.');</script>";
                } else {
                    echo "<script>alert('Error al actualizar el usuario: " . $conn->error . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Error al verificar el usuario: " . $conn->error . "');</script>";
        }

        $conn->close();
    }
}
?>
    <form method="POST" action="">
    <label for="idUsuario">ID del Usuario a Actualizar: </label>
        <input type="text" name="idUsuario" required>
        <label for="nuevoEmail">Email a Actualizar: </label>
        <input type="mail" name="nuevoEmail" required>
        <label for="nuevoNombre">Nombre a Actualizar: </label>
        <input type="text" name="nuevoNombre" required>
        <button class="btn" href="#" type="submit">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Actualizar
        </button>
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
