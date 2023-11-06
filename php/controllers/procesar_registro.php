<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'conexion.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $emailUsuario = $_POST["mail"];

    // Verifica si el correo electrónico ya existe en la base de datos
    $sql_check = "SELECT idUsuario FROM usuario WHERE emailUsuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $emailUsuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // El correo electrónico ya está registrado, muestra una alerta
        echo "<script>alert('El correo electrónico ya está registrado. Por favor, utiliza otro correo electrónico.')</script>";
        echo "<script>window.location.href = '../../html/login.html';</script>";
        exit;
    } else {
        // El correo electrónico no está registrado, procede con el registro
        $contraUsuario = password_hash($_POST["pass"], PASSWORD_DEFAULT); // Hashea la contraseña

        // Tipo de usuario
        $tipo = $_POST["tipo"];

        // Inserta los datos en la tabla usuario
        $sql = "INSERT INTO usuario (emailUsuario, contraUsuario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $emailUsuario, $contraUsuario);

        if ($stmt->execute()) {
            // Obtiene el ID del usuario recién registrado
            $idUsuario = $stmt->insert_id;

            // Inserta los datos específicos del tipo de usuario en la tabla correspondiente
            if ($tipo === "Turista") {
                $sql = "INSERT INTO turista (idUsuario) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idUsuario);
                $stmt->execute();
            } elseif ($tipo === "Restaurante") {
                // Inserta los datos del restaurante en la tabla restaurante
                $sql = "INSERT INTO restaurante (idUsuario) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idUsuario);
                $stmt->execute();
            }

            // Cierra la conexión a la base de datos
            $conn->close();

            // Redirige al usuario a una página de éxito
            header("Location: ../../html/login.html");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }
    }
}
?>
