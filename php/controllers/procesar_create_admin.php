<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion']; // Acción a realizar (crear, actualizar, eliminar)

    // Conexión a la base de datos (debes definir tus propios valores)
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = 'rootCODEANDTECH';
    $db_name = 'cocina_celeste';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nomUsuario = isset($_POST['nomUsuario']) ? $_POST['nomUsuario'] : '';
    $emailUsuario = isset($_POST['emailUsuario']) ? $_POST['emailUsuario'] : '';
    $nroEmpleado = isset($_POST['nroEmpleado']) ? $_POST['nroEmpleado'] : '';
    $contraUsuario = isset($_POST['contraUsuario']) ? password_hash($_POST['contraUsuario'], PASSWORD_DEFAULT) : '';

    if ($contraUsuario === false) {
        die("Error al hashear la contraseña.");
    }

    if ($accion === 'crear') {
        // Procesar la creación de un usuario administrador
        $nomUsuario = $_POST['nomUsuario'];
        $emailUsuario = $_POST['emailUsuario'];

        // Realizar una consulta SQL INSERT para agregar el usuario a la tabla `usuario`
        $sql_usuario = "INSERT INTO usuario (emailUsuario, contraUsuario, nomUsuario) VALUES ('$emailUsuario', '$contraUsuario', '$nomUsuario')";
        
        if ($conn->query($sql_usuario) === TRUE) {
            // Obtener el ID del usuario recién creado
            $idUsuario = $conn->insert_id;

            $nroEmpleado = $_POST['nroEmpleado']; // Agrega este campo para el administrador

            // Realizar una consulta SQL INSERT para agregar el administrador a la tabla `admin`
            $sql_admin = "INSERT INTO admin (idUsuario, nroEmpleado) VALUES ($idUsuario, $nroEmpleado)";
            
            if ($conn->query($sql_admin) === TRUE) {
                echo "<script>alert('Usuario Administrador creado con éxito.');</script>";
                echo "<script>window.location.href = '../models/panel_admin.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error al crear a el Usuario Adminstrador: " . $conn->error . "');</script>";
            }
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }
    } 
    
    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
