<?php 

include_once "user.php";
include_once "user_session.php";
include_once 'conexion.php';
include_once "funciones_bd.php";

session_start();
$username = $_SESSION['user'];


if (isset($username)) {
    echo "<h3 align='center'>¡Bienvenido! Estás registrado como ". $username. "</h3>";
    setcookie("EQUIPO", $username, time()+72000);
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
            <h1 id="homehead">MUÑICOLAND</h1>
    </div>     	
  <h4 style="text-align: center">ELIMINATORIAS LUCHA</h4> 
  <div class="brackets">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 3</li>
        <li class="collection-item teal lighten-2">EQUIPO 4</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 5</li>
        <li class="collection-item teal lighten-2">EQUIPO 6</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 7</li>
        <li class="collection-item teal lighten-2">EQUIPO 8</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 9</li>
        <li class="collection-item teal lighten-2">EQUIPO 10</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 11</li>
        <li class="collection-item teal lighten-2">EQUIPO 12</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 13</li>
        <li class="collection-item teal lighten-2">EQUIPO 14</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 15</li>
        <li class="collection-item teal lighten-2">EQUIPO 16</li>
      </ul>
  </div>

  <div class="brackets" style="float:left; width: 20%">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 3</li>
        <li class="collection-item teal lighten-2">EQUIPO 4</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 5</li>
        <li class="collection-item teal lighten-2">EQUIPO 6</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 7</li>
        <li class="collection-item teal lighten-2">EQUIPO 8</li>      
      </ul>
  </div>

  <div class="brackets" style="float:left; width: 20%">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 3</li>
        <li class="collection-item teal lighten-2">EQUIPO 4</li>                   
      </ul>
  </div>

  <div class="brackets" style="float:left; width: 20%">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>                           
      </ul>
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