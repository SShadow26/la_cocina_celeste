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
    <link href="../../css/normalize.css" rel="stylesheet" type="text/css">
    <title>CRUD de Usuarios Turistas - Actualizar</title>
    <link rel="stylesheet" type="text/css" href="../../css/style_update_turista.css">
</head>
<body>
    <h2>Actualizar Usuario Turista</h2>
    <?php
    // Configuración de la conexión a la base de datos
    $servername = "localhost"; // Nombre del servidor de la base de datos
    $username = "root"; // Nombre de usuario de la base de datos
    $password = "rootCODEANDTECH"; // Contraseña de la base de datos
    $dbname = "cocina_celeste"; // Nombre de la base de datos

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $idUsuario = $_POST["idUsuario"];
        $nomUsuario = $_POST["nomUsuario"];
        $nacTurista = $_POST["nacTurista"];
        $emailUsuario = $_POST["emailUsuario"]; 

         // Consulta para verificar si el usuario existe
        $verificarUsuario = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
        $resultado = $conn->query($verificarUsuario);
 
        if ($resultado !== false) {
            if ($resultado->num_rows == 0) {
                echo "<script>alert('Error: El usuario con ID $idUsuario no existe.');</script>";
            } else {
                // Consulta para actualizar el turista
                $sqlTurista = "UPDATE turista SET nacTurista = '$nacTurista' WHERE idUsuario = $idUsuario";
                
                // Consulta para actualizar el usuario (si se requiere)
                $sqlUsuario = "UPDATE usuario SET nomUsuario = '$nomUsuario', emailUsuario = '$emailUsuario' WHERE idUsuario = $idUsuario";
    
                // Realiza las actualizaciones en ambas tablas
                if ($conn->query($sqlTurista) === TRUE && $conn->query($sqlUsuario) === TRUE) {
                    echo "<script>alert('Usuario y turista actualizados con éxito.');</script>";
                } else {
                    echo "<script>alert('Error al actualizar el usuario o turista: " . $conn->error . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Error al verificar el usuario: " . $conn->error . "');</script>";
        }
    }

    
    $conn->close();
    ?>

    <form method="POST" action="">
        <label for="idUsuario">ID del Usuario Turista:</label>
        <input type="text" name="idUsuario" required>
        <label for="emailUsuario">Nuevo Email:</label>
        <input type="mail" name="emailUsuario" required>
        <label for="nomUsuario">Nuevo Nombre:</label>
        <input type="text" name="nomUsuario" required>
        <label for="nacTurista">Nacionalidad:</label>
        <input type="nacTurista" name="nacTurista" required>
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
