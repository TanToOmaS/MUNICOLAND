<?php

include_once "user.php";
include_once "user_session.php";
include_once 'conexion.php';
include_once "funciones_bd.php";

session_start();
$username = $_SESSION['user'];


if (isset($username)) {
  echo "<h3 align='center'>¡Bienvenido! Estás registrado como " . $username . "</h3>";
  setcookie("EQUIPO", $username, time() + 72000);
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
  <!-- SweetAlert CSS -->
  <!-- <link rel="stylesheet" href="assets/css/sweetalert2.min.css"> -->
  <link href="assets/libs/jquery-bracket/jquery.bracket.min.css" rel="stylesheet">

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

    <h4 id="titulo-torneo" style="text-align: center">ELIMINATORIAS {{nombreTorneo}}</h4>
    <div class="brackets" id="contenedor-rondas"></div>
  </div>

</body>

<!-- ZONA JAVASCRIPT: -->
  <script src="jquery-3.4.1.min.js"></script>
  <script src="assets/libs/jquery-bracket/jquery.bracket.min.js"></script>
  <script type="text/javascript" src="assets/js/util.js"></script>
  <script type="text/javascript" src="assets/js/constantes.js"></script>
  <script type="text/javascript" src="assets/js/brackets.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>