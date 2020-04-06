<?php

class Resultado{

    public $juego;
    public $equipoGanador;


    function __construct(
    $juego,
    $equipoGanador

    )

    {
        $this->juego = $juego;
        $this->equipoGanador = $equipoGanador;
    }

}