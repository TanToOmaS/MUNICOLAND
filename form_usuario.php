<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>FORMULARIO USUARIOS</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>

<h2 align="center">REGISTRO DE USUARIO</h2>

<?php

include "funciones_bd.php";

$ID = $_POST["ID"];
$NOMBRE = $_POST["user"];
$PASSWORD = $_POST["pass"];
$EMAIL = $_POST["email"];
$EDAD = $_POST["age"];
$FECHA_NACIMIENTO = $_POST["date"];
$DIRECCION = $_POST["address"];
$CODIGO_POSTAL = $_POST["code"];
$PROVINCIA = $_POST["province"];
$GENERO = $_POST["genre"];

include "cabecera.php";
?>

<div align="center"  id="formuser">
	<form action="form_usuario.php" method="post">
            <input type="text" name="ID" placeholder="ID(SOLO MODIFICAR/ELIMINAR)" maxlength="10">
            <br>
            <br>             
            <input type="text" name="user" placeholder="NOMBRE DE USUARIO" maxlength="30">
            <br>
            <br>         
            <input type="password" name="pass" placeholder="PASSWORD" maxlength="15">
            <br>
            <br>
            <input type="email" name="email" placeholder="EMAIL" maxlength="35">
            <br>
            <br>
            <input type="text" name="age" placeholder="EDAD" maxlength="2">
            <br>
            <br>
            <input type="date" name="date" placeholder="FECHA DE NACIMIENTO">
            <br>
            <br>
            <input type="text" name="address" placeholder="DIRECCIÓN" maxlength="35">
            <br>
            <br>
            <input type="text" name="code" placeholder="CÓDIGO POSTAL" maxlength="8">
            <br>
            <br>
            <input type="text" name="province" placeholder="PROVINCIA" maxlength="15">
            <br>
            <br>
            <input type="text" name="genre" placeholder="GENERO" maxlength="10">             
            <br>
            <br>            
            <button type='submit' value='CREAR' name='crear'>CREAR</button> 
            <button type='submit' value='MODIFICAR' name='modificar'>MODIFICAR</button> 
            <button type='submit' value='ELIMINAR' name='eliminar'>ELIMINAR</button>
            
    </form>
</div>

<?php 

if (isset ($_POST ['crear'])){
     
     crearUsuario($NOMBRE,$PASSWORD,$EMAIL,$EDAD,$FECHA_NACIMIENTO,$DIRECCION,$CODIGO_POSTAL,$PROVINCIA,$GENERO);
      
}
if (isset ($_POST ['modificar'])){
     
     modificarUsuario($ID,$NOMBRE,$PASSWORD,$EMAIL,$EDAD,$FECHA_NACIMIENTO,$DIRECCION,$CODIGO_POSTAL,$PROVINCIA,$GENERO);
      
}
if (isset ($_POST ['eliminar'])){
     
     eliminarUsuario($ID);
      
}
 ?>
 
</body>

</html>

   
            
