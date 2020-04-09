<?php

include_once('../servicio/ServicioEvento.php');

class ControladorEventos {

    private $servicioEventos;

    function __construct(){
        $this->servicioEventos = new ServicioEvento();
    }

    function obtenerEventos(){
        $eventos = $this->servicioEventos->obtenerEventos();
        die(json_encode($eventos));
    }

}