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
    <title>Tus Reseñas</title>
    <link rel="stylesheet" type="text/css" href="../../css/style_read_resena.css">
</head>

<body>
    <h2>Tus Reseñas</h2>
    <form>
        <table>
            <tr>
                <th>Fecha de Reseña</th>
                <th>Id del Restaurante</th>
                <th>Calificación General</th>
                <th>Calificación del Recinto</th>
                <th>Calificación del Menu</th>
                <th>Calificación del Personal</th>
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

            // Consulta para obtener las reseñas del usuario turista
            $idUsuario = $_SESSION['idUsuario'];
            $sql = "SELECT fechaResenia, idUsuarioR, caliGeneral, caliRecinto, caliMenu, caliPersonal FROM resenia WHERE idUsuarioT = $idUsuario";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["fechaResenia"] . "</td>";
                    echo "<td>" . $row["idUsuarioR"] . "</td>";
                    echo "<td>" . $row["caliGeneral"] . "</td>";
                    echo "<td>" . $row["caliRecinto"] . "</td>";
                    echo "<td>" . $row["caliMenu"] . "</td>";
                    echo "<td>" . $row["caliPersonal"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No has realizado reseñas aún.</td></tr>";
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
            window.location.href = "../models/panel_turista.php";
        });
    </script>
</body>

</html>
