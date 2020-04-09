<?php

include_once("RepositorioBase.php");
include_once("RepositorioUsuario.php");
include_once("../modelo/evento.php");

class RepositorioEvento extends RepositorioBase {

    private $repositorioUsuario;

    function __construct()
    {
        $this->repositorioUsuario = new RepositorioUsuario();
        parent::__construct();
    }

    function obtenerEventos(){
		$query = $this->db->prepare("SELECT * FROM eventos");
		$query->execute();
        $eventosDb = $query->fetchAll(PDO::FETCH_ASSOC);
        $eventos = [];
        foreach($eventosDb as $eventoDb) {
            $evento = $this->aEvento($eventoDb);
            $idsUsuarios = $this->cargarIdsUsuarios($evento->id);
            $usuarios = [];
            foreach($idsUsuarios as $idUsuario) {
                $usuario = $this->repositorioUsuario->obtenerUsuario($idUsuario);
                array_push($usuarios, $usuario);
            }
            $evento->usuarios = $usuarios;
            array_push($eventos, $evento);
        }
        
        return $eventos;
    }

    private function cargarIdsUsuarios($idEvento) {
        $query = $this->db->prepare("SELECT USUARIO_ID FROM asiste WHERE EVENTO_ID = ?");
        $query->bindParam(1, $idEvento, PDO::PARAM_INT);
		$query->execute();
		$idsUsuarios = $query->fetchAll(PDO::FETCH_COLUMN);
        return $idsUsuarios;
    }

    private function aEvento($eventoDb){
        return new Evento(
            $eventoDb["ID"],
            $eventoDb["FECHA"],
            $eventoDb["EVENTO"],
            $eventoDb["LUGAR"],
            $eventoDb["IMAGEN"],
            null
        );
    }
}