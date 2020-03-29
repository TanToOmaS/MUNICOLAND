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

// CREO LAS FUNCIONES PARA EL FORMULARIO DE NOTICIAS

// function crearNoti($TITULO,$CONTENIDO,$AUTOR,$HORA) {
// include('conexion.php');

// if (mysqli_query($conexion,"INSERT INTO NOTICIAS VALUES ('', '$TITULO','$CONTENIDO', '$AUTOR', '$HORA', '')")){
// 	;
// echo 'Se ha creado la noticia correctamente.';
// }else{
// 	echo "Se ha producido un error en la inserción. Comprueba el error.";
// }
// mysqli_close($conexion);
	
// }

// function modificarNoti($ID,$TITULO,$CONTENIDO,$AUTOR,$HORA) {

// include('conexion.php');

// $sentencia = "UPDATE NOTICIAS SET TITULO='$TITULO', CONTENIDO='$CONTENIDO', AUTOR='$AUTOR', HORA_CREACION='$HORA' WHERE ID='$ID'";
// if (mysqli_query($conexion,$sentencia)) {
// 	;
// echo 'Se ha modificado la noticia correctamente.';
// }else{
// 	echo "El cambio no se ha producido. Comprueba el error.";
// }
// // mysqli_close($conexion);
	
// }

// function eliminarNoti($ID) {

// include('conexion.php');

// if (mysqli_query($conexion,"DELETE * FROM NOTICIAS WHERE ID=$ID")) {
// 	;
// echo 'Se ha eliminado la noticia correctamente.';
// }else{
// 	echo "El borrado no se ha producido. Comprueba el error.";
// }
// mysqli_close($conexion);	
// }

function sumarAsist($ID)
{
	include('conexion.php');

	$sumar = "UPDATE eventos SET ASISTENCIA = ASISTENCIA +1 WHERE ID=$ID";
	if (mysqli_query($conexion,$sumar)) {
		echo "<script> alert('¡Te esperamos!') </script>";
	}else{
		echo "<script> alert('Error al enviar') </script>";
	}
	mysqli_close($conexion);
}

?>