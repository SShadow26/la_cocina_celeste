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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];

    $nombreMenu = isset($_POST['nombreMenu']) ? $_POST['nombreMenu'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $costoMenu = isset($_POST['costoMenu']) ? $_POST['costoMenu'] : '';

    if ($accion === 'crear') {
        $sql_menu = "INSERT INTO menurestaurante (nombreMenu, descripcion, costoMenu) VALUES ('$nombreMenu', '$descripcion', '$costoMenu')";
        if ($conn->query($sql_menu) === TRUE) {
            $idMenu = $conn->insert_id;
            echo "<script>alert('Menú creado con éxito.');</script>";
            echo "<script>window.location.href = '../models/panel_restaurante.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error al crear el Menú: " . $conn->error . "');</script>";
            echo "<script>window.location.href = '../models/panel_restaurante.php';</script>";
            exit;
        }
    }
}