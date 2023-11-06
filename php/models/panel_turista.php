<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['idUsuario'])) {
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
    <link rel="stylesheet" href="../../css/style_panel_turista.css">
    <title>Panel de Turista | La Cocina Celeste</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                <img src="../../resources/img/LaCocinaCeleste.png" alt="Logo de La Cocina Celeste" width="80rem" height="80rem">
                    <h2>La Cocina Celeste</h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../views/actualizar_datos_turista.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Perfil</h3>
                </a>
                <a href="../views/resena.php">
                    <span class="material-icons-sharp">receipt_long</span>
                    <h3>Reseñas</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Mensajes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Configuracion</h3>
                </a>
                <a href="#" id="logoutBtn">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
            <!-- End of Nav -->

            <!-- Main Content -->
            <main>
                <h2>Estadisticas</h2>
                <!-- Estadisticas -->
                <div class="analyse">
                    <div class="visits">
                        <div class="status">
                            <div class="info">
                                <a href="../views/read_resenas.php"><h3>Listar tus Reseñas</h3></a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="searches">
                        <div class="status">
                            <div class="info">
                                
                            
                            <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "rootCODEANDTECH";
                        $dbname = "cocina_celeste";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Obtener el ID de usuario desde la variable de sesión
                        $idUsuario = $_SESSION['idUsuario'];

                        // Consulta SQL para obtener los datos del usuario actual
                        $sql = "SELECT nomUsuario, emailUsuario, idUsuario FROM usuario WHERE idUsuario = $idUsuario";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nomUsuario = $row['nomUsuario'];
                            $emailUsuario = $row['emailUsuario'];
                            $idUsuario = $row['idUsuario'];
                        } else {
                            echo "Usuario no encontrado.";
                        }
                        ?>
                        <p>Bienvenido</p>
                        <h3 class="text-muted">Nombre: <?php echo $nomUsuario;?></h3>
                        <h3 class="text-muted">Email: <?php echo $emailUsuario;?></h3>
                        <h3 class="text-muted">ID: <?php echo $idUsuario;?></h3>
                            
                        </div>
                    </div>
                </div>
                <!-- End of Analyses -->
            </main>

            <!-- Reminders -->
            <div class="reminders">
                <div class="header">
                    <h2>Reminders</h2>
                </div>
                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">volume_up</span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <medium class="text_muted">
                                08:00 AM - 12:00 PM
                            </medium>
                        </div>
                        <span class="material-icons-sharp">more_vert</span>
                    </div>
                </div>
                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">edit</span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <medium class="text_muted">
                                08:00 AM - 12:00 PM
                            </medium>
                        </div>
                        <span class="material-icons-sharp">more_vert</span>
                    </div>
                </div>
                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <h3>Add Reminder</h3>
                    </div>
                </div>
            </div>
            <!-- End of Reminders -->
        </div>
        <!-- End of Right Section -->
    </div>

    <script src="../../js/orders_turista.js"></script>
    <script src="../../js/panel_turista.js"></script>
    <script src="../../js/logout.js"></script>
</body>

</html>