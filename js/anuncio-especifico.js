
function crear_slider(id_anuncio){
    //enviamos una petición ajax al servidor para que nos pase las fotos del
    //anuncio cuyo id tomamos como parámetros
    var url = '/inmobshop/negocio/recuperar-fotos-anuncio.php';
    var id = {'id_anuncio': id_anuncio};
    $.post(url, id)
        .done(function(datos){
            var fotos = $.parseJSON(datos);
            var fotos_str = fotos.urls_textos_fotos;
            fotos_indv = fotos_str.split('\n');//array con fotos y comentarios aislados
            var html_slider = ''
            for (var i = 0; i < fotos_indv.length; i++) {
                var foto_ext = (fotos_indv[i].split(':'));
                var foto_img = foto_ext[0];
                var inicio = foto_img.indexOf('"');
                var fin = foto_img.lastIndexOf('"');
                foto_img = foto_img.slice(inicio+1, fin);
                var foto_com = foto_ext[1];
                inicio = foto_com.indexOf('"');
                fin = foto_com.lastIndexOf('"');
                foto_com = foto_com.slice(inicio+1, fin-1);
                var foto = foto_img;
                var comentario = foto_com;
                html_slider += '<div class="w3-display-container misFotos">'
                                +'<img src="' + foto + '" style="width:100%">'
                                +'<div class="w3-display-bottomleft w3-medium w3-container w3-padding-16 w3-inmobshop">'
                                + comentario
                                +' </div>'
                                +' </div>';
                $('#slider').html(html_slider);
            }
        // //iniciando el slider
        // var slideIndex = 1;
        //montando el slider
        showDivs(slideIndex);
        //una vez apiladas las fotos añadimos los botones
        var html_botones = '<button class="w3-button w3-display-left w3-inmobshop" onclick="plusDivs(-1)">&#10094;</button>'
                      +'<button class="w3-button w3-display-right w3-inmobshop" onclick="plusDivs(1)">&#10095;</button>';
        var html_fotos = $('#slider').html();
        var html_completo = html_fotos + html_botones;
        $('#slider').html(html_completo);
    });
}
/**
 * Vuelve a la página anterior
 * @param  {element} element el enlace sobre el que pulsamos
 */
function volver_anterior(element) {
    element.preventDefault();
    window.history.back();
}
/**
 * Muestra la diapositiva
 * @param  {integer} n número de imagen
 */
 function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("misFotos");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex-1].style.display = "block";
 }
/**
 * Muestra la imagen anterior o posterior (se llama en línea)
 * @param  {integer} n salto de diapositiva (normalmente -1, 1)
 */
function plusDivs(n) {
    showDivs(slideIndex += n);
}

function contactar(){
    var nom = $('#nom').val();
    var correo = $('#correo').val();
    var data = {nombre: nom, email: correo};
    comprobar_usuario(data);
    $.ajax();
    confirm('Debe estar registrado: desea rellenar el formulario de registro?');
    $('#form_3').submit();
}

function comprobar_usuario(data) {

}
