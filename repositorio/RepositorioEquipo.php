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