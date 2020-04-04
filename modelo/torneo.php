<?php

class Torneo
{

    public $id;
    public $tipo;
    public $fecha;
    public $hora;
    public $descripcion;
    public $rondas; //Array de rondas con sus enfrentamientos
    public $numContrincantes;
    public $inicioInscripcion;
    public $finInscripcion;
    public $limiteEquipos;

    public $equipos; //Array de equipos que participan

    function __construct(
        $id,
        $tipo,
        $fecha,
        $hora,
        $descripcion,
        $rondas,
        $numContrincantes,
        $inicioInscripcion,
        $finInscripcion,
        $limiteEquipos
    ) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->descripcion = $descripcion;
        $this->rondas = $rondas;
        $this->numContrincantes = $numContrincantes;
        $this->inicioInscripcion = $inicioInscripcion;
        $this->finInscripcion = $finInscripcion;
        $this->limiteEquipos = $limiteEquipos;
    }
}
