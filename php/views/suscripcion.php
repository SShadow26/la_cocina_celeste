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
    <link rel="stylesheet" href="../../css/style_suscripcion.css">
    <title>Panel de Restaurante | La Cocina Celeste</title>
</head>

<body>

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
    // Recopila los datos del formulario
    $idUsuario = $_POST["idUsuario"];
    $precioSus = $_POST["precioSus"];
    $aprobacion = false;

    // Verifica si el usuario es un restaurante
    $verificarUsuario = "SELECT * FROM restaurante WHERE idUsuario = $idUsuario";
    $resultado = $conn->query($verificarUsuario);

    if ($resultado !== false) {
        if ($resultado->num_rows == 0) {
            echo "<script>alert('Error: El usuario con ID $idUsuario no es un restaurante.');</script>";
        } else {
            // Define $aprobacion basado en alguna condición (debes establecer esta condición según tus necesidades)
            $aprobacion = true; // o false dependiendo de tu lógica

            // Inserta la solicitud pendiente en la tabla
            $sql = "INSERT INTO suscripcion (idUsuario, precioSus, aprobacion) VALUES ('$idUsuario', '$precioSus', " . ($aprobacion ? '0' : '1') . ")";

            if ($conn->query($sql) === TRUE) {
                // Obtener el idSuscripcion recién insertado
                $idSuscripcion = $conn->insert_id;

                // Actualizar la fila en la tabla restaurante con el idSuscripcion
                $updateRestaurante = "UPDATE restaurante SET idSuscripcion = $idSuscripcion WHERE idUsuario = $idUsuario";
                if ($conn->query($updateRestaurante) === TRUE) {
                    echo "<script>alert('Solicitud enviada con éxito. Espere la aprobación del administrador.');</script>";
                    echo "<script>window.location.href = '../models/panel_restaurante.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Error al actualizar el restaurante.');</script>";
                }
            }
        }
    }
    $conn->close();
}
?>

    
    <form method="post" action="">
        <label for="idUsuario">ID del Restaurante</label>
        <input type="text" name="idUsuario" required>
        <label for="precioSus">Seleccione una suscripción:</label>
        <select name="precioSus" required>
            <option value="1">Suscripción 1 mes - $9.99</option>
            <option value="2">Suscripción 1 año - $99.99</option>
            <option value="3">Suscripción 2 años- $149.99</option>
        </select>
        <a type="submit" class="btn" href="javascript:void(0);" onclick="document.getElementById('submitBtn').click();">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Solicitar Suscripcion
        </a>
        <button id="boton" href="#">
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
        var boton = document.getElementById("boton");

        // Agregar un evento de clic al botón
        boton.addEventListener("click", function () {
            // Redirigir a la otra página dentro del mismo archivo
            window.location.href = "../models/panel_restaurante.php";
        });
    </script>

</body>

</html>