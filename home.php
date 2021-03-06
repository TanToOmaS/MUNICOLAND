<?php

include_once "user.php";
include_once "user_session.php";
include_once 'conexion.php';
include_once "funciones_bd.php";

session_start();
$username = $_SESSION['user'];

if (isset($username)) {
    echo "<h3 align='center'>¡Bienvenido! Estás registrado como " . $username . "</h3>";
    setcookie("USUARIO", $username, time() + 72000);
} else {
    header('Location:index.php');
}


?>

<!DOCTYPE html>
<html lang='ES'>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="fonts.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize minified CSS -->
    <link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
    <!-- SweetAlert CSS -->
    <!-- <link rel="stylesheet" href="assets/css/sweetalert2.min.css"> -->
    <script src="jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        body {
            background-color: black;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>¡MUÑICOLAND! - Home</title>
</head>

<body>
    <!-- estructura dropdown para el navbar -->
    <!-- <ul id="dropdown1" class="dropdown-content">
        <li><a href="#!">LUCHA</a></li>
        <li class="divider"></li>
        <li><a href="#!">CARRERAS</a></li>
        <li class="divider"></li>
        <li><a href="#!">DEPORTES</a></li>
    </ul> -->

    <div class="container">
        <header> <?php include_once "navbar.php";  ?> </header>
    </div>
    <div id="home">
        <div id="pueblo">
            <h1 class="cabecera" id="cabecera">MUÑICOLAND</h1>
        </div>
        <!-- <div id="Municontundence">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTikitikisummertime%2F&tabs=timeline&width=340&height=700&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=489868141175282" width="340" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div> -->


        <div class="eventos">
            <li><?php include "ocurriendo.php"; ?></li>
        </div>


        <div id="contenedor-eventos" class="col s4 m4 l4">
            <h3 id="plantilla-eventos-dia" class="tituloTorneo" style="display: none; padding: 5px">EVENTOS DEL DÍA {{fecha}}</h3>
            <div id="plantilla-evento" class="col s4 m4 l4" style="display: none;">
                <div class="card orange lighten-1">
                    <div class="card-image">
                        <img src="{{urlImagen}}">
                        <button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light green botonAsistir" data-idevento="{{idEvento}}" data-showonstart="{{asiste}}" onclick="asistir('{{idEvento}}')">
                            <i class="large material-icons">event_available</i>
                        </button>
                        <button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light red botonNoAsistir" data-idevento="{{idEvento}}" data-showonstart="{{noAsiste}}" onclick="noAsistir('{{idEvento}}')">
                            <i class="large material-icons">event_busy</i>
                        </button>
                    </div>
                    <div class="card-content">
                        <span class="card-title white-text descripEvento">{{nombre}}</span>
                        <p class="black" class="descripEvento">
                            {{descrip}}
                        <hr> EL {{fecha}} EN {{lugar}} </hr>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<!-- ZONA JAVASCRIPT: -->
</div>
<script type="text/javascript">
    const username = '<?php echo $username; ?>';
</script>
<script type="text/javascript" src="assets/js/util.js"></script>
<script type="text/javascript" src="assets/js/fechas.js"></script>
<script type="text/javascript" src="assets/js/eventos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="assets/marquee/jquery.marquee.min.js"></script>


<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // $(".dropdown-trigger").dropdown({
        //     hover: true

        // });
        // createMarquee();
    });
    $('h1.cabecera').hide();
    $('h1.cabecera').fadeIn(3000);

    $(function() {
        $('.marquee').marquee();
    });
</script>

</html>