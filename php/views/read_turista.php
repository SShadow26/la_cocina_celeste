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
    <title>CRUD de Usuarios Turista</title>
    <link rel="stylesheet" type="text/css" href="../../css/style_read_turista.css">
</head>

<body>
    <h2>Listar Usuarios Turista</h2>
    <form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nacionalidad</th>
                <th>Nombre</th>
            </tr>

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

            // Consulta para obtener los usuarios restaurantes de la tabla 'usuario' y 'restaurante'
            $sql = "SELECT u.idUsuario, nacTurista, nomUsuario FROM usuario u 
                INNER JOIN turista r ON u.idUsuario = r.idUsuario";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idUsuario"] . "</td>";
                    echo "<td>" . $row["nacTurista"] . "</td>";
                    echo "<td>" . $row["nomUsuario"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron usuarios restaurantes.</td></tr>";
            }

            $conn->close();
            ?>

        </table>

        <button id="btn">
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
        boton.addEventListener("click", function() {
            // Redirigir a la otra página dentro del mismo archivo
            window.location.href = "../models/panel_admin.php";
        });
    </script>
</body>

</html>
