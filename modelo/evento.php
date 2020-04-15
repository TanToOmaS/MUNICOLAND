<?php

class Evento
{

    public $id;
    public $fechaInicio;
    public $fechaFin;
    public $nombre;
    public $lugar;
    public $imagen;
    public $usuarios;

    function __construct(
        $id,
        $fechaInicio,
        $fechaFin,
        $nombre,
        $lugar,
        $imagen,
        $usuarios
    ) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->nombre = $nombre;
        $this->lugar = $lugar;
        $this->imagen = $imagen;
        $this->usuarios = $usuarios;
    }
}
