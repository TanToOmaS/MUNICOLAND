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

}