<?php

class Evento
{

    public $id;
    public $fecha;
    public $nombre;
    public $lugar;
    public $imagen;
    public $usuarios;

    function __construct(
        $id,
        $fecha,
        $nombre,
        $lugar,
        $imagen,
        $usuarios
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->nombre = $nombre;
        $this->lugar = $lugar;
        $this->imagen = $imagen;
        $this->usuarios = $usuarios;
    }
}
