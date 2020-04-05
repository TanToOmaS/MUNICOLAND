<?php

class Enfrentamiento{

    public $id;
    public $equipo1;
    public $equipo2;
    public $resultados;

    function __construct(
        $id,
        $equipo1,
        $equipo2,
        $resultados
    )
    {
        $this->id = $id;
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
        $this->resultados = $resultados;
    }

}