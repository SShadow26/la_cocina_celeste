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
    <link rel="stylesheet" href="../../css/style_actualizar_datos_restaurante.css">
    <title>Actualizacion de datos de Restaurante</title>
</head>

<body>
    <h2>Modificar Datos de Restaurante</h2>
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "rootCODEANDTECH";
    $dbname = "cocina_celeste";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $idUsuario = $_POST["idUsuario"];
        $nomRestaurante = $_POST["nomRestaurante"];
        $telefono = $_POST["telefono"];
        $tipoRestaurante = $_POST["tipoRestaurante"];
        $emailUsuario = $_POST["emailUsuario"]; 

         // Consulta para verificar si el usuario existe
        $verificarUsuario = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
        $resultado = $conn->query($verificarUsuario);
 
        if ($resultado !== false) {
            if ($resultado->num_rows == 0) {
                echo "<script>alert('Error: El usuario con ID $idUsuario no existe.');</script>";
            } else {
                // Consulta para actualizar el restaurante
                $sqlRestaurante = "UPDATE restaurante SET nomRestaurante = '$nomRestaurante', telefono = '$telefono', tipoRestaurante = '$tipoRestaurante' WHERE idUsuario = $idUsuario";
                
                // Consulta para actualizar el usuario (si se requiere)
                $sqlUsuario = "UPDATE usuario SET nomUsuario = '$nomRestaurante', emailUsuario = '$emailUsuario' WHERE idUsuario = $idUsuario";
    
                // Realiza las actualizaciones en ambas tablas
                if ($conn->query($sqlRestaurante) === TRUE && $conn->query($sqlUsuario) === TRUE) {
                    echo "<script>alert('Usuario y restaurante actualizados con éxito.');</script>";
                } else {
                    echo "<script>alert('Error al actualizar el usuario o restaurante: " . $conn->error . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Error al verificar el usuario: " . $conn->error . "');</script>";
        }
    }

    
    $conn->close();
    ?>
    <form method="POST" action="">
        <label for="idUsuario">ID del Usuario a Actualizar:</label>
        <input type="text" name="idUsuario" required>
        <label for="nomRestaurante">Nuevo Nombre:</label>
        <input type="text" name="nomRestaurante" required>
        <label for="emailUsuario">Nuevo Email:</label>
        <input type="mail" name="emailUsuario" required>
        <label for="telefono">Nuevo Teléfono:</label>
        <input type="text" name="telefono" required>
        <label for="tipoRestaurante">Nuevo Tipo de Restaurante:</label>
        <select name="tipoRestaurante">
            <option value="restaurante buffet">Restaurante Buffet</option>
            <option value="restaurante de comida rapida y casual">Restaurante de Comida Rápida y Casual</option>
            <option value="restaurante de autor">Restaurante de Autor</option>
            <option value="restaurante de comida rapida">Restaurante de Comida Rápida</option>
            <option value="restaurante gourmet">Restaurante Gourmet</option>
            <option value="restaurante tematico">Restaurante Temático</option>
            <option value="restaurante para llevar">Restaurante para Llevar</option>
        </select>
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
            window.location.href = "../models/panel_restaurante.php";
        });
    </script>

</body>

</html>