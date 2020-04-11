<?php

include_once('../repositorio/RepositorioTorneo.php');
include_once('../repositorio/RepositorioEquipo.php');
include_once('../repositorio/RepositorioUsuario.php');
include_once('../modelo/equipo.php');

class ServicioTorneo {

    private $repositorioTorneo;
    private $repositorioEquipo;
    private $repositorioUsuario;

    function __construct()
    {
        $this->repositorioTorneo = new RepositorioTorneo();
        $this->repositorioEquipo = new RepositorioEquipo();
        $this->repositorioUsuario = new RepositorioUsuario();
    }

    function obtenerTorneos() {
        $torneos = $this->repositorioTorneo->obtenerTorneos();
        return $torneos;
    }

    function registrarParticipacion($username, $idTorneo, $participa){
        $usuario = $this->repositorioUsuario->obtenerUsuarioPorUsername($username);
        $equipo = $this->repositorioEquipo->obtenerEquipoPorIdUsuario($usuario->id);
        if($equipo == null) {
            // Crear equipo
            $equipoACrear = new Equipo(null, $username, [$usuario]);
            $equipo = $this->repositorioEquipo->crear($equipoACrear);
        }

        $idEquipo = $equipo->id;

        if($participa == true){
            return $this->repositorioTorneo->registrarParticipacion($idEquipo, $idTorneo);
        }else{
            return $this->repositorioTorneo->eliminarParticipacion($idEquipo, $idTorneo);
        }
    }
}