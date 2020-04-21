$(document).ready(function () {
    cargarRondas();
});

function cargarRondas() {
    const url = `${URL_BASE}/${URL_API}/${ENDPOINT_TORNEOS}`;
    get(
        url,
        response => {
            const torneos = JSON.parse(response);
            const rondas = torneos.rondas;
            mostrarEnfrentamiento(rondas);
        },
            error => {
                console.error('Error al cargar los eventos', error);
            }
        
    );
}


function mostrarEnfrentamiento(rondas) {
    const contenedor = $('#contenedor-rondas');
    const plantilla = $('#plantilla-ronda');
    const plantillaString = plantilla.prop('outerHTML');  // Convertimos el elemento html a string
    for (const rondas in plantillaString) {
        const enfrentamiento = rondas.enfrentamientos;

        $.each(enfrentamiento, function (i, enfrentamiento) {            
            const equipo1 = enfrentamiento.equipo1;
            const equipo2 = enfrentamiento.equipo2;
            const bracketRellenado = plantillaString
                .replace(/{{Equipo1}}/g, equipo1)
                .replace(/{{Equipo2}}/g, equipo2)
                //.replace(/{{enfrentamiento}}/g, rondas.enfrentamientos)
                ;
            const torneoHtml = $(bracketRellenado);
            torneoHtml.show();
            torneoHtml.removeAttr('id');
            contenedor.append(torneoHtml);
        });      
       
    }
    plantilla.remove();
}

function clonarBrackets(rondas) {

    var enfrentamiento = $('#enfrentamiento');
    for (var i = 0; i <= rondas; i++) {
        enfrentamiento.clone().insertAfter(enfrentamiento);
    }

}