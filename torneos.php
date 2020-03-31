<?php 

include_once "user.php";
include_once "user_session.php";
include_once 'conexion.php';
include_once "funciones_bd.php";

session_start();
$username = $_SESSION['user'];


if (isset($username)) {
    echo "<h3 align='center'>¡Bienvenido! Estás registrado como ". $username. "</h3>";
    setcookie("USUARIO", $username, time()+72000);
}else{
    header('Location:index.php');
}


?>

<!DOCTYPE html>
<html lang = 'ES'>
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
        body {background-color: #000;}
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
            <h1 class="cabecera">MUÑICOLAND</h1>
    </div>        	
    
<div id='eventos'>
    
<?php include "ocurriendo.php"; ?>
    
</div>
<div class="row">
<?php

$queryTorneo = "SELECT * FROM torneos ORDER BY FECHA ASC";
$queryAsistenciasTorneo = "SELECT ID_TORNEO
FROM participa
WHERE ID_USUARIO = (
	SELECT ID
    FROM usuarios
    WHERE USUARIO = '$username'
)";

$listaTorneos = mysqli_query($conexion, $queryTorneo);
$asistenciasTorneo = array_column(mysqli_fetch_all(mysqli_query($conexion, $queryAsistenciasTorneo), MYSQLI_NUM), 0);

while ($fila = mysqli_fetch_assoc($listaTorneos))

{
    $ID = $fila["ID"];
    $asiste = in_array($ID, $asistenciasTorneo);
?>

    <div class="col s12 m12">    
    <div class="card horizontal grey darken-3">
            <div class="card-image">
         <img src="<?php echo  $fila['IMAG1'] ?>"> 
            </div>
            <div class="card-image">
         <img src="<?php echo  $fila['IMAG2'] ?>">
            </div>            
            <div class="card-image">
         <img src="<?php echo  $fila['IMAG3'] ?>">  
            </div>
        <div class="card-stacked">
        <div class="card-content">
        <h3><span class="tituloTorneo"><?php echo  $fila['TORNEO']. ": " ?></span></h3>
        <p><span class="descripTorneo"><?php echo " EL TORNEO DE " . $fila['TORNEO']. " COMENZARÁ EL " . $fila['FECHA'] . " A LAS " . $fila['HORA'] . "</br></br>" . $fila['DESCRIPCION']; ?></p>               
        </div>
        <div class="card-action">
        <?php echo '<button class="btn waves-effect waves-light light-green darken-3 botonAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode(!$asiste) . '" onclick="asistirTorneo(' . $ID . ')">ME APUNTO<i class="material-icons right">send</i></button>'?>
        <?php echo '<button class="btn waves-effect waves-light red darken-3 botonNoAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode($asiste) . '" onclick="noAsistirTorneo(' . $ID . ')">NO VOY<i class="material-icons right">highlight_off</i></button>'?>
        <a class="waves-effect waves-light btn" href="torneoLucha.php"><i class="material-icons right">dehaze</i>VER TORNEO</a>
        </div>        
        </div>
    </div>
   </div>

<?php 
}
// PARA HACERLO CON BOTONES TIPO ' ASISTIR EVENTO ':
// '<a class="botonAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode(!$asiste) . '" onclick="asistirTorneo(' . $ID . ')">ME APUNTO</a>'
// '<a class="botonNoAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode($asiste) . '" onclick="noAsistirTorneo(' . $ID . ')">NO PUEDO</a>'
        //  <?php echo '<button class="btn-floating halfway-fab waves-effect waves-light red botonAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode(!$asiste) . '" onclick="asistirTorneo(' . $ID . ')">
        //  <i class="material-icons">event_available</i></button>'; 
        //  echo '<button class="btn-floating halfway-fab waves-effect waves-light red botonNoAsistir" data-idtorneo="'. $ID . '" data-showonstart="'. json_encode($asiste) . '" onclick="noAsistirTorneo(' . $ID . ')">
        //  <i class="material-icons">event_busy</i></button>';

?>
</div>
</div>

</body>

  <!-- ZONA JAVASCRIPT: -->

<script type="text/javascript" src="util.js"></script>
<script type="text/javascript" src="botonesAsistir.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">

function asistirTorneo(idTorneo){
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');
    
    const datos = 'ID=' + idTorneo;
    post(
        'asistirTorneo.php',
        datos,
        r => {
            if(r == 'true') {
                botonAsistir.hide();
                botonNoAsistir.show();
                toast('success', '!Te esperamos!');
            }else{ 
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}

function noAsistirTorneo(idTorneo){
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');
    
    const datos = 'ID=' + idTorneo;
    post(
        'noAsistirTorneo.php',
        datos,
        r => {
            if(r == 'true') {
                botonAsistir.show();
                botonNoAsistir.hide();
                toast('warning', '!Que pena!');
            }else{ 
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}

// function asistir(idTorneo){
//     const datos = 'ID=' + idTorneo;
//     post(
//         'funciones_torneos.php',
//         datos,
//         r => r == 'true' ? alert('¡Te esperamos!') : alert("Ha habido un error"),
//         () => alert("Ha fallado la petición")
//     )
// }

</script>
 </html>