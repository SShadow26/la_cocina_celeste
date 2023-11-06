<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "rootCODEANDTECH";
$dbname = "cocina_celeste";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico del formulario
    $email = $_POST['email'];

    // Verificar si el correo electrónico existe en la base de datos
    $sql = "SELECT * FROM usuario WHERE emailUsuario = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generar un enlace temporal para restablecer la contraseña 
        $token = bin2hex(random_bytes(16));
        // Guardar el token en la base de datos junto con la fecha de expiración 
        $sql = "UPDATE usuario SET reset_token = '$token', reset_token_expiration = NOW() + INTERVAL 1 HOUR WHERE emailUsuario = '$email'";
        $conn->query($sql);

        // Enviar un correo electrónico con el enlace de restablecimiento 
        $reset_link = "https://lacocina-celeste.vercel.app/reset_password.php?token=$token";
        // Envía el correo con el enlace de restablecimiento

        // Redirige al usuario a una página de confirmación
        echo '<script>alert("Tu solicitud de recuperación de contraseña ha sido procesada.");</script>';
        echo '<script>window.location.href="../../html/login.html";</script>';
        exit;
    } else {
        // El correo electrónico no se encontró en la base de datos, muestra un mensaje de error
        echo '<script>alert("El correo electrónico no está registrado en nuestro sistema.");</script>';
        echo '<script>window.location.href="../../html/login.html";</script>';
        exit;
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>