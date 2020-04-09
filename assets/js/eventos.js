$(document).ready(function() {
    cargarEventos();
});

function cargarEventos(){
    const url = 'http://localhost/municoland/controlador/eventos';
    get(
        url,
        response => {
            const eventos = JSON.parse(response);
            mostrarEventos(eventos);
            refrescarBotones();
        },
        error => {
            console.error('Error al cargar los eventos', error);
        }
    );
}

function mostrarEventos(eventos){
    const contenedor = $('#contenedor-eventos');
    const plantilla = $('#plantilla-evento');
    const plantillaString = plantilla.prop('outerHTML');    // Convertimos el elemento html a string
    $.each(eventos, function(i, evento) {
        const asiste = comprobarAsistencia(evento.usuarios, username);
        const noAsiste = !asiste;
        // Reemplazamos los parametros de sustitución por los valores del evento actual
        const plantillaRellenada = plantillaString
            .replace(/{{urlImagen}}/g, evento.imagen)
            .replace(/{{nombre}}/g, evento.nombre)
            .replace(/{{idEvento}}/g, evento.id)
            .replace(/{{noAsiste}}/g, asiste)
            .replace(/{{asiste}}/g, noAsiste)
            .replace(/{{fecha}}/g, evento.fecha)
            .replace(/{{lugar}}/g, evento.lugar)
        ;
        // Convertimos el string a un elemento html usando Jquery
        const eventHtml = $(plantillaRellenada);
        eventHtml.show();   // Anular display none de la plantilla
        eventHtml.removeAttr('id');
        // Insertar plantilla en DOM
        contenedor.append(eventHtml);
    });
    plantilla.remove();
}

function comprobarAsistencia(usuarios, username){
    for(let i=0; i < usuarios.length; i++){
        const u = usuarios[i];
        if(u.usuario === username) {
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

function asistir(idEvento){
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');
    
    const datos = 'ID=' + idEvento;
    post(
        'asistencia.php',
        datos,
        r => {
            if(r == 'true') {
                botonAsistir.hide();
                botonNoAsistir.show();
                toast('success', '!Te esperamos!');
            }else{ 
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}

function noAsistir(idEvento){
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');

    const datos = 'ID=' + idEvento;
    post(
        'NOasistencia.php',
        datos,
        r => {
            if(r == 'true') {
                botonAsistir.show();
                botonNoAsistir.hide();
                toast('warning', '!Que pena!');
            }else{ 
                toast('error', 'Ha habido un error');
            }
        },
        () => toast('error', 'Ha habido un error')
    )
}