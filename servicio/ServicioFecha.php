<?php

class ServicioFecha {

    private $datetimeFormat = "d/m/Y H:i";
    private $dateFormat = "d/m/Y";

    function stringToDate($string){
        return date($this->dateFormat, strtotime($string));
    }

    
    function stringToDatetime($string){
        return date($this->datetimeFormat, strtotime($string));
    }
}