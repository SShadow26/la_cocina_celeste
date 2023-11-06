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
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "rootCODEANDTECH";
    $dbname = "cocina_celeste";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recupera el ID del usuario a eliminate
    $idUsuario = $_POST["idUsuario"];

    // Check if the user is an admin
    $checkAdminQuery = "SELECT * FROM admin WHERE idUsuario = $idUsuario";
    $adminResult = $conn->query($checkAdminQuery);

    if ($adminResult->num_rows > 0) {
        // The user is an admin, so proceed with deletion
        // Query to delete the user from the admin table
        $deleteAdminQuery = "DELETE FROM admin WHERE idUsuario = $idUsuario";

        if ($conn->query($deleteAdminQuery) === TRUE) {
            // After deleting the user from the admin table, you can delete them from the usuario table
            $deleteUserQuery = "DELETE FROM usuario WHERE idUsuario = $idUsuario";

            if ($conn->query($deleteUserQuery) === TRUE) {
                echo "<script>alert('Usuario administrador eliminado con éxito.');</script>";
            } else {
                echo "<script>alert('Error al eliminar el usuario administrador de la tabla `usuario`: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar el usuario administrador de la tabla `admin`: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('El usuario que intenta eliminar no es un admin.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Usuario Admin</title>
    <link rel="stylesheet" type="text/css" href="../../css/style_delete_admin.css">
</head>
<body>
    <h2>Eliminar Usuario Administrador</h2>

    <form method="POST" action="">
        <label for="idUsuario">ID del Usuario a Eliminar:</label>
        <input type="text" name="idUsuario" required>
        <button type="submit" class="btn">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Eliminar
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
