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
  <link rel="stylesheet" type="text/css" href="assets/libs/dist/style.css">
  <!-- Materialize icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Materialize minified CSS -->
  <link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
  <!-- SweetAlert CSS -->
  <!-- <link rel="stylesheet" href="assets/css/sweetalert2.min.css"> -->


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


    <div class="containerBrackets">

      <div id="contenedor-rondas" class="tournament-bracket tournament-bracket--rounded">

        <div class="tournament-bracket__round" id="plantilla-ronda">
          <h3 class="tournament-bracket__round-title">{{nombreRonda}}</h3>
          <ul id="contenedor-enfrentamientos" class="tournament-bracket__list">
            <li id="plantilla-enfrentamiento" class="tournament-bracket__item" >
              <div class="tournament-bracket__match" tabindex="0">
                <table class="tournament-bracket__table">
                  <!-- <caption class="tournament-bracket__caption">
                    <time datetime="1998-02-18">18 February 1998</time>
                  </caption> -->
                  <thead class="sr-only">
                    <tr>
                      <th>Country</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody class="tournament-bracket__content">
                    <tr class="tournament-bracket__team {{claseEquipo1Ganador}}">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code">{{equipo1}}</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">{{resultado1}}</span>
                      </td>
                    </tr>
                    <tr class="tournament-bracket__team {{claseEquipo2Ganador}}">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code">{{equipo2}}</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-kz" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">{{resultado2}}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>   
          </ul>
        </div>


        <!-- <div class="tournament-bracket__round tournament-bracket__round--semifinals">
          <h3 class="tournament-bracket__round-title">Semifinals</h3>
          <ul class="tournament-bracket__list">
            <li class="tournament-bracket__item">
              <div class="tournament-bracket__match" tabindex="0">
                <table class="tournament-bracket__table">
                  <caption class="tournament-bracket__caption">
                    <time datetime="1998-02-20">20 February 1998</time>
                  </caption>
                  <thead class="sr-only">
                    <tr>
                      <th>Country</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody class="tournament-bracket__content">
                    <tr class="tournament-bracket__team">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Canada">CAN</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">1</span>
                      </td>
                    </tr>
                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Czech Republic">CZE</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-cz" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">2</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>

            <li class="tournament-bracket__item">
              <div class="tournament-bracket__match" tabindex="0">
                <table class="tournament-bracket__table">
                  <caption class="tournament-bracket__caption">
                    <time datetime="1998-02-20">20 February 1998</time>
                  </caption>
                  <thead class="sr-only">
                    <tr>
                      <th>Country</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody class="tournament-bracket__content">
                    <tr class="tournament-bracket__team">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Finland">FIN</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-fi" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">4</span>
                      </td>
                    </tr>
                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Russia">RUS</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-ru" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">7</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
        </div> --> 
        <!-- <div class="tournament-bracket__round tournament-bracket__round--bronze">
          <h3 class="tournament-bracket__round-title">Bronze medal game</h3>
          <ul class="tournament-bracket__list">
            <li class="tournament-bracket__item">
              <div class="tournament-bracket__match" tabindex="0">
                <table class="tournament-bracket__table">
                  <caption class="tournament-bracket__caption">
                    <time datetime="1998-02-21">21 February 1998</time>
                  </caption>
                  <thead class="sr-only">
                    <tr>
                      <th>Country</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody class="tournament-bracket__content">
                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Finland">FIN</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-fi" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">3</span>
                        <span class="tournament-bracket__medal tournament-bracket__medal--bronze fa fa-trophy" aria-label="Bronze medal"></span>
                      </td>
                    </tr>
                    <tr class="tournament-bracket__team">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Canada">CAN</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-ca" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">2</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
        </div> -->
        <!-- <div class="tournament-bracket__round tournament-bracket__round--gold">
          <h3 class="tournament-bracket__round-title">Gold medal game</h3>
          <ul class="tournament-bracket__list">
            <li class="tournament-bracket__item">
              <div class="tournament-bracket__match" tabindex="0">
                <table class="tournament-bracket__table">
                  <caption class="tournament-bracket__caption">
                    <time datetime="1998-02-22">22 February 1998</time>
                  </caption>
                  <thead class="sr-only">
                    <tr>
                      <th>Country</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody class="tournament-bracket__content">
                    <tr class="tournament-bracket__team tournament-bracket__team--winner">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Czech Republic">CZE</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-cz" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">1</span>
                        <span class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy" aria-label="Gold medal"></span>
                      </td>
                    </tr>
                    <tr class="tournament-bracket__team">
                      <td class="tournament-bracket__country">
                        <abbr class="tournament-bracket__code" title="Russia">RUS</abbr>
                        <span class="tournament-bracket__flag flag-icon flag-icon-ru" aria-label="Flag"></span>
                      </td>
                      <td class="tournament-bracket__score">
                        <span class="tournament-bracket__number">0</span>
                        <span class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy" aria-label="Silver medal"></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

</body>

<!-- ZONA JAVASCRIPT: -->
<script src="jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="assets/js/util.js"></script>
<script type="text/javascript" src="assets/js/constantes.js"></script>
<script type="text/javascript" src="assets/js/brackets.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>