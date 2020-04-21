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
            cargarTitulo(torneo)
            mostrarRondas(rondas);
        },
            error => {
                console.error('Error al cargar los eventos', error);
            }
        
    );
}

function cargarTitulo(torneo){

}

/*
var singleElimination = {
  "teams": [             // Matchups
    ["Team 1","Team 2"],// First match
    ["Team 3","Team 4"] // Second match
  ],
  "results": [           // List of brackets (single elimination, so only one bracket)
    [                    // List of rounds in bracket
      [                  // First round in this bracket
        [1, 2],          // Team 1 vs Team 2
        [3, 4]           // Team 3 vs Team 4
      ],
      [                  // Second (final) round in single elimination bracket
        [5, 6],          // Match for first place
        [7, 8]           // Match for 3rd place
      ]
    ]
  ]
}

*/
function mostrarRondas(rondas) {
    const contenedor = $('#contenedor-rondas');
    const teams = rondas[0].enfrentamientos.map(e => 
        [e.equipo1.nombre, e.equipo2.nombre]
    );
    
    const results = [];
    $.each(rondas, function(i, ronda){
        const resultadosRonda = [];
        $.each(ronda.enfrentamientos, function(i, enfrentamiento){
            const puntEquipo1 = enfrentamiento.resultados
            .filter(r => r.equipoGanador === enfrentamiento.equipo1.id)
            .length;
            const puntEquipo2 = enfrentamiento.resultados
            .filter(r => r.equipoGanador === enfrentamiento.equipo2.id)
            .length;
            console.log(enfrentamiento, puntEquipo1, puntEquipo2);
            resultadosRonda.push([puntEquipo1, puntEquipo2]);
        });
        results.push(resultadosRonda);
    });

    const brackets = {"teams": teams, "results": [results]};
    console.log(JSON.stringify(brackets, null, 2));
    contenedor.bracket({
        init: brackets
    });
}