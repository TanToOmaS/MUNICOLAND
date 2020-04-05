<?php

class Ronda{

    public $id;
    public $enfrentamientos;

    function __construct(
        $id,
        $enfrentamientos
    )
    {
        $this->id = $id;
        $this->enfrentamientos = $enfrentamientos;
    }

}