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
            refrescarBotones();            
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
        const asiste = comprobarAsistencia(torneo.equipos, torneo.equipos);
        const noAsiste = !asiste;
        const url = construirUrl(torneo);
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
            .replace(/{{url}}/g, url)
        ;
        
        // Convertimos el string a un elemento html usando Jquery
        const torneoHtml = $(plantillaRellenada);
        torneoHtml.show();   // Anular display none de la plantilla
        torneoHtml.removeAttr('id');
        // Insertar plantilla en DOM
        contenedor.append(torneoHtml);
    });
    plantilla.remove();
}

function construirUrl(torneo){
    return "http://localhost/municoland/torneo.php?idTorneo=" + torneo.id;
}

function comprobarAsistencia(equipos, equipo){    
    for(let i=0; i < equipos.length; i++){
        const u = equipos[i];
        if(u.equipos === equipo) {
            return true;
        }
    }
    return false;
}

function refrescarBotones(){
    // Refrescar visibilidad de botones asistir
    const botonesAsistir = $('.botonAsistir');
    $.each(botonesAsistir, function(index, b) {
        const button = $(b);
        //button.data("showonstart") ? button.show() : button.hide();
        const mostrar = button.data("showonstart");
        if(mostrar){
            button.show();
        }else{
            button.hide();
        }
    });
    // Refrescar visibilidad de botones no asistir
    const botonesNoAsistir = $('.botonNoAsistir');
    $.each(botonesNoAsistir, function(index, b) {
        const button = $(b);
        const mostrar = button.data("showonstart");
        if(mostrar){
            button.show();
        }else{
            button.hide();
        }
    });
}

function asistirTorneo(idTorneo) {
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');

    post(
        `http://localhost/municoland/controlador/torneos/${idTorneo}/participacion`,
        null,
        r => {
            botonAsistir.hide();
            botonNoAsistir.show();
            toast('success', '!Te esperamos!');
        },
        () => toast('error', 'Ha habido un error')
    )
}

function noAsistirTorneo(idTorneo) {
    const botonAsistir = $('.botonAsistir[data-idTorneo="' + idTorneo + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idTorneo="' + idTorneo + '"]');

    deleteRequest(
        `http://localhost/municoland/controlador/torneos/${idTorneo}/participacion`,
        null,
        r => {
            botonAsistir.show();
            botonNoAsistir.hide();
            toast('warning', '!Qué pena!');
        },
        () => toast('error', 'Ha habido un error')
    )
}