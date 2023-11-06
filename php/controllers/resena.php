<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "rootCODEANDTECH";
$dbname = "cocina_celeste";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

// Obtén los datos del formulario
$idUsuarioT = $_POST['idUsuarioT'];
$idUsuarioR = $_POST['idUsuarioR'];
$fechaResenia = $_POST['fechaResenia'];
$caliRecinto = $_POST['caliRecinto'];
$caliPersonal = $_POST['caliPersonal'];
$caliGeneral = $_POST['caliGeneral'];
$caliMenu = $_POST['caliMenu'];

// Inserta la reseña en la base de datos
$sql = "INSERT INTO resenia (idUsuarioT, idUsuarioR, fechaResenia, caliRecinto, caliPersonal, caliGeneral, caliMenu)
        VALUES ('$idUsuarioT', '$idUsuarioR', '$fechaResenia', '$caliRecinto', '$caliPersonal', '$caliGeneral', '$caliMenu')";

if (strtotime($fechaResenia) > strtotime(date('Y-m-d'))) {
    // La fecha es superior a la actual, muestra una alerta y redirige
    echo "<script>alert('Fecha superior a la actual no permitida.');</script>";
    echo "<script>window.location.href = '../models/panel_turista.php';</script>";
    exit;
}

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('La reseña se ha insertado correctamente.');</script>";
    echo "<script>window.location.href = '../models/panel_turista.php';</script>";
    exit;
} else {
    echo "<script>alert('Error al insertar la reseña: " . $conn->error . "');</script>";
    echo "<script>window.location.href = '../models/panel_turista.php';</script>";
    exit;
}

// Cierra la conexión a la base de datos
$conn->close();
?>
