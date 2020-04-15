<?php

include_once("RepositorioBase.php");
include_once("RepositorioUsuario.php");
include_once("../servicio/ServicioFecha.php");
include_once("../modelo/evento.php");

class RepositorioEvento extends RepositorioBase {

    private $repositorioUsuario;
    private $servicioFecha;

    function __construct()
    {
        $this->repositorioUsuario = new RepositorioUsuario();
        $this->servicioFecha = new ServicioFecha();
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

    function registrarAsistencia($username, $idEvento){
        $usuario = $this->repositorioUsuario->obtenerUsuarioPorUsername($username);
        $idUsuario = $usuario->id;

        $query = $this->db->prepare("INSERT INTO asiste VALUES (?, ?)");
        $query->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $query->bindParam(2, $idEvento, PDO::PARAM_INT);
        return $query->execute();
    }

    function eliminarAsistencia($username, $idEvento){
        $usuario = $this->repositorioUsuario->obtenerUsuarioPorUsername($username);
        $idUsuario = $usuario->id;

        $query = $this->db->prepare("DELETE FROM asiste WHERE USUARIO_ID = ? AND EVENTO_ID = ?");
        $query->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $query->bindParam(2, $idEvento, PDO::PARAM_INT);
        return $query->execute();
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
            $this->servicioFecha->stringToDatetime($eventoDb["FECHA_INICIO"]),
            $this->servicioFecha->stringToDatetime($eventoDb["FECHA_FIN"]),
            $eventoDb["EVENTO"],
            $eventoDb["LUGAR"],
            $eventoDb["IMAGEN"],
            null
        );
    }
}