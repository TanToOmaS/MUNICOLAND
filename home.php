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

$queryEventos14 = "SELECT * FROM eventos WHERE FECHA = '2020-08-14'";
$queryEventos15 = "SELECT * FROM eventos WHERE FECHA = '2020-08-15'";
$queryEventos16 = "SELECT * FROM eventos WHERE FECHA = '2020-08-16'";
$queryAsistenciasUsuario = "SELECT EVENTO_ID
FROM asiste
WHERE USUARIO_ID = (
	SELECT ID
    FROM usuarios
    WHERE USUARIO = '$username'
)";
$listaEventos14 = mysqli_query($conexion, $queryEventos14);
$listaEventos15 = mysqli_query($conexion, $queryEventos15);
$listaEventos16 = mysqli_query($conexion, $queryEventos16);
$asistenciasUsuario = array_column(mysqli_fetch_all(mysqli_query($conexion, $queryAsistenciasUsuario), MYSQLI_NUM), 0);

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
    <!-- estructura dropdown para el navbar -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#!">LUCHA</a></li>
        <li class="divider"></li>
        <li><a href="#!">CARRERAS</a></li>
        <li class="divider"></li>
        <li><a href="#!">DEPORTES</a></li>
    </ul>

    <div class="container">
        <header>
            <nav>
                <div class="nav-wrapper orange darken-2">
                    <a href="home.php" class="brand-logo right">MUÑICOLAND</a>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><a href="home.php"><span class="tiny material-icons">home</span> EL PUEBLO</a></li>
                        <li><a href="#"><span class="tiny material-icons">local_bar</span> FIESTAS</a></li>
                        <li><a class="dropdown-trigger" href="torneos.php" data-target="dropdown1"><span class="material-icons">videogame_asset</span> TORNEOS</a></li>
                        <li><a href="#"><span class="tiny material-icons">book</span> AZRAEL</a></li>
                        <li><a href="#"><span class="tiny material-icons">live_tv</span> MULTIMEDIA</a></li>
                        <li><a href="logout.php"><span class="tiny material-icons">exit_to_app</span> CERRAR SESIÓN</a></li>
                    </ul>
                </div>
            </nav>
        </header>


        <div id="pueblo">
            <h1 id="homehead">MUÑICOLAND</h1>
        </div>
        <!-- <div id="Municontundence">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTikitikisummertime%2F&tabs=timeline&width=340&height=700&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=489868141175282" width="340" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div> -->
        <div id='eventos'>

            <?php include "ocurriendo.php";
            //include "carousel.php"; 
            ?>

        </div>


        <div class="row grey darken-3">
            <h3 span class="tituloTorneo">EVENTOS DEL VIERNES 14 DE AGOSTO:</span>
                <div class="col s8 m8 l8">
                    <div class="carousel carousel-slider center">

                        <?php

                        while ($fila = mysqli_fetch_assoc($listaEventos14)) {
                            $ID = $fila["ID"];
                            $asiste = in_array($ID, $asistenciasUsuario);
                        ?>

                            <div class="carousel-fixed-item center">
                                <a class="btn waves-effect teal lighten-2 white-text darken-text-2">ME PUNTO</a>
                            </div>
                            <div class="carousel-item white-text">
                                <h2><?php echo  $fila['EVENTO'] ?></h2>
                                <p class="white-text"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                                <img src="<?php echo  $fila['IMAGEN'] ?>">
                            </div>

                        <?php } ?>
                    </div>
                </div>
        </div>

        <div class="row grey darken-3">
            <h3 span class="tituloTorneo">EVENTOS DEL SÁBADO 15 DE AGOSTO:</span>
                <div class="col s8 m8 l8">
                    <div class="carousel carousel-slider center">

                        <?php

                        while ($fila = mysqli_fetch_assoc($listaEventos15)) {
                            $ID = $fila["ID"];
                            $asiste = in_array($ID, $asistenciasUsuario);
                        ?>
                            <div class="carousel-fixed-item center">
                                <a class="btn waves-effect  teal lighten-2 white-text darken-text-2">ME PUNTO</a>
                            </div>
                            <div class="carousel-item white-text">
                                <h2><?php echo  $fila['EVENTO'] ?></h2>
                                <p class="white-text"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                                <img src="<?php echo  $fila['IMAGEN'] ?>">
                            </div>

                        <?php } ?>

                    </div>
                </div>
        </div>

        <div class="row grey darken-3">
            <h3 span class="tituloTorneo">EVENTOS DEL DOMINGO 16 DE AGOSTO:</span>
                <div class="col s8 m8 l8">
                    <div class="carousel carousel-slider center">
                        <?php

                        while ($fila = mysqli_fetch_assoc($listaEventos16)) {
                            $ID = $fila["ID"];
                            $asiste = in_array($ID, $asistenciasUsuario);
                        ?>

                            <div class="carousel-fixed-item center">
                                <a class="btn waves-effect  teal lighten-2 white-text darken-text-2">ME PUNTO</a>
                            </div>
                            <div class="carousel-item white-text">
                                <h2><?php echo  $fila['EVENTO'] ?></h2>
                                <p class="white-text"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                                <img src="<?php echo  $fila['IMAGEN'] ?>">
                            </div>

                        <?php }  ?>
                    </div>
                </div>
        </div>

</body>

<!-- ZONA JAVASCRIPT: -->

<script type="text/javascript" src="util.js"></script>
<script type="text/javascript" src="botonesAsistir.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.carousel');
        var instances = M.Carousel.init(elems, {
            duration: 300,
            indicators: true,
            fullWidth: true
        });
    });
    $('.carousel').carousel();
    setInterval(function() {
        $('.carousel').carousel('next');
    }, 4500);
    $(document).ready(function() {
        $(".dropdown-trigger").dropdown(
            {hover: true}
            );
    });
</script>

</html>