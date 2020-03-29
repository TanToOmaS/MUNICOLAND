<?php 

include_once "user.php";
include_once "user_session.php";

session_start();
$username = $_SESSION['user'];


if (isset($username)) {
    echo "<h3 align='center'>¡Bienvenido! Estás registrado como ". $username . "<form action='logout.php'><button type='submit'> CERRAR SESIÓN</button></h3></form>";
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
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style>
        body {background-color: #000;}
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>¡MUÑICOLAND! - Home</title>
    <script src="jquery-3.4.1.min.js"></script>     
  </head>
  <body>    
    <header>  
    
    <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="icon-list2"></span>Menu</a>
        </div>           
        <nav>
            <ul>
                <li><a href="home.php"><span class="icon-home2"></span>EL PUEBLO</a></li>
                <li><a href="#"><span class="icon-glass2"></span>FIESTAS</a></li>
                <li><a href="torneos.php"><span class="icon-trophy"></span>TORNEOS</a></li>
                <li><a href="#"><span class="icon-book"></span>AZRAEL</a></li>
                <li><a href="#"><span class="icon-images"></span>MULTIMEDIA</a></li>                  
                                               
            </ul>
        </nav>
    </header> 
    
<div id="home">
    <div id="pueblo">
            <h1 id="homehead">MUÑICOLAND</h1>
    </div>            	
    <div id="tikitiki">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTikitikisummertime%2F&tabs=timeline&width=340&height=700&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=489868141175282" width="340" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>

<div id='eventos'>
    
<?php include "ocurriendo.php"; ?>
    
</div>

<?php
include_once 'conexion.php';
include_once "funciones_bd.php";

$queryEventos = "SELECT * FROM eventos ORDER BY HORA ASC";
$queryAsistenciasUsuario = "SELECT EVENTO_ID
FROM asiste
WHERE USUARIO_ID = (
	SELECT ID
    FROM usuarios
    WHERE USUARIO = '$username'
)";

//SELECT eventos.*, COUNT(USUARIO_ID) 
// FROM eventos
// LEFT JOIN asiste ON EVENTO_ID = ID
// GROUP BY EVENTO_ID
// ORDER BY HORA ASC
$listaEventos = mysqli_query($conexion, $queryEventos);
$asistenciasUsuario = array_column(mysqli_fetch_all(mysqli_query($conexion, $queryAsistenciasUsuario), MYSQLI_NUM), 0);

?>

<div class="col s12 m7">
    <h2 class="header">Horizontal Card</h2>
    <div class="card horizontal ">
      <div class="card-image">
        <img src="https://lorempixel.com/100/190/nature/6">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.</p>
        </div>
        <div class="card-action">
          <a href="#">This is a link</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12 m7">
    <h2 class="header">Horizontal Card</h2>
    <div class="card horizontal ">
      <div class="card-image">
        <img src="https://lorempixel.com/100/190/nature/6">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.</p>
        </div>
        <div class="card-action">
          <a href="#">This is a link</a>
        </div>
      </div>
    </div>
  </div>

 <table id='progfiestas'>
 <caption> EL PUEBLO EN FIESTAS: </caption>   
 <thead>                                 
    <th>HORA</th>
    <th>EVENTO</th>               
    <th>LUGAR</th>             
    <th>¿VAS A ASISTIR?</th>
 </thead>
 <tbody>
 <?php


while ($fila = mysqli_fetch_assoc($listaEventos))

{
    $ID = $fila["ID"];
    $asiste = in_array($ID, $asistenciasUsuario);
?>
<tr>    
    <td name="HORA"><?php echo $fila['HORA'] ?></td>
    <td name="EVENTO"><?php echo  $fila['EVENTO'] ?></td>
    <td name="LUGAR"><?php echo  $fila['LUGAR'] ?></td>
    <td><?php
        echo '<button class="botonNoAsistir" data-idevento="'. $ID . '" data-showonstart="'. json_encode($asiste) . '" onclick="noAsistir(' . $ID . ')">NO VOY</button>';
        echo '<button class="botonAsistir" data-idevento="'. $ID . '" data-showonstart="'. json_encode(!$asiste) . '" onclick="asistir(' . $ID . ')">ASISTIRÉ</button>';

        /*if($asiste === true) {
            echo '<button onclick="noAsistir(' . $ID . ')">NO VOY</button>';
        } else {
            echo '<button onclick="asistir(' . $ID . ')">ASISTIRÉ</button>';
        }*/
    ?></td>
</tr>

<?php 
}
?>
</tbody>
</table>

<script type="text/javascript" src="util.js"></script>
<script type="text/javascript">
$(document).ready(() => {
    
    // Refrescar visibilidad de botones asistir
    const botonesAsistir = $('.botonAsistir');
    $.each(botonesAsistir, function(index, b) {
        const button = $(b);
        //button.data("showonstart") ? button.show() : button.hide();
        const mostrar = button.data("showonstart");
        if(mostrar){
            button.show();
        }else{
            button.hide();
        }
    });
    // Refrescar visibilidad de botones no asistir
    const botonesNoAsistir = $('.botonNoAsistir');
    $.each(botonesNoAsistir, function(index, b) {
        const button = $(b);
        const mostrar = button.data("showonstart");
        if(mostrar){
            button.show();
        }else{
            button.hide();
        }
    });
});

function asistir(idEvento){
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');
    
    const datos = 'ID=' + idEvento;
    post(
        'asistencia.php',
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

function noAsistir(idEvento){
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');

    const datos = 'ID=' + idEvento;
    post(
        'NOasistencia.php',
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
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


</div>
    
  </body>
  <!-- <th><form action='asistencia.php' method='post'><label class='container'> SÍ<input type='checkbox' name='asist' checked='checked'><span class='checkmark'></span></label>
 <label class='container'> NO<input type='checkbox' ><span class='checkmark'></span></label></th>
 <input type='submit'></input>
 </form> 

<h3 align="center">¿Estás seguro? ¡Anímate a participar! <input type='submit'></input></h3>

         <thead>
              <tr>
                  <th>FECHA</th>
                  <th>HORA</th>
                  <th>EVENTO</th>
                  <th>LUGAR</th>
                  <th>¿VAS A ASISTIR?</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td>SÁBADO 15</td>
                  <td>12:00</td>
                  <td>TORNEO MUS</td>
                  <td>BAR EDU</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="1" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>            
              </tr>
              <tr>
                  <td>DOMINGO 16</td>
                  <td>15:00</td>
                  <td>PAELLA</td>
                  <td>PLAZA PRINCIPAL</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="2" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>   
              </tr>
              <tr>
                  <td>SÁBADO 15</td>
                  <td>12:00</td>
                  <td>TORNEO MUS</td>
                  <td>BAR EDU</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="3" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>
              <tr>
                  <td>DOMINGO 16</td>
                  <td>15:00</td>
                  <td>PAELLA</td>
                  <td>PLAZA PRINCIPAL</td>
               <td><label class="container"> SÍ<input type="checkbox" name="asist" value="4" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>
              <tr>
                  <td>SÁBADO 15</td>
                  <td>12:00</td>
                  <td>TORNEO MUS</td>
                  <td>BAR EDU</td>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>
              <tr>
                  <td>DOMINGO 16</td>
                  <td>15:00</td>
                  <td>PAELLA</td>
                  <td>PLAZA PRINCIPAL</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="6" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>
              <tr>
                  <td>SÁBADO 15</td>
                  <td>12:00</td>
                  <td>TORNEO MUS</td>
              <td>BAR EDU</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="7" checked="checked"><span class="checkmark"></span></label>
              <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>
              <tr>
                  <td>DOMINGO 16</td>
                  <td>15:00</td>
                  <td>PAELLA</td>
                  <td>PLAZA PRINCIPAL</td>
              <td><label class="container"> SÍ<input type="checkbox" name="asist" value="8" checked="checked"><span class="checkmark"></span></label>
            <label class="container"> NO<input type="checkbox" ><span class="checkmark"></span></label></td>
              </tr>   
              </tbody>    
     </table> -->
</html>