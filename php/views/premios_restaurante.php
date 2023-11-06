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
    <link rel="stylesheet" href="../../css/style_premios.css">
    <title>Panel de Administración | La Cocina Celeste</title>
</head>

<body>
    <h2>Agregar Premios</h2>
    <?php
    // Conectar a la base de datos (asegúrate de establecer la conexión adecuadamente)
    $servername = "localhost";
    $username = "root";
    $password = "rootCODEANDTECH";
    $dbname = "cocina_celeste";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recopilar los datos del formulario
        $estrellaMichelin = $_POST["estrellaMichelin"];
        $tenedorOro = $_POST["tenedorOro"];
        $premioSiri = $_POST["premioSiri"];
        $idUsuario = $_POST["idUsuario"];

        // Consulta para verificar si el usuario existe
        $verificarUsuario = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
        $resultado = $conn->query($verificarUsuario);

        if ($resultado !== false) {
            if ($resultado->num_rows == 0) {
                echo "<script>alert('Error: El usuario con ID $idUsuario no existe.');</script>";
            } else {

                // Insertar los datos en la tabla premios
                $sql = "INSERT INTO premios (estrellaMichelin, tenedorOro, premioSiri) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iii", $estrellaMichelin, $tenedorOro, $premioSiri);
                $stmt->execute();

                // Obtener el ID del premio recién insertado
                $idPremios = $conn->insert_id;

                // Vincular el ID del premio a la tabla restaurante
                $sql = "UPDATE restaurante SET idPremios = ? WHERE idUsuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $idPremios, $idUsuario);
                if ($stmt->execute()) {
                    // Redirigir al usuario de vuelta al formulario o a una página de confirmación
                    header("Location: premios_restaurante.php?success=1");
                } else {
                    // Si hay un error en la actualización, maneja el error adecuadamente
                    echo "Error al vincular el premio al restaurante.";
                }
            }
        }
    }

    $conn->close();
    ?>

    <form method="POST" action="">
        <label for="idUsuario">ID del Restaurante</label>
        <input type="text" name="idUsuario" required>
        <label for="estrellaMichelin">Estrella Michelin:</label>
        <input type="number" name="estrellaMichelin" min="0" max="3" required><br>
        <label for="tenedorOro">Tenedor de Oro:</label>
        <input type="number" name="tenedorOro" min="0" max="3" required><br>
        <label for="premioSiri">Premio Siri:</label>
        <input type="number" name="premioSiri" min="0" max="3" required><br>
        <a type="submit" class="btn" href="javascript:void(0);" onclick="document.getElementById('submitBtn').click();">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Agregar Premios
        </a>
        <button id="btn" href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Volver
        </button>
        <input type="submit" id="submitBtn" value="Enviar solicitud de recuperación" style="display: none;">
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