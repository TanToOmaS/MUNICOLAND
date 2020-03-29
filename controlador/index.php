<?php
die("index.php");
//SESSION STUFF FOR SAVING DATA ON $_SESSION
//session_start();

require_once('router.php');
$router = new AltoRouter();
$router->setBasePath('/api');

//MAPPINGS
//TORNEOS
$router->map('GET', '/torneos', function() {
    require('obtenerTorneos.php');
}, 'torneos_obtener');

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
    //session_unset();
    //session_destroy();
    // no route was matched so we return 404
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    die();
}