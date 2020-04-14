<?php
include('conexion.php');
require('fechaCastellano.php');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, "es_ES.UTF-8");

$hora = date("G:i");
$fecha = date("d-M-y");
$fechaCastellano = fechaCastellano($fecha);

$evento = "SELECT * FROM eventos WHERE FECHA < CURRENT_TIMESTAMP";
//$lugar = "SELECT LUGAR FROM eventos WHERE HORA < CURRENT_TIMESTAMP";
$eventoActual = mysqli_query($conexion, $evento);
echo "<h3 id='ocurriendo'>Actualmente son las " . $hora . " del " . $fechaCastellano . " </h3>";

while ($result = mysqli_fetch_assoc($eventoActual)) {

    echo "<h3 id='ocurriendo'>No te pierdas ahora el evento <span style='color: white'>" . $result['EVENTO'] . "</span> en <span style='color: white'>" . $result['LUGAR'] . "</span>.  </h3>";
}

?>
<div class="row grey darken-3">
    <h3 span class="tituloTorneo">PRÓXIMOS EVENTOS:</span></h3>
    <div class="col s8 m8 l8">
        <div class="carousel carousel-slider center">
            <div class="carousel-fixed-item center">
                <a class="btn waves-effect teal lighten-2 white-text darken-text-2">ME PUNTO</a>
            </div>
            <div class="carousel-item white-text">
                <h2>{{nombre}}</h2>
                <p class="white-text">EL {{fecha}} EN {{lugar}}</p>
                <img src="{{urlImagen}}">
            </div>
        </div>
    </div>
</div>