$(document).ready(function () {
    cargarEventos();
});

function parsearEventos(response) {
    const eventosJson = JSON.parse(response);
    return eventosJson.map(function (evento) {
        evento.fechaInicio = stringToDatetime(evento.fechaInicio);
        evento.fechaFin = stringToDatetime(evento.fechaFin);
        return evento;
    });
}

function cargarEventos() {
    const url = 'http://localhost/municoland/controlador/eventos';
    get(
        url,
        response => {
            const eventos = eliminarEventosAntiguos(parsearEventos(response));
            mostrarEventos(OrdenarEventos(eventos));
            mostrarProximosEventos(filtrarYOrdenarEventosProximos(eventos, 3));
            inicializarCarousel();
            refrescarBotones();
        },
        error => {
            console.error('Error al cargar los eventos', error);
        }
    );
}

function inicializarCarousel() {
    const carousel = $('.carousel');
    M.Carousel.init(carousel, {
        duration: 300,
        indicators: false,
        fullWidth: true
    });

    carousel.carousel();
    setInterval(function () {
        carousel.carousel('next');
    }, 4500);
}

function eliminarEventosAntiguos(eventos) {
    const hoy = new Date();
    return eventos.filter(function (evento) {
        return (hoy.getTime() - evento.fechaInicio.getTime()) < 0;
    });
}

function filtrarYOrdenarEventosProximos(eventos, limite) {
    const ordenados = eventos.sort(function (a, b) {
        return a.fechaInicio - b.fechaInicio;
    });
    return ordenados.splice(0, limite);
}

function OrdenarEventos(eventos) {
    const ordenados = eventos.sort(function (a, b) {
        return a.fechaInicio - b.fechaInicio;
    });
    return ordenados;
}

function mostrarProximosEventos(eventos) {
    const contenedor = $('#contenedor-proximos-eventos');
    const plantilla = $('#plantilla-proximo-evento');
    const plantillaString = plantilla.prop('outerHTML');  // Convertimos el elemento html a string
    $.each(eventos, function (i, evento) {
        const asiste = comprobarAsistencia(evento.usuarios, username);
        const noAsiste = !asiste;
        // Reemplazamos los parametros de sustitución por los valores del evento actual
        const plantillaRellenada = plantillaString
            .replace(/{{urlImagen}}/g, evento.imagen)
            .replace(/{{nombre}}/g, evento.nombre)
            //.replace(/{{idEvento}}/g, evento.id)
            //.replace(/{{noAsiste}}/g, asiste)
            //.replace(/{{asiste}}/g, noAsiste)
            .replace(/{{fecha}}/g, evento.fechaInicio.toLocaleString("es-ES"))
            .replace(/{{lugar}}/g, evento.lugar)
            .replace(/{{descrip}}/g, evento.descripcion)
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

function mostrarEventos(eventos) {
    const contenedor = $('#contenedor-eventos');
    const plantilla = $('#plantilla-evento');
    const plantillaTituloDia = $('#plantilla-eventos-dia');
    const plantillaString = plantilla.prop('outerHTML');  // Convertimos el elemento html a string
    const plantillaTituloDiaString = plantillaTituloDia.prop('outerHTML');
    const eventosAgrupados = agruparEventosPorDia(eventos);
    
    for (const fechaInicio in eventosAgrupados) {
        const contenedorFecha = $('<div class="row grey darken-3"></div>');
        const plantillaTituloDiaRellenada = plantillaTituloDiaString.replace(/{{fecha}}/g, fechaInicio);
        const plantillaHtml = $(plantillaTituloDiaRellenada);
        plantillaHtml.show();
        plantillaHtml.removeAttr('id');
        contenedorFecha.append(plantillaHtml);

        $.each(eventosAgrupados[fechaInicio], function (i, evento) {
            const asiste = comprobarAsistencia(evento.usuarios, username);
            const noAsiste = !asiste;
            // Reemplazamos los parametros de sustitución por los valores del evento actual
            const plantillaRellenada = plantillaString
                .replace(/{{urlImagen}}/g, evento.imagen)
                .replace(/{{nombre}}/g, evento.nombre)
                .replace(/{{idEvento}}/g, evento.id)
                .replace(/{{noAsiste}}/g, asiste)
                .replace(/{{asiste}}/g, noAsiste)
                .replace(/{{fecha}}/g, evento.fechaInicio.toLocaleString("es-ES"))
                .replace(/{{lugar}}/g, evento.lugar)
                .replace(/{{descrip}}/g, evento.descripcion)
                ;
            // Convertimos el string a un elemento html usando Jquery
            const eventHtml = $(plantillaRellenada);
            eventHtml.show();   // Anular display none de la plantilla
            eventHtml.removeAttr('id');
            // Insertar plantilla en DOM
            contenedorFecha.append(eventHtml);
        });
        contenedor.append(contenedorFecha);
    }
    plantilla.remove();
    plantillaTituloDia.remove();
}

function agruparEventosPorDia(eventos) {
    return eventos.reduce(function (mapa, evento) {
        const year = evento.fechaInicio.getFullYear();
        const month = evento.fechaInicio.getMonth() + 1;
        const day = evento.fechaInicio.getDate();
        const fechaInicio = `${day}/${month}/${year}`;

        if(mapa[fechaInicio]){
            mapa[fechaInicio].push(evento);
        }else{
            mapa[fechaInicio] = [evento];
        }
        return mapa;
    }, {});
}

function comprobarAsistencia(usuarios, username) {
    for (let i = 0; i < usuarios.length; i++) {
        const u = usuarios[i];
        if (u.usuario === username) {
            return true;
        }
    }
    return false;
}

function refrescarBotones() {
    // Refrescar visibilidad de botones asistir
    const botonesAsistir = $('.botonAsistir');
    $.each(botonesAsistir, function (index, b) {
        const button = $(b);
        //button.data("showonstart") ? button.show() : button.hide();
        const mostrar = button.data("showonstart");
        if (mostrar) {
            button.show();
        } else {
            button.hide();
        }
    });
    // Refrescar visibilidad de botones no asistir
    const botonesNoAsistir = $('.botonNoAsistir');
    $.each(botonesNoAsistir, function (index, b) {
        const button = $(b);
        const mostrar = button.data("showonstart");
        if (mostrar) {
            button.show();
        } else {
            button.hide();
        }
    });
}

function asistir(idEvento) {
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');

    post(
        `http://localhost/municoland/controlador/eventos/${idEvento}/asistencia`,
        null,
        r => {
            botonAsistir.hide();
            botonNoAsistir.show();
            toast('success', '!Te esperamos!');
        },
        () => toast('error', 'Ha habido un error')
    )
}

function noAsistir(idEvento) {
    const botonAsistir = $('.botonAsistir[data-idEvento="' + idEvento + '"]');
    const botonNoAsistir = $('.botonNoAsistir[data-idEvento="' + idEvento + '"]');

    deleteRequest(
        `http://localhost/municoland/controlador/eventos/${idEvento}/asistencia`,
        null,
        r => {
            botonAsistir.show();
            botonNoAsistir.hide();
            toast('warning', '!Qué pena!');
        },
        () => toast('error', 'Ha habido un error')
    )
}