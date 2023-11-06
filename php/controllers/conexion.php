<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

    // Configura la conexión a la base de datos (cambia los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "rootCODEANDTECH";
    $database = "cocina_celeste";

    // Crea una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }
}
