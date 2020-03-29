<?php 

include_once "user.php";
include_once "user_session.php";

session_start();
$username = $_SESSION['user'];

if (isset($username)) {
    echo "<h3 align='center'>¡Bienvenido! Estás registrado como ". $username. "</h3>";
    setcookie("USUARIO", $username, time()+72000);
}else{
    header('Location:index.php');
}
?>

</script>
<!DOCTYPE html>
<html lang = 'ES'>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="fonts.css">
     <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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
    <div id="torneos">
        <h2 style="text-align: center">¡APÚNTATE A LOS TORNEOS ARCADE!</h2>
        <p class="flow-text">
            Durante las fiestas de Muñico 2020, Azrael acogerá un torneo de diferentes videojuegos arcade en los que podrás competir contra tus amigos.
             
        </p>
    </div>            	
    
    <div class="card-panel teal lighten-2" id="lucha">
    
    <h3 style="text-align:center"> <span style="color: black">TORNEO DE LUCHA <button onclick="asistir(1)">ME APUNTO</button></h3>

    <div class="row">

    <div class="col s4">
        <img src="torneos/Tekken 7.jpg" alt="Tekken 7">
    <p class="flow-text"><span style="color: black">
        Tekken 7 es uno de los juegos de lucha arcade clásicos más aclamados de la historia. El realismo e intensidad de sus combates
  no tienen parangon dentro del género desde su aparición en la plataforma de Sony.</p>
    </div>
     <div class="col s4">
    <img src="torneos/Dragon Ball FighterZ.jpg" alt="Dragon Ball FighterZ">
    <p class="flow-text"><span style="color: black">
        Dragon Ball FighterZ es quizá el mejor título de lucha de la gran saga de anime que enamoró a generaciones enteras. 
        Vivirás frenéticos combates con los personajes más icónicos de la saga Dragon Ball Z y Dragon Ball Super.</p>
    </div>
    <div class="col s4">
    <img src="torneos/Mortal Kombat XL.jpg" alt="Mortal Kombat XL">
    <p class="flow-text"><span style="color: black">
        La aclamada saga Mortal Kombat se vuelve más grande y más salvaje en su edición XL, que añade nuevas apariencias, 
        un nuevo escenario y nueve personajes adicionales con sus brutales fatalities.</p>
    </div>
    </div>
    </div>

    <div class="card-panel  amber darken-1"  id="carreras">
    
    <h3 style="text-align:center"><span style="color: black">TORNEO DE CARRERAS <button onclick="asistir(2)">ME APUNTO</button></h3>

<div class="row">

    <div class="col s4">
        <img src="torneos/Sega All-Stars Racing.jpg" alt="Sonic & Sega All-Stars Racing">
    <p class="flow-text"><span style="color: black">
    Sal a la pista en coche, monster truck, bici o incluso avión en Sonic & Sega All-Stars Racing Transformed.
    Un título de carreras a alta velocidad por circuitos que requieren un gran nivel de habilidad.</p>
    </div>
    <div class="col s4">
    <img src="torneos/Mario Kart Double Dash.jpg" alt="Mario Kart Double Dash">
    <p class="flow-text"><span style="color: black">
    Mario y sus Karts vuelven a la carga dispuestos a ofrecer el doble de diversión gracias a su nuevo sistema dual de conducción.</p>
    </div>
    <div class="col s4">
    <img src="torneos/Downhill Domination.jpg" alt="Downhill Domination">
    <p class="flow-text"><span style="color: black">
    ¿Te gustan los combates extremos? ¡Downhill Domination es combate extremo! 
    Atrévete con carreras frenéticas montaña abajo con tu mountain bike: ¡este no es un juego para debiluchos!</p>
    </div>

</div>
</div>
<div class="card-panel light-green" id="deportes">    
    
    <h3 style="text-align:center"><span style="color: black">TORNEO DE DEPORTES <button onclick="asistir(3)">ME APUNTO</button></h3>

<div class="row">

    <div class="col s4">
        <img src="torneos/FIFA 20.jpg" alt="FIFA 20">
    <p class="flow-text"><span style="color: black">
    Sal a la pista en coche, monster truck, bici o incluso avión en Sonic & Sega All-Stars Racing Transformed.
    Un título de carreras a alta velocidad por circuitos que requieren un gran nivel de habilidad.</p>
    </div>
    <div class="col s4">
    <img src="torneos/NBA 2k PlayGround 2.jpg" alt="NBA 2k PlayGround 2">
    <p class="flow-text"><span style="color: black">
    Mario y sus Karts vuelven a la carga dispuestos a ofrecer el doble de diversión gracias a su 
    nuevo sistema dual de conducción.</p>
    </div>
    <div class="col s4">
    <img src="torneos/London 2012.jpg" alt="London 2012">
    <p class="flow-text"><span style="color: black">
    ¿Te gustan los combates extremos? ¡Downhill Domination es combate extremo! 
    Atrévete con carreras frenéticas montaña abajo con tu mountain bike: ¡este no es un juego para debiluchos!</p>
    </div>

    </div>
    
    </div>

<script type="text/javascript" src="util.js"></script>
<script type="text/javascript">

function asistir(idTorneo){
    const datos = 'ID=' + idTorneo;
    post(
        'funciones_torneos.php',
        datos,
        r => r == 'true' ? alert('¡Te esperamos!') : alert("Ha habido un error"),
        () => alert("Ha fallado la petición")
    )
}

</script>
<script type="text/javascript" src="util.js"></script>   
<script type="text/javascript" src="botonesAsistir.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>