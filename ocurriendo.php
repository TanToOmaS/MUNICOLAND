<?php
include('conexion.php');
require('fechaCastellano.php');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, "es_ES.UTF-8");

$hora = date("G:i");
$fecha = date("d-M-y");
$fechaCastellano = fechaCastellano($fecha);

echo "<h3 class='marquee' id='ocurriendo'>Actualmente son las " . $hora . " del " . $fechaCastellano . " </h3>";
?>

<div class="grey darken-3">
    <h3 class="tituloEventos">PRÓXIMOS EVENTOS:</h3>
    <hr>
    <div class="col s12 m12 l12">
        <div id="contenedor-proximos-eventos" class="carousel carousel-slider center" style="height: 600px">
            <div class="carousel-item" id="plantilla-proximo-evento">
                <h2>{{nombre}}</h2>
                <p class="black orange-text fechaHoraEventos">EL {{fecha}} EN {{lugar}}</p>                  
                <p class="white-text">{{descrip}}</p>
                <a><img src="{{urlImagen}}"></a>
                <div class="carousel-fixed-item center">
                    <a class="btn waves-effect green white-text darken-text-2 botonAsistir" 
                    data-idevento="{{idEvento}}" data-showonstart="{{asiste}}" onclick="asistir('{{idEvento}}')">ME PUNTO</a>
                    <a class="btn waves-effect red white-text darken-text-2 botonNoAsistir"
                    data-idevento="{{idEvento}}" data-showonstart="{{noAsiste}}" onclick="noAsistir('{{idEvento}}')">NO VOY</a>
                </div>
            </div>
        </div>
    </div>
</div>