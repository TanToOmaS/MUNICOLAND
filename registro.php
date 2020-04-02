<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Motrar todos los errores de PHP
error_reporting(-1); 
// Motrar todos los errores de PHP
ini_set('error_reporting', E_ALL);
//MANTENGO LA SESION ACTIVADA:

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
    <style>
        body {background-color: #000;}
    </style>
    <meta charset="utf-8">    
    <title>REGÍSTRATE</title>
  </head>
  <body>

<?php

include "funciones_bd.php";

$USUARIO = $_POST["USUARIO"];
$NOMBRE = $_POST["NOMBRE"];
$APELLIDO = $_POST["APELLIDO"];
$EMAIL = $_POST["EMAIL"];
$PASSWORD = $_POST["PASSWORD"];

 ?>

    <div id="home">
        <h1 class="bienvenido">¡REGÍSTRATE PARA ENTRAR!</h1>    
        <div id="escudo"><img class="boxshadow" width="200" height="133" hspace="20" src="index/banderaavila.png"> <img class="boxshadow" width="150" height="268" hspace="20" src="index/escudopueblo.jpg"><img class="boxshadow" width="200" height="133" hspace="20" src="index/banderaspain.png"></div>                
        <hr style="color: #0056b2;"/>
        <div class="logintitulo">CREA UNA CUENTA:
        <p>O PINCHA <a href="index.php">AQUÍ</a> PARA INICIAR SESION</p>
        </div>
            <hr style="color: #0056b2;"/>
            <br>
                <form action="registro.php" method="post" class="formlogin">            
                <input class="grey darken-4" type="text" placeholder="USUARIO" name="USUARIO"/>            
                <br>
                <br>            
                <input class="grey darken-4" type="text" placeholder="NOMBRE" name="NOMBRE"/>            
                <br>
                <br>            
                <input class="grey darken-4" type="text" placeholder="APELLIDO" name="APELLIDO"/>           
                <br>
                <br>            
                <input class="grey darken-4" type="email" placeholder="EMAIL" name="EMAIL"/>            
                <br>
                <br>
                <input class="grey darken-4" type="password" placeholder="PASSWORD" name="PASSWORD"/>
                <br>
                <br>
                <div class="button">
                <button class="btn waves-effect waves-light" type="submit" name="CREAR">CREAR<i class="material-icons right">send</i></button>
                </div>    
                </form>
        </div>
    </div>
<?php
if (isset ($_POST ['CREAR'])){
  crearUsuario($USUARIO,$NOMBRE,$APELLIDO,$EMAIL,$PASSWORD);
}
?>
  </body>
</html>


