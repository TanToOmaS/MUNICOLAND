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
    <header>

        <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="icon-list2"></span>Menu</a>
        </div>
        <nav>
            <ul>
                <li><a href="home.php"><span class="tiny material-icons">home</span>EL PUEBLO</a></li>
                <li><a href="#"><span class="tiny material-icons">local_bar</span>FIESTAS</a></li>
                <li><a href="torneos.php"><span class="tiny material-icons">videogame_asset</span>TORNEOS</a></li>
                <li><a href="#"><span class="tiny material-icons">book</span>AZRAEL</a></li>
                <li><a href="#"><span class="tiny material-icons">live_tv</span>MULTIMEDIA</a></li>
                <li><a href="logout.php"><span class="tiny material-icons">exit_to_app</span>CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    
    <div id="home">
        <div id="pueblo">
            <h1 id="homehead">MUÑICOLAND</h1>
        </div>       
        <!-- <div id="tikitiki">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTikitikisummertime%2F&tabs=timeline&width=340&height=700&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=489868141175282" width="340" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div> -->
        <div id='eventos'>

            <?php include "ocurriendo.php";
            //include "carousel.php";
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

        </div>
        <h3 span class="tituloTorneo">EVENTOS DEL VIERNES 14 DE AGOSTO:</span></h3>
        <div class="row">
            <div class="col s6 m8">
                <div class="card horizontal grey darken-3">
                    
                    
                    <?php                   
                   
                    while ($fila = mysqli_fetch_assoc($listaEventos14)) {
                        $ID = $fila["ID"];
                        $asiste = in_array($ID, $asistenciasUsuario);
                    ?>
        
         <div class="card grey darken-3">
             <div class="card-image">
                 <img src="<?php echo  $fila['IMAGEN'] ?>">
                 <span class="card-title"><?php echo  $fila['EVENTO'] ?></span>
                 <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light green botonAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode(!$asiste) . '" onclick="asistir(' . $ID . ')">
      <i class="large material-icons">event_available</i></button>'; ?>
                                <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light red botonNoAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode($asiste) . '" onclick="noAsistir(' . $ID . ')">
      <i class="large material-icons">event_busy</i></button>'; ?>
                 </div>
                 <div class="card-content">
                     <p class="black" style="font-size: 18px"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                 </div>
             </div>

                    <?php } ?>
                </div>
            </div>
        </div>
        <h3 span class="tituloTorneo">EVENTOS DEL SÁBADO 15 DE AGOSTO:</span>
        <div class="row">
            <div class="col s6 m8">
                <div class="card horizontal grey darken-3">

                    <?php
                    
                    while ($fila = mysqli_fetch_assoc($listaEventos15)) {
                        $ID = $fila["ID"];
                        $asiste = in_array($ID, $asistenciasUsuario);
                    ?>
                        
                        <div class="card grey darken-3">
                            <div class="card-image">
                                <img src="<?php echo  $fila['IMAGEN'] ?>">
                                <span class="card-title"><?php echo  $fila['EVENTO'] ?></span>
                                <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light green botonAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode(!$asiste) . '" onclick="asistir(' . $ID . ')">
      <i class="large material-icons">event_available</i></button>'; ?>
                                <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light red botonNoAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode($asiste) . '" onclick="noAsistir(' . $ID . ')">
      <i class="large material-icons">event_busy</i></button>'; ?>
                            </div>
                            <div class="card-content">
                                <p class="black" style="font-size: 18px"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                            </div>
                        </div>

                    <?php } ?>
                    
                    </div>
            </div>
        </div>
        <h3 span class="tituloTorneo">EVENTOS DEL DOMINGO 16 DE AGOSTO:</span>
        <div class="row">
            <div class="col s6 m8">
                <div class="card horizontal grey darken-3">

                    <?php
                    
                    while ($fila = mysqli_fetch_assoc($listaEventos16)) {
                        $ID = $fila["ID"];
                        $asiste = in_array($ID, $asistenciasUsuario);
                    ?>
                    
                        <div class="card grey darken-3">
                            <div class="card-image">
                                <img src="<?php echo  $fila['IMAGEN'] ?>">
                                <span class="card-title"><?php echo  $fila['EVENTO'] ?></span>
                                <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light green botonAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode(!$asiste) . '" onclick="asistir(' . $ID . ')">
      <i class="large material-icons">event_available</i></button>'; ?>
                                <?php echo '<button class="btn-floating btn-large pulse halfway-fab waves-effect waves-light red botonNoAsistir" data-idevento="' . $ID . '" data-showonstart="' . json_encode($asiste) . '" onclick="noAsistir(' . $ID . ')">
      <i class="large material-icons">event_busy</i></button>'; ?>
                            </div>
                            <div class="card-content">
                                <p class="black" style="font-size: 18px"><?php echo " EL " . $fila['FECHA'] . " EN " . $fila['LUGAR'] ?></p>
                            </div>
                        </div>

                    <?php }  ?>

                </div>
            </div>
        </div>
        <!-- ZONA JAVASCRIPT: -->

        <script type="text/javascript" src="util.js"></script>
        <script type="text/javascript" src="botonesAsistir.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    </div>

</body>

</html>