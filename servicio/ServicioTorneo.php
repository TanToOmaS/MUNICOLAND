<?php

include_once('../repositorio/RepositorioTorneo.php');

class ServicioTorneo {

    private $repositorioTorneo;

    function __construct()
    {
        $this->repositorioTorneo = new RepositorioTorneo();
    }

    function obtenerTorneos() {
        $torneos = $this->repositorioTorneo->obtenerTorneos();
        return $torneos;
    }

}