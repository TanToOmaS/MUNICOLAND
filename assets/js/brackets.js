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
      mostrarRondas(rondas);
    },
    error => {
      console.error('Error al cargar los eventos', error);
    }

  );
}

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
  const contenedor = $('#plantilla-ronda');
  const plantilla = $('#plantilla-enfrentamiento');
  let rondasOrdenadas = rondas.sort(function (rondaA, rondaB) {
    return rondaB.id - rondaA.id;
  });
  
  $.each(rondas, function (i, rondasOrdenadas) {
    const enfrentamiento = rondasOrdenadas.enfrentamientos;
    console.log(enfrentamiento);
    $.each(enfrentamiento, function (i, enfrentamiento) {
      const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamiento, 1);
      const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamiento, 2);
      const plantillaString = plantilla.prop('outerHTML');    // Convertimos el elemento html a string
      const plantillaRellenada = plantillaString
        .replace(/{{Equipo1}}/g, enfrentamiento.equipo1.nombre)
        .replace(/{{Equipo2}}/g, enfrentamiento.equipo2.nombre)
        .replace(/{{resultado1}}/g, puntEquipo1)
        .replace(/{{resultado2}}/g, puntEquipo2)
        ;
      const rondasHtml = $(plantillaRellenada);
      rondasHtml.show();   // Anular display none de la plantilla
      rondasHtml.removeAttr('id');

      contenedor.append(rondasHtml);
    })
  });

  plantilla.remove();
}

// $.each(enfrentamientos, function (i, enfrentamiento) {

//   let eq1Gana = puntEquipo1 > puntEquipo2;
//   let eq2Gana = puntEquipo2 > puntEquipo1;
//   
//   };
// });

// const rondaFinal = rondas.find(r => r.id === 1);
// const enfrentamientoFinal = rondaFinal.enfrentamientos[0];
// const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamientoFinal, 1);
// const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamientoFinal, 2);
// const eqGanador = puntEquipo1 > puntEquipo2 ? enfrentamientoFinal.equipo1 : enfrentamientoFinal.equipo2;
// brackets.push(rondaCampeon);



// $.each(rondasOrdenadas, (i, r) => rounds2[r.id] = []);

// $.each(rondasOrdenadas, function (i, ronda) {
//   var bracketsRonda = [];
//   $.each(ronda.enfrentamientos, function (i, enfrentamiento) {
//     const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamiento, 1);
//     const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamiento, 2);
//     let eq1Gana = puntEquipo1 > puntEquipo2;
//     let eq2Gana = puntEquipo2 > puntEquipo1;
//     const tituloEq1 = enfrentamiento.equipo1.nombre + '   |   ' + puntEquipo1;
//     const tituloEq2 = enfrentamiento.equipo2.nombre + '   |   ' + puntEquipo2;
//     const bracket = {
//       player1: { name: tituloEq1, winner: eq1Gana, ID: enfrentamiento.equipo1.id },
//       player2: { name: tituloEq2, winner: eq2Gana, ID: enfrentamiento.equipo2.id }
//     };
//     bracketsRonda.push(bracket);
//   });
//   brackets.push(bracketsRonda);
// });

// let titles = [];
// $.each(rondasOrdenadas, function (i, ronda) {
//   const nombre = nombresRonda.find(n => n.id === ronda.id);
//   if (nombre) {
//     titles.push(nombre.nombre);
//   }
// });


