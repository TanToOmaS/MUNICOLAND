<?php

include_once("RepositorioBase.php");
include_once("../modelo/usuario.php");


class RepositorioUsuario extends RepositorioBase
{

    function obtenerUsuario($idUsuario)
    {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE ID = ?");
        $query->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $query->execute();
        $usuarioDb = $query->fetch(PDO::FETCH_ASSOC);
        $usuario = $this->aUsuario($usuarioDb);
        return $usuario;
    }

    private function aUsuario($usuarioDb)
    {
        return new Usuario(
            $usuarioDb["ID"],
            $usuarioDb["USUARIO"],
            $usuarioDb["NOMBRE"],
            $usuarioDb["APELLIDO"],
            $usuarioDb["EMAIL"],
            $usuarioDb["PASSWORD"]
        );
    }
}
