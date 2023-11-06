<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Modelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerTotalRegistros() {
        $sql = "SELECT COUNT(*) as total FROM usuario";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function obtenerRegistrosPorPagina($pagina, $registrosPorPagina) {
        $offset = ($pagina - 1) * $registrosPorPagina;
        $sql = "SELECT * FROM usuario LIMIT $offset, $registrosPorPagina";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
