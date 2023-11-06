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

require_once '../controllers/paginadoController.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_paginado.css" </head>

<body>

    <?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once '../controllers/paginadoController.php';

    class Vista
    {
        public function mostrarTablaRegistros($columnas, $registros, $paginaActual, $totalPaginas)
        {
            echo "<table>";
            echo "<tr>";
            foreach ($columnas as $columna) {
                echo "<th>$columna</th>";
            }
            echo "</tr>";

            foreach ($registros as $registro) {
                echo "<tr>";
                foreach ($columnas as $columna) {
                    echo "<td>" . $registro[$columna] . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";

            echo "<div class='pagination'>";
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<a href='./paginadoVista.php?pagina=$i'>$i</a> ";
            }
            echo "</div>";
        }
    }
    
    ?>

    <button id="btn" href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Volver
    </button>

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