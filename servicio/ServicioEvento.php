<?php

include_once('../repositorio/RepositorioEvento.php');

class ServicioEvento {

    private $repositorioEvento;

    function __construct()
    {
        $this->repositorioEvento = new RepositorioEvento();
    }

    function obtenerEventos() {
        $eventos = $this->repositorioEvento->obtenerEventos();
        return $eventos;
    }

    function registrarAsistencia($username, $idEvento){
        return $this->repositorioEvento->registrarAsistencia($username, $idEvento);
    }

}