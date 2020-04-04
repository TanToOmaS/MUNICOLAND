<?php

class Equipo {

    public $id;
    public $nombre;
    public $usuarios;

    function __construct(
        $id,
        $nombre,
        $usuarios
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuarios = $usuarios;
    }

}