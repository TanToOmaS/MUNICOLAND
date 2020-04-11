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
    public $img1;
    public $img2;
    public $img3;

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
        $limiteEquipos,
        $img1,
        $img2,
        $img3
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
        $this->img1 = $img1;
        $this->img2 = $img2;
        $this->img3 = $img3;
    }
}
