<?php

include_once("../DB.php");

abstract class RepositorioBase {

    protected $db;

    function __construct()
    {
        $db = new DB();
        $this->db = $db->connect(); 
    }
}