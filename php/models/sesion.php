<?php


class Sesion{

    private $nombre;

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function crearSesion(){
        session_start();
        if(!isset($_SESSION['nombre'])){
            $_SESSION['nombre']=$this->getNombre();
        }
    }

    public function destruirSesion(){
        session_abort();
    }

}