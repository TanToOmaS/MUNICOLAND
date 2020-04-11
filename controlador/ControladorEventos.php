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

    function registrarAsistencia($username, $idEvento){
        $resultado = $this->servicioEventos->registrarAsistencia($username, $idEvento);
        if($resultado == true){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
    }

}