<?php

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
    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize minified CSS -->
    <link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
    <script src="jquery-3.4.1.min.js"></script>
    <style>
        body {
            background-color: #000;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>¡MUÑICOLAND! - Home</title>
</head>

<body>


    <div class="container">
        <header> <?php include_once "navbar.php";  ?> </header>        
    </div>
        <div id="home">
        <div id="pueblo">
            <h1 class="cabecera">MUÑICOLAND</h1>
        </div>
        <div id="contenedor-torneos" class="row">
            <div id="plantilla-torneo" class="col s12 m12" style="display: none;">
                <div class="card horizontal grey darken-3" style="padding: 5px">
                    <div class="card-image">
                        <img src="{{imagen1}}">
                    </div>
                    <div class="card-image">
                        <img src="{{imagen2}}">
                    </div>
                    <div class="card-image">
                        <img src="{{imagen3}}">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3><span class="tituloTorneo">{{titulo}}</span></h3>
                            <p><span class="descripTorneo">EL TORNEO DE {{titulo}} COMENZARÁ EL {{fecha}} A LAS {{hora}}</br></br>{{descripcion}}</p>
                        </div>
                        <div class="card-action">
                            <button class="btn waves-effect waves-light light-green darken-3 botonAsistir" data-idtorneo="{{idTorneo}}" data-showonstart="{{noAsiste}}" onclick="asistirTorneo('{{idTorneo}}')">
                                ME APUNTO<i class="material-icons right">send</i>
                            </button>
                            <button class="btn waves-effect waves-light red darken-3 botonNoAsistir" data-idtorneo="{{idTorneo}}" data-showonstart="{{asiste}}" onclick="noAsistirTorneo('{{idTorneo}}')">
                                NO VOY<i class="material-icons right">highlight_off</i>
                            </button>
                            <a class="waves-effect waves-light btn botonVerTorneo" href="{{url}}"><i class="material-icons right">dehaze</i>VER TORNEO</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

<!-- ZONA JAVASCRIPT: -->

<script type="text/javascript" src="assets/js/util.js"></script>
<script type="text/javascript" src="assets/js/torneos.js"></script>
<script type="text/javascript" src="assets/js/constantes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>