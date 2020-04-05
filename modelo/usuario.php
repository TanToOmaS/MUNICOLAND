<?php

class Usuario
{

    public $id;
    public $usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $password;

    function __construct(

        $id,
        $usuario,
        $nombre,
        $apellido,
        $email,
        $password

    ) {
      $this->id=$id;
      $this->usuario=$usuario;
      $this->nombre=$nombre;
      $this->apellido=$apellido;
      $this->email=$email;
      $this->password=$password;
        
    }
}
