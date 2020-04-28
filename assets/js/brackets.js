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
    const nombreRonda = nombresRonda.find(n => n.id === ronda.id).nombre;
    const plantillaRondaRellenada = plantillaRondaString.replace(/{{nombreRonda}}/g, nombreRonda);
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
