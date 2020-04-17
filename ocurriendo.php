<?php
include('conexion.php');
require('fechaCastellano.php');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, "es_ES.UTF-8");

$hora = date("G:i");
$fecha = date("d-M-y");
$fechaCastellano = fechaCastellano($fecha);

echo "<h3 id='ocurriendo'>Actualmente son las " . $hora . " del " . $fechaCastellano . " </h3>";

?>

<div class="grey darken-3">
    <h3 span class="tituloTorneo">PRÓXIMOS EVENTOS:</span></h3>
    <div class="col s12 m12 l12">
        <div id="contenedor-proximos-eventos" class="carousel carousel-slider center" style="height: 600px">
            <div class="carousel-item" id="plantilla-proximo-evento">
                <h2>{{nombre}}</h2>
                <p class="white-text">EL {{fecha}} EN {{lugar}} <br> {{descrip}}</p>
                <a href=""><img src="{{urlImagen}}"></a>
                <div class="carousel-fixed-item center">
                    <a class="btn waves-effect teal lighten-2 white-text darken-text-2">ME PUNTO</a>
                </div>
            </div>
        </div>
    </div>
</div>