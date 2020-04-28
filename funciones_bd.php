<?php

// CREO LAS FUNCIONES PARA EL FORMULARIO DE USUARIOS

function crearUsuario($USUARIO,$NOMBRE,$APELLIDO,$EMAIL,$PASSWORD) {

include_once "conexion.php";
$emailsUsuarios = mysqli_query($conexion,"SELECT * FROM usuarios WHERE EMAIL = '$EMAIL'");

$sentencia = "INSERT INTO usuarios VALUES (' ', '$USUARIO','$NOMBRE','$APELLIDO','$EMAIL','$PASSWORD')";

	if 	(mysqli_num_rows($emailsUsuarios) > 0){
		echo "alert('El usuario ya existe');";
	
	}else if (mysqli_query($conexion,$sentencia)){
			echo "alert('Se ha creado tu usuario correctamente');";
			echo "<form action='logout.php'><button type='submit'>INICIAR SESIÓN</button>";
	}
	else{
		echo "<h3 style='color: white'>Se ha producido un error en la inserción. Comprueba el error.</h3>";
	}
	

	
mysqli_close($conexion);

}

?>