<?php
include('conexion.php');
require('fechaCastellano.php');
date_default_timezone_set('Europe/Madrid');
setlocale (LC_TIME, "es_ES.UTF-8");

$hora = date("G:i");
$fecha = date("d-M-y");
$fechaCastellano = fechaCastellano($fecha);

$evento = "SELECT * FROM eventos WHERE FECHA < CURRENT_TIMESTAMP";
//$lugar = "SELECT LUGAR FROM eventos WHERE HORA < CURRENT_TIMESTAMP";
$eventoActual = mysqli_query($conexion,$evento);
echo "<h3 id='ocurriendo'>Actualmente son las ". $hora ." del ". $fechaCastellano ." </h3>";

while ($result = mysqli_fetch_assoc($eventoActual))

{
    
 echo "<h3 id='ocurriendo'>No te pierdas ahora el evento <span style='color: white'>". $result['EVENTO'] . "</span> en <span style='color: white'>". $result['LUGAR'] ."</span>.  </h3>";

}

?>
