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
var rondasOrdenadas;
function mostrarRondas(rondas) {
  const contenedorRondas = $('#contenedor-rondas');
  rondasOrdenadas = rondas.sort(function (rondaA, rondaB) {
    return rondaB.id - rondaA.id;
  });

  const plantillaRonda = $('#plantilla-ronda');
  const contenedorEnfrentamientos = plantillaRonda.find("#contenedor-enfrentamientos");
  const plantillaEnfrentamiento = contenedorEnfrentamientos.find("#plantilla-enfrentamiento");
  const plantillaEnfrentamientoString = plantillaEnfrentamiento.prop("outerHTML");
  
  $.each(rondas, function (_i, ronda) {
    contenedorEnfrentamientos.empty();
    const enfrentamiento = ronda.enfrentamientos;
    $.each(enfrentamiento, function (_i, enfrentamiento) {
      const puntEquipo1 = obtenerResultadoEnfrentamiento(enfrentamiento, 1);
      const puntEquipo2 = obtenerResultadoEnfrentamiento(enfrentamiento, 2);
      const plantillaEnfrentamientoRellenada = plantillaEnfrentamientoString
        .replace(/{{equipo1}}/g, enfrentamiento.equipo1.nombre)
        .replace(/{{resultado1}}/g, puntEquipo1)
        .replace(/{{equipo2}}/g, enfrentamiento.equipo2.nombre)
        .replace(/{{resultado2}}/g, puntEquipo2);
      const enfrentamientoHtml = $(plantillaEnfrentamientoRellenada);
      enfrentamientoHtml.removeAttr('id');
      contenedorEnfrentamientos.append(enfrentamientoHtml);
    });
    plantillaEnfrentamiento.remove();
    const plantillaRondaString = plantillaRonda.prop('outerHTML');    // Convertimos el elemento html a string
    const plantillaRondaRellenada = plantillaRondaString
      .replace(/{{nombreRonda}}/g, ronda.id);
    const rondaHtml = $(plantillaRondaRellenada);
    rondaHtml.show();   // Anular display none de la plantilla
    rondaHtml.removeAttr('id');
    rondaHtml.find("#plantilla-enfrentamiento").remove();
    contenedorRondas.append(rondaHtml);
  });
  plantillaRonda.remove();
}

const nombresRonda = [
  { id: 0, nombre: 'CAMPEON' },
  { id: 1, nombre: 'FINAL' },
  { id: 2, nombre: 'SEMIS' },
  { id: 3, nombre: 'CUARTOS' },
  { id: 4, nombre: 'OCTAVOS' }
];

let titles = [];
$.each(rondasOrdenadas, function (i, ronda) {
  const nombre = nombresRonda.find(n => n.id === ronda.id);
  if (nombre) {
    titles.push(nombre.nombre);
  }
});

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




