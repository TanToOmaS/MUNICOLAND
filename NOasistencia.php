<?php

	try {
		include ('conexion.php');
		session_start();	
		$userSession = $_SESSION['user'];
		$idEvento = $_POST['ID'];
		
		$sumarAsist = "UPDATE eventos SET ASISTENCIA = ASISTENCIA -1 WHERE ID= $idEvento";

		mysqli_query($conexion,$sumarAsist);

		$query = $conexion->prepare("SELECT ID FROM usuarios WHERE USUARIO = ? LIMIT 1");
		$query->bind_param("s", $userSession);
		$query->execute();
		$usuarioID = $query->get_result()->fetch_assoc()['ID'];

		$inserted = mysqli_query($conexion,"DELETE FROM asiste WHERE asiste.USUARIO_ID = '$usuarioID' AND asiste.EVENTO_ID = '$idEvento'");
		echo json_encode(true);
	}catch(Exception|Throwable $error) {
		echo json_encode(false);
	}
?>