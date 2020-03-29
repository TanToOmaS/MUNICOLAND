$(document).ready(() => {
    
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
});

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