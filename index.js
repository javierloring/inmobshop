/**
 * Gestiona los anuncios de nivel 5, que aparecen en portada de la web
 * @param  {element} element elemento receptor de la portada
 * @return {[type]}         [description]
 */
function colocar_portada(){
    //solicitamos al servidor el recurso colocar-portada.php por get
    //esperamos un json {'id_anuncio': valor id, 'url_foto_anuncio': cadena url,
    //'localidad': localidad, 'precio': precio}
    var url = './colocar-portada.php';
    $.get(url)
    .done(function(nivel5){
        jnivel5 = $.parseJSON(nivel5);
        var url_foto_principal = jnivel5['url_foto_principal'];
        var hasta = url_foto_principal.indexOf(':');
        var url = url_foto_principal.slice(0, hasta);
        var comentario = url_foto_principal.slice(hasta+1);
        var html_portada = '<img src = "';
        html_portada += url
                        + 'height = "500px"'
                        + 'title="comentario"'
                        + 'alt = "">';
        $('#portada').html(html_portada);
        var id_anuncio = jnivel5['id_anuncio'];
        var localidad = jnivel5['localidad'];
        var precio = jnivel5['precio'];
        var html_enlace = '<a href="negocio\\anuncio-especifico.php?id_anuncio=';
        html_enlace += id_anuncio + '>';
        html_enlace += 'Magnífico chalet en ' + 'localidad' + ', ' + precio +' €</a>';
        $('#enlace :first-child').html(html_enlace);
    });

}
