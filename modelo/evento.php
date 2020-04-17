<?php

class Evento
{

    public $id;
    public $fechaInicio;
    public $fechaFin;
    public $nombre;
    public $descripcion;
    public $lugar;
    public $imagen;
    public $usuarios;    

    function __construct(
        $id,
        $fechaInicio,
        $fechaFin,
        $nombre,
        $descripcion,
        $lugar,
        $imagen,
        $usuarios
        
    ) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->nombre = $nombre;
        $this->lugar = $lugar;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->usuarios = $usuarios;        
    }
}
