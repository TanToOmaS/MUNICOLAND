<?php

//SESSION STUFF FOR SAVING DATA ON $_SESSION
session_start();

require_once('router.php');
$router = new AltoRouter();
$router->setBasePath('/MUNICOLAND/controlador');

function getUsername() {
    $username =  $_SESSION['user'] ?? null;
    if($username == null){
        http_response_code(401);
        die();
    }
    return $username;
}

//MAPPINGS
//TORNEOS
$router->map('GET', '/torneos', function() {
    include_once('ControladorTorneos.php');
    $controlador = new ControladorTorneos();
    $controlador->obtenerTorneos();
}, 'torneos_obtener');

//EVENTOS
$router->map('GET', '/eventos', function() {
    include_once('ControladorEventos.php');
    $controlador = new ControladorEventos();
    $controlador->obtenerEventos();
}, 'eventos_obtener');

$router->map('POST', '/eventos/[i:id_evento]/asistencia', function($idEvento) {
    include_once('ControladorEventos.php');
    $controlador = new ControladorEventos();
    $controlador->registrarAsistencia(getUsername(), $idEvento);
}, 'eventos_asistir');

//$router->map('GET', '/premises/[i:premises_id]/articles', function() {
//    require('Articles/GetArticles.php');
//}, '_articles');

$match = $router->match();


if ($match && is_callable($match['target'])) {
    //$_SESSION['params'] = $match['params'];
    $method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    //if ($method == 'POST' || $method == 'PATCH') {
    //    $_SESSION['REQUEST_BODY'] = json_decode(file_get_contents("php://input"), true);
    //}
    call_user_func_array($match['target'], $match['params']);

    //session_unset();
    //session_destroy();
} else {
    die("404");
    //session_unset();
    //session_destroy();
    // no route was matched so we return 404
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    die();
}