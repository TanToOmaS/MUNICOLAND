<?php

// CREO LAS FUNCIONES PARA EL FORMULARIO DE USUARIOS

function crearUsuario($USUARIO,$NOMBRE,$APELLIDO,$EMAIL,$PASSWORD) {

include "conexion.php";
$sentencia = "INSERT INTO usuarios VALUES (' ', '$USUARIO','$NOMBRE','$APELLIDO','$EMAIL','$PASSWORD')";

if (mysqli_query($conexion,$sentencia)){
	echo "<h3 style='color: white'>Se ha creado tu usuario correctamente</h3>";
	echo "<form action='logout.php'><button type='submit'>INICIAR SESIÓN</button>";	
}else{
	echo "<h3 style='color: white'>Se ha producido un error en la inserción. Comprueba el error.</h3>";
}
mysqli_close($conexion);

}





?>