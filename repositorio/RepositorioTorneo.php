<?php

include("DB.php");

class RepositorioTorneo {

    private $db;

    function __construct()
    {
        $this->db = new DB()->connect(); 
    }

    function obtenerTorneos(){
		$query = $this->db->prepare("SELECT * FROM torneos");
		$query->execute();
		$torneos = $query->get_result()->fetch_assoc();
        return $torneos;
    }

    
}