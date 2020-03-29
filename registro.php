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

    <div id="general">
        <h1 align="center">¡REGÍSTRATE PARA ENTRAR!</h1>    
        <div id="escudo" align="center"><img width="200" height="133" hspace="20" src="index/banderaavila.png"> <img align="center" width="150" height="268" hspace="20" src="index/escudopueblo.jpg"><img width="200" height="133" hspace="20" src="index/banderaspain.png"></div>                
        <hr style="color: #0056b2;"/>
        <div class="logintitulo" align="center">CREA UNA CUENTA:</div>
        <p align="center" style="color: white">O PINCHA <a href="index.php">AQUÍ</a> PARA INICIAR SESION</p>
            <hr style="color: #0056b2;"/>
            <br>
                <form action="registro.php" method="post" class="formlogin">            
                <input type="text" placeholder="USUARIO" name="USUARIO"/>            
                <br>
                <br>            
                <input type="text" placeholder="NOMBRE" name="NOMBRE"/>            
                <br>
                <br>            
                <input type="text" placeholder="APELLIDO" name="APELLIDO"/>           
                <br>
                <br>            
                <input type="email" placeholder="EMAIL" name="EMAIL"/>            
                <br>
                <br>
                <input type="password" placeholder="PASSWORD" name="PASSWORD"/>
                <br>
                <br>
                <div class="button">
                <button type="submit" name="CREAR"><b>CREAR<b></button>
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


