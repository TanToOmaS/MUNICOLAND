<?php

include_once("RepositorioBase.php");
include_once("../modelo/ronda.php");
include_once("../modelo/enfrentamiento.php");
include_once("RepositorioEquipo.php");

class RepositorioRonda extends RepositorioBase {

    private $repositorioEquipo;

    function __construct()
    {
        $this->repositorioEquipo = new RepositorioEquipo();
        parent::__construct();
    }

    function obtenerRondas($idTorneo){
        $query = $this->db->prepare("SELECT * FROM enfrentamientos WHERE E_T_ID = ?");
        $query->bindParam(1, $idTorneo);
		$query->execute();
        $enfrentamientosDb = $query->fetchAll(PDO::FETCH_ASSOC);
        $rondas = [];
        foreach($enfrentamientosDb as $enfrentamientoDb){
            $enfrentamiento = $this->aEnfrentamiento($enfrentamientoDb);
            $nombreEq1 = $this->repositorioEquipo->obtenerNombre($enfrentamiento->equipo1);
            $nombreEq2 = $this->repositorioEquipo->obtenerNombre($enfrentamiento->equipo2);
            $equipo1 = new Equipo($enfrentamiento->equipo1, $nombreEq1, null);
            $equipo2 = new Equipo($enfrentamiento->equipo2, $nombreEq2, null);
            $enfrentamiento->equipo1 = $equipo1;
            $enfrentamiento->equipo2 = $equipo2;
            $numRonda = $this->extraerNumeroRonda($enfrentamientoDb);
            // Cargar resultados del enfrentamiento
            // Añadir enfrentamiento a su ronda correspondiente
            // 1. Comprobar si la ronda $numRonda ya existe en $rondas
            $rondaExistente = $this->buscarRonda($rondas, $numRonda);
            if($rondaExistente == null){
                $ronda = new Ronda($numRonda, [$enfrentamiento]);
                array_push($rondas, $ronda);
            } else {
                array_push($rondaExistente->enfrentamientos,$enfrentamiento);
            }
        }
        return $rondas;
    }

    private function buscarRonda($rondas, $idRonda){
        $rondaExistente = null;
        foreach($rondas as $ronda){
            if($ronda->id == $idRonda){
                $rondaExistente = $ronda;
                break;
            }
        }
        // Si $rondaExistente es null, es que la ronda no existe aún
        return $rondaExistente;
    }

    private function cargarUsuariosEquipo($idEquipo) {
        $query = $this->db->prepare("SELECT USE_U_ID FROM usuarios_equipos WHERE USE_EQ_ID = ?");
        $query->bindParam(1, $idEquipo, PDO::PARAM_INT);
		$query->execute();
		$idsUsuarios = $query->fetchAll(PDO::FETCH_COLUMN);
        return $idsUsuarios;
    }

    private function extraerNumeroRonda($enfrentamientoDb){
        return $enfrentamientoDb["E_RONDA"];
    }

    private function aEnfrentamiento($enfrentamientoDb){
        return new Enfrentamiento(
            $enfrentamientoDb["E_ID"],
            $enfrentamientoDb["E_EQ_ID_1"],
            $enfrentamientoDb["E_EQ_ID_2"],
            null
        );
    }
}