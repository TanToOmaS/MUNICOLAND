<?php

// CREO LAS FUNCIONES PARA EL FORMULARIO DE USUARIOS

function crearUsuario($USUARIO, $NOMBRE, $APELLIDO, $EMAIL, $PASSWORD)
{

	include_once "conexion.php";
	$emailsUsuarios = mysqli_query($conexion, "SELECT * FROM usuarios WHERE EMAIL = '$EMAIL'");
	$usuarioExiste = mysqli_query($conexion, "SELECT * FROM usuarios WHERE USUARIO = '$USUARIO'");

	$sentencia = "INSERT INTO usuarios VALUES (' ', '$USUARIO','$NOMBRE','$APELLIDO','$EMAIL','$PASSWORD')";

	if (mysqli_num_rows($emailsUsuarios) > 0) {
		echo '<script type="text/javascript">toast("warning", "!EL EMAIL YA ESTÁ EN USO!");</script>';
	} else if (mysqli_num_rows($usuarioExiste) > 0) {
		echo '<script type="text/javascript">toast("warning", "!EL USUARIO YA EXISTE!");</script>';
	} else if (mysqli_query($conexion, $sentencia)) {
		echo '<script type="text/javascript">toast("success", "!TE HAS REGISTRADO SATISFACTORIAMENTE!");</script>';				
	} else {
		echo "<h3 style='color: white'>Se ha producido un error en la inserción. Comprueba el error.</h3>";
	}
	mysqli_close($conexion);
}
?>
<script type="text/javascript" src="assets/js/util.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>