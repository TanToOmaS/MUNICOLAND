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
    <!-- SweetAlert CSS -->
    <!-- <link rel="stylesheet" href="assets/css/sweetalert2.min.css"> -->
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
      <h1 class="cabecera">MUÑICOLAND</h1>
    </div>     	
  <h4 style="text-align: center">ELIMINATORIAS LUCHA</h4> 
  <div class="brackets" id="octavos">
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

  <div class="brackets" id="cuartos" style="float:left; position:relative; width: 20%; top:18em">
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

  <div class="brackets" id="semis" style="float:left; position:relative; width: 20%; top:25.2em">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>
        <br> 
        <li class="collection-item teal lighten-2">EQUIPO 3</li>
        <li class="collection-item teal lighten-2">EQUIPO 4</li>                   
      </ul>
  </div>

  <div class="brackets" id="final" style="float:left; position:relative; width: 20%; top:29em">
    <ul class="collection with-header">        
        <li class="collection-item teal lighten-2">EQUIPO 1</li>
        <li class="collection-item teal lighten-2">EQUIPO 2</li>                           
      </ul>
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