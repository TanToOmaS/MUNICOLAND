<?php

include_once("RepositorioBase.php");
include_once("../modelo/equipo.php");
include_once("RepositorioUsuario.php");

class RepositorioEquipo extends RepositorioBase {

    private $repositorioUsuario;

    function __construct()
    {
        $this->repositorioUsuario = new RepositorioUsuario();
        parent::__construct();
    }

    function obtenerEquipo($id){
        $query = $this->db->prepare("SELECT * FROM equipos WHERE EQ_ID = ?");
        $query->bindParam(1, $id);
		$query->execute();
        $equiposDb = $query->fetch(PDO::FETCH_ASSOC);
        $equipo = $this->aEquipo($equiposDb);
        $idsUsuarios = $this->cargarUsuariosEquipo($equipo->id);
        $usuarios = [];
        foreach($idsUsuarios as $idUsuario) {
            $usuario = $this->repositorioUsuario->obtenerUsuario($idUsuario);
            array_push($usuarios, $usuario);
        }
        
        $equipo->usuarios = $usuarios;
        return $equipo;
    }

    function obtenerEquipoPorIdUsuario($idUsuario){
        $query = $this->db->prepare("SELECT USE_EQ_ID FROM usuarios_equipos WHERE USE_U_ID = ?");
        $query->bindParam(1, $idUsuario);
        $query->execute();
        if($query->rowCount() > 0){
            $idEquipo = $query->fetch(PDO::FETCH_COLUMN);
            return $this->obtenerEquipo($idEquipo);
        }else{
            return null;
        }
    }

    function crear($equipo){
        $query = $this->db->prepare("INSERT INTO equipos(EQ_NOMBRE) VALUES(?)");
        $query->bindParam(1, $equipo->nombre);
        $query->execute();
        $equipo->id = $this->db->lastInsertId();
        return $equipo;
    }
    
    function asignarUsuarioAEquipo($idEquipo, $idUsuario){
        $query = $this->db->prepare("INSERT INTO usuarios_equipos VALUES(?, ?)");
        $query->bindParam(1, $idEquipo);
        $query->bindParam(2, $idUsuario);
        return $query->execute();
    }
    function obtenerNombre($id){
        $query = $this->db->prepare("SELECT EQ_NOMBRE FROM equipos WHERE EQ_ID = ?");
        $query->bindParam(1, $id);
		$query->execute();
        $equipoDb = $query->fetch(PDO::FETCH_ASSOC);
        $nombre = $equipoDb["EQ_NOMBRE"];
        return $nombre;
    }

    private function cargarUsuariosEquipo($idEquipo) {
        $query = $this->db->prepare("SELECT USE_U_ID FROM usuarios_equipos WHERE USE_EQ_ID = ?");
        $query->bindParam(1, $idEquipo, PDO::PARAM_INT);
		$query->execute();
		$idsUsuarios = $query->fetchAll(PDO::FETCH_COLUMN);
        return $idsUsuarios;
    }

    private function aEquipo($equiposDb){
        return new Equipo(
            $equiposDb["EQ_ID"],
            $equiposDb["EQ_NOMBRE"],
            null
        );
    }
}