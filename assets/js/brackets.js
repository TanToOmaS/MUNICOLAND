$(document).ready(function () {
  cargarRondas();
});

function cargarRondas() {
  const url = `${URL_BASE}/${URL_API}/${ENDPOINT_TORNEOS}`;
  get(
    url,
    response => {
      const torneos = JSON.parse(response);
      const torneo = torneos[0];
      const rondas = torneo.rondas;
      //cargarTitulo(torneo)
      mostrarRondas(rondas);
    },
    error => {
      console.error('Error al cargar los eventos', error);
    }

  );
}

var rounds;

rounds = [


  //-- OCTAVOS
  [

    {
      player1: { name: "Player 111", winner: true, ID: 111 },
      player2: { name: "Player 211", ID: 211 }
    },

    {
      player1: { name: "Player 112", winner: true, ID: 112 },
      player2: { name: "Player 212", ID: 212 }
    },

    {
      player1: { name: "Player 113", winner: true, ID: 113 },
      player2: { name: "Player 213", ID: 213 }
    },

    {
      player1: { name: "Player 114", winner: true, ID: 114 },
      player2: { name: "Player 214", ID: 214 }
    },

    {
      player1: { name: "Player 115", winner: true, ID: 115 },
      player2: { name: "Player 215", ID: 215 }
    },

    {
      player1: { name: "Player 116", winner: true, ID: 116 },
      player2: { name: "Player 216", ID: 216 }
    },

    {
      player1: { name: "Player 117", winner: true, ID: 117 },
      player2: { name: "Player 217", ID: 217 }
    },

    {
      player1: { name: "Player 118", winner: true, ID: 118 },
      player2: { name: "Player 218", ID: 218 }
    },
  ],

  //-- CUARTOS
  [

    {
      player1: { name: "Player 111", winner: true, ID: 111 },
      player2: { name: "Player 212", ID: 212 }
    },

    {
      player1: { name: "Player 113", winner: true, ID: 113 },
      player2: { name: "Player 214", ID: 214 }
    },

    {
      player1: { name: "Player 115", winner: true, ID: 115 },
      player2: { name: "Player 216", ID: 216 }
    },

    {
      player1: { name: "Player 117", winner: true, ID: 117 },
      player2: { name: "Player 218", ID: 218 }
    },
  ],

  //-- SEMIS
  [

    {
      player1: { name: "Player 111", winner: true, ID: 111 },
      player2: { name: "Player 113", ID: 113 }
    },

    {
      player1: { name: "Player 115", winner: true, ID: 115 },
      player2: { name: "Player 218", ID: 218 }
    },
  ],

  //-- FINAL
  [

    {
      player1: { name: "Player 113", winner: true, ID: 113 },
      player2: { name: "Player 218", ID: 218 },
    },
  ],

  //-- CAMPEON
  [

    {
      player1: { name: "Player 113", winner: true, ID: 113 },
    },
  ],

];

const nombresRonda = [
  { id: 0, nombre: 'CAMPEON' },
  { id: 1, nombre: 'FINAL' },
  { id: 2, nombre: 'SEMIS' },
  { id: 3, nombre: 'CUARTOS' },
  { id: 4, nombre: 'OCTAVOS' }
];

function obtenerResultadoEnfrentamiento(enfrentamiento, numEquipo) {
  if (numEquipo === 1) {
    return enfrentamiento.resultados
      .filter(r => r.equipoGanador === enfrentamiento.equipo1.id)
      .length;
  } else if (numEquipo === 2) {
    return enfrentamiento.resultados
      .filter(r => r.equipoGanador === enfrentamiento.equipo2.id)
      .length;
  }
}

function mostrarRondas(rondas) {
  const contenedor = $('#contenedor-rondas');
  let rondasOrdenadas = rondas.sort(function (rondaA, rondaB) {
    return rondaB.id - rondaA.id;
  });

  let brackets = [];
  let rounds2 = {};
  $.each(rondasOrdenadas, (i, r) => rounds2[r.id] = []);
  console.log(rounds2);
  $.each(rondasOrdenadas[0].enfrentamientos, function(i, enfrentamiento){
    const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamiento, 1);
    const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamiento, 2);
    let eq1Gana = puntEquipo1 > puntEquipo2;
    let eq2Gana = puntEquipo2 > puntEquipo1;
    const tituloEq1 = enfrentamiento.equipo1.nombre + '   |   ' + puntEquipo1;
    const tituloEq2 = enfrentamiento.equipo2.nombre + '   |   ' + puntEquipo2;
    const bracket = {
      player1: { name: tituloEq1, winner: eq1Gana, ID: enfrentamiento.equipo1.id },
      player2: { name: tituloEq2, winner: eq2Gana, ID: enfrentamiento.equipo2.id }
    };
  });




  $.each(rondasOrdenadas, function (i, ronda) {
    var bracketsRonda = [];
    $.each(ronda.enfrentamientos, function (i, enfrentamiento) {
      const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamiento, 1);
      const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamiento, 2);
      let eq1Gana = puntEquipo1 > puntEquipo2;
      let eq2Gana = puntEquipo2 > puntEquipo1;
      const tituloEq1 = enfrentamiento.equipo1.nombre + '   |   ' + puntEquipo1;
      const tituloEq2 = enfrentamiento.equipo2.nombre + '   |   ' + puntEquipo2;
      const bracket = {
        player1: { name: tituloEq1, winner: eq1Gana, ID: enfrentamiento.equipo1.id },
        player2: { name: tituloEq2, winner: eq2Gana, ID: enfrentamiento.equipo2.id }
      };
      bracketsRonda.push(bracket);
    });
    brackets.push(bracketsRonda);
  });
  const rondaFinal = rondas.find(r => r.id === 1);
  const enfrentamientoFinal = rondaFinal.enfrentamientos[0];
  const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamientoFinal, 1);
  const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamientoFinal, 2);
  const eqGanador = puntEquipo1 > puntEquipo2 ? enfrentamientoFinal.equipo1 : enfrentamientoFinal.equipo2;
  const rondaCampeon = [{ player1: { name: eqGanador.nombre, winner: true, ID: eqGanador.id } }];
  brackets.push(rondaCampeon);

  let titles = [];
  $.each(rondasOrdenadas, function (i, ronda) {
    const nombre = nombresRonda.find(n => n.id === ronda.id);
    if (nombre) {
      titles.push(nombre.nombre);
    }
  });
  contenedor.brackets({
    titles: titles,
    rounds: brackets,
    color_title: 'black',
    border_color: 'black',
    color_player: 'black',
    bg_player: 'white',
    color_player_hover: 'black',
    bg_player_hover: 'white',
    border_radius_player: '0px',
    border_radius_lines: '0px',
  });
}


