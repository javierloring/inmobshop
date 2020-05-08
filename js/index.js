/**
 * Gestiona los anuncios de nivel 5, que aparecen en portada de la web
 * @param  {element} element elemento receptor de la portada
 * @return {[type]}         [description]
 */
function colocar_portada(element){
    //solicitamos al servidor el recurso colocar-portada.php por get
    //esperamos un json {'id_anuncio': valor id, 'url_foto_principal': cadena url}
    var url = 'negocio\\colocar_portada.php';
    $.get(url)
    .done(function(nivel5){
        _nivel5 = $.parseJSON(nivel5);
        var html_portada = '<img src = "';
        var url_foto_principal = _nivel5[url_foto_principal];
        html_portada += url_foto_principal
                        + 'height = "500px"'
                        + 'title="comentario"'
                        + 'alt = "">';
        $('#portada').html(html_portada);
        var html_enlace =

        <a href="negocio\anuncio-especifico.php?nombre=<?= $nombre ?>&url=<?= $url ?>">
            Lujoso chalet en Zahara de los Atunes, 2.500.000 €</a>


    });

}
