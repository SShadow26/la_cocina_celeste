<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Iniciar la sesión si no está iniciada
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "rootCODEANDTECH";
$database = "cocina_celeste";

$conn = new mysqli($servername, $username, $password, $database);

// Comprueba si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Captura los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para verificar las credenciales del usuario
$sql = "SELECT idUsuario, nomUsuario, contraUsuario FROM usuario WHERE emailUsuario = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['contraUsuario'];

    // Verificar la contraseña
    if (password_verify($password, $hashedPassword)) {
        // Inicio de sesión exitoso
        $_SESSION['idUsuario'] = $row['idUsuario'];
        $_SESSION['nomUsuario'] = $row['nomUsuario'];

        // Redirige a la página correspondiente
        if (isset($_SESSION['idUsuario'])) {
            // Verificar si es un administrador
            $sqlAdmin = "SELECT idUsuario FROM admin WHERE idUsuario = " . $_SESSION['idUsuario'];
            $resultAdmin = $conn->query($sqlAdmin);

            if ($resultAdmin->num_rows > 0) {
                header("Location: panel_admin.php");
            } else {
                // Verificar si es un restaurante
                $sqlRestaurante = "SELECT idUsuario FROM restaurante WHERE idUsuario = " . $_SESSION['idUsuario'];
                $resultRestaurante = $conn->query($sqlRestaurante);

                if ($resultRestaurante->num_rows > 0) {
                    header("Location: panel_restaurante.php");
                } else {
                    // Si no es admin ni restaurante, es turista
                    header("Location: panel_turista.php");
                }
            }
        }
    } else {
        // Contraseña incorrecta
        echo '<script>alert("Contraseña incorrecta");</script>';
        echo "<script>window.location.href = '../../html/login.html';</script>";
        exit;
    }
} else {
    // Usuario no encontrado
    echo '<script>alert("Usuario no encontrado");</script>';
    echo "<script>window.location.href = '../../html/login.html';</script>";
    exit;
}

$conn->close();
?>
