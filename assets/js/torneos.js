$(document).ready(function() {
    cargarTorneos();
});

function cargarTorneos(){
    const url = `${URL_BASE}/${URL_API}/${ENDPOINT_TORNEOS}`;
    get(
        url,
        response => {
            const torneos = JSON.parse(response);
            mostrarTorneos(torneos);
            //refrescarBotones();
        },
        error => {
            console.error('Error al cargar los eventos', error);
        }
    );
}


function mostrarTorneos(torneos){
    const contenedor = $('#contenedor-torneos');
    const plantilla = $('#plantilla-torneo');
    const plantillaString = plantilla.prop('outerHTML');    // Convertimos el elemento html a string
    $.each(torneos, function(i, torneo) {
        const asiste = true;
        const noAsiste = !asiste;
        // Reemplazamos los parametros de sustitución por los valores del torneo actual
        const plantillaRellenada = plantillaString
            .replace(/{{imagen1}}/g, torneo.img1)
            .replace(/{{imagen2}}/g, torneo.img2)
            .replace(/{{imagen3}}/g, torneo.img3)
            .replace(/{{titulo}}/g, torneo.tipo)
            .replace(/{{fecha}}/g, torneo.fecha)
            .replace(/{{hora}}/g, torneo.hora)
            .replace(/{{descripcion}}/g, torneo.descripcion)
            .replace(/{{asiste}}/g, asiste)
            .replace(/{{noAsiste}}/g, noAsiste)
            .replace(/{{idTorneo}}/g, torneo.id)
        ;
        console.log(plantillaRellenada);
        // Convertimos el string a un elemento html usando Jquery
        const torneoHtml = $(plantillaRellenada);
        torneoHtml.show();   // Anular display none de la plantilla
        torneoHtml.removeAttr('id');
        // Insertar plantilla en DOM
        contenedor.append(torneoHtml);
    });
    plantilla.remove();
}




function asistirTorneo(idTorneo) {
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');

    const datos = 'ID=' + idTorneo;
    post(
        'asistirTorneo.php',
        datos,
        r => {
            if (r == 'true') {
                botonAsistir.hide();
                botonNoAsistir.show();
                toast('success', '!Te esperamos!');
            } else {
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}

function noAsistirTorneo(idTorneo) {
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');

    const datos = 'ID=' + idTorneo;
    post(
        'noAsistirTorneo.php',
        datos,
        r => {
            if (r == 'true') {
                botonAsistir.show();
                botonNoAsistir.hide();
                toast('warning', '!Que pena!');
            } else {
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}