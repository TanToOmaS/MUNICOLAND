<?php

include_once("RepositorioBase.php");
include_once("RepositorioEquipo.php");
include_once("RepositorioRonda.php");
include_once("../modelo/torneo.php");

class RepositorioTorneo extends RepositorioBase {

    private $repositorioEquipo;
    private $repositorioRonda;

    function __construct()
    {
        $this->repositorioEquipo = new RepositorioEquipo();
        $this->repositorioRonda = new RepositorioRonda();
        parent::__construct();
    }

    function obtenerTorneos(){
		$query = $this->db->prepare("SELECT * FROM torneos");
		$query->execute();
        $torneosDb = $query->fetchAll(PDO::FETCH_ASSOC);
        $torneos = [];
        foreach($torneosDb as $torneoDb) {
            $torneo = $this->aTorneo($torneoDb);
            $idsEquipos = $this->cargarEquiposParticipantes($torneo->id);
            $equipos = [];
            foreach($idsEquipos as $idEquipo) {
                $equipo = $this->repositorioEquipo->obtenerEquipo($idEquipo);
                array_push($equipos, $equipo);
            }
            $torneo->equipos = $equipos;
            $rondas = $this->repositorioRonda->obtenerRondas($torneo->id);
            $torneo->rondas = $rondas;
            //Cargar enfrentamientos/rondas
            array_push($torneos, $torneo);
        }
        
        //var_dump($torneos);die();
        return $torneos;
    }

    private function cargarEquiposParticipantes($idTorneo) {
        $query = $this->db->prepare("SELECT ET_EQ_ID FROM equipos_torneos WHERE ET_T_ID = ?");
        $query->bindParam(1, $idTorneo, PDO::PARAM_INT);
		$query->execute();
		$idsEquipos = $query->fetchAll(PDO::FETCH_COLUMN);
        return $idsEquipos;
    }

    private function aTorneo($torneoDb){
        return new Torneo(
            $torneoDb["ID"],
            $torneoDb["TORNEO"],
            $torneoDb["FECHA"],
            $torneoDb["HORA"],
            $torneoDb["DESCRIPCION"],
            null,
            $torneoDb["NUM_CONTRINCANTES"],
            $torneoDb["INICIO_INSCRIP"],
            $torneoDb["FIN_INSCRIP"],
            $torneoDb["LIMITE_EQUIPOS"]
        );
    }
}