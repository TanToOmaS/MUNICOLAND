<?php

//Primero fijamos los parámetros de la conexión

error_reporting(E_ALL);
ini_set('display_errors', '1');
// Motrar todos los errores de PHP
error_reporting(-1); 
// Motrar todos los errores de PHP
ini_set('error_reporting', E_ALL);



$host = "localhost"; //El nombre del servidor local.
$user= "id14315896_tantoomas"; // El nombre del usuario que accederá.
$pass = "Alex6073,Alex"; // La contraseña con la que accederé (vacía de momento).
$bd= "id14315896_municoland"; // El nombre de la BBDD a la que entraré.


//Después creo la variable para la conexión a la BBDD:

$conexion = new mysqli($host,$user,$pass,$bd) or die ("Error al conectar a la base de datos" .mysqli_error($conexion));
 //Utilizo el método mysqli_connect para asignar a una variable los parámetros EN EL ORDEN NECESARIO para la conexión a mi BBDD.
$conexion -> set_charset("UTF8");



if(mysqli_connect_errno()) { /*Establezco el mensaje de error que saldrá en caso de que algo falle en la conexión a la BBDD. */ 
	echo "No se ha podido establecer la conexión a la BBDD <br><br>" ;
	exit();
	}
?>