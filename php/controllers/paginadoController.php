<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/paginadoModel.php';
require_once '../views/paginadoVista.php';


class Controlador {
    private $modelo;
    private $vista;

    public function __construct($modelo, $vista) {
        $this->modelo = $modelo;
        $this->vista = $vista;
    }

    public function manejarSolicitud() {
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 10;

        $columnas = ['idUsuario', 'emailUsuario', 'nomUsuario'];

        $totalRegistros = $this->modelo->obtenerTotalRegistros();
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        $registros = $this->modelo->obtenerRegistrosPorPagina($paginaActual, $registrosPorPagina);

        $this->vista->mostrarTablaRegistros($columnas, $registros, $paginaActual, $totalPaginas);
    }
}

// Uso del controlador
$conexion = new mysqli("localhost", "root", "rootCODEANDTECH", "cocina_celeste");
$modelo = new Modelo($conexion);
$vista = new Vista();
$controlador = new Controlador($modelo, $vista);

$controlador->manejarSolicitud();

$conexion->close();
