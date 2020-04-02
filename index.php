<?php 

include_once "user.php";
include_once "user_session.php";

$userSession = new UserSession();
$user = new User();

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
    <title>¡MUÑICOLAND!</title>
  </head>
  <body>
    <div id="general">
        <h1 class="bienvenido">¡BIENVENIDO A MUÑICOLAND!</h1>    
        <div id="escudo"><img class="boxshadow" width="200" height="133" hspace="20" src="index/banderaavila.png"> <img class="boxshadow" width="150" height="268" hspace="20" src="index/escudopueblo.jpg"><img class="boxshadow" width="200" height="133" hspace="20" src="index/banderaspain.png"></div>                
        <hr style="color: #0056b2;"/>
        <div class="logintitulo">INICIA SESIÓN:</div>
                <br>        
                <form action="" method="post" class="formlogin">            
                <input class="grey darken-4" type="text" placeholder="USUARIO" name="USUARIO"/>            
                <br>
                <br>         
                <input class="grey darken-4" type="password" placeholder="CONTRASEÑA" name="PASSWORD">
                <br>
                <br>
              <div class="button">
                <button class="btn waves-effect waves-light" type="submit" name="LOGIN">ENTRAR AL PUEBLO<i class="material-icons right">send</i></button>
              </div>
                <p>¿Aún no estás registrado? ¿A qué esperas, <span style="color: white"> a que te traigan un mosto? </span><a href="registro.php">REGÍSTRATE</a></p>                
                </form>
        </div>               
    </div>    
  </body>
</html>

<?php

if(isset($_SESSION['user'])){
  echo "Hay sesión";
  $user->setUser($userSession->getCurrentUser());
  header('Location: home.php');
  
}else if(isset($_POST['USUARIO']) && isset($_POST['PASSWORD'])){
  echo "Validación de login";
  echo "</br>";

   $userForm = $_POST['USUARIO'];
   $passForm = $_POST['PASSWORD'];
   if($user->userExists($userForm, $passForm)){
       echo "usuario validado";
       $userSession->setCurrentUser($userForm);
       $user->setUser($userForm);
       header('Location: home.php');
   }else{
       echo "nombre de usuario y/o password incorrecto";
       $errorLogin = "Nombre de usuario y/o password es incorrecto";
       header('Location: index.php');
  }

 }else{
   echo "Login";
   include_once 'index.php';
 }
?>