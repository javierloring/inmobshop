/**
 * Gestiona los anuncios de nivel 5, que aparecen en portada de la web
 * @param  {element} element elemento receptor de la portada
 * @return {[type]}         [description]
 */
function colocar_portada(){
    //solicitamos al servidor el recurso colocar-portada.php por get
    //esperamos un json {'id_anuncio': valor id, 'url_foto_anuncio': cadena url,
    //'localidad': localidad, 'precio': precio}
    var url = '/inmobshop/negocio/colocar-portada.php';
    $.get(url)
        .done(function(datos){
            anuncios_n5 = $.parseJSON(datos);
            var url_foto_anuncio = anuncios_n5[1];
            var urlenlace = url_foto_anuncio.substring(1, url_foto_anuncio.length-1);
            var html_portada = '<img src = "';
            html_portada += urlenlace + '"'
                            + 'height = "500px"'
                            + 'title="comentario"'
                            + 'alt = "">';
            $('#portada').html(html_portada);
            var id_anuncio = anuncios_n5[0];
            var localidad = anuncios_n5[2];
            var precio = anuncios_n5[3];
            var nombre = $('#breadcrumbs p').text();
            var html_enlace = '<a href="presentacion\\anuncio-especifico.php?id_anuncio=';
            html_enlace += id_anuncio + '&nombre=' + nombre + '&url=/inmobshop/">';
            html_enlace += 'Magnífico Piso en ' + localidad + ', ' + precio +' €/mes</a>';
            $('#enlace p').html(html_enlace);
        });

}

function subir(){
    //sacamos el desplazamiento actual de la página
    var desplazamientoActual = $(document).scrollTop();
    //accedemos al control de "ir arriba"
    var subir = $("#subir");
    //compruebo si debo mostrar el botón
    if(desplazamientoActual > 100 && subir.css("display") == "none"){
        subir.fadeIn(500);
    }
    //controlo si debo ocultar el botón
    if(desplazamientoActual < 100 && subir.css("display") == "block"){
        subir.fadeOut(500);
    }
}