<?php

include_once('../servicio/ServicioTorneo.php');

class ControladorTorneos {

    private $servicioTorneos;

    function __construct(){
        $this->servicioTorneos = new ServicioTorneo();
    }

    function obtenerTorneos(){
        $torneos = $this->servicioTorneos->obtenerTorneos();
        die(json_encode($torneos));
    }

    function registrarParticipacion($username, $idTorneo, $participa){
        $resultado = $this->servicioTorneos->registrarParticipacion($username, $idTorneo, $participa);
        if($resultado == true){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
    }

}