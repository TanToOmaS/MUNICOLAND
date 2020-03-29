<?php

	try {
		include ('conexion.php');
		session_start();	
		$userSession = $_SESSION['user'];
		$idTorneo = $_POST['ID'];


//Primero las consultas para seleccionar la ID del usuario:
		$query = $conexion->prepare("SELECT ID FROM usuarios WHERE USUARIO = ? LIMIT 1");
		$query->bind_param("s", $userSession);
		$query->execute();
		$usuarioID = $query->get_result()->fetch_assoc()['ID'];
        
        $inserted = mysqli_query($conexion,"DELETE FROM participa WHERE participa.ID_USUARIO = '$usuarioID' AND participa.ID_TORNEO = '$idTorneo'");
		echo json_encode(true);
	}catch(Exception|Throwable $error) {
		echo json_encode(false);
	}
?>