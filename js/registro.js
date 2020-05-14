//enviamos el formulario
function validaFormulario(){
    var tarroMiel = document.getElementById("honeypot");
    if(!tarroMiel.value) {
        return true;
    } //si no existe nada de contenido en el input falso, entonces se envía
    else {
        return false;
    } //si existe, entonces es que es un bot quien intenta completarlo, por lo que no hacemos nada
}


//añadimos los campos del formulario para los usuarios particulares y profesionales
//$dni
function anyadir_campo(){
    $('#particular').attr('class','oculto');
    $('#profesional').attr('class','oculto');
    var tipo_usuario = $('#tipo_usuario')
            .prop('options')[$('#tipo_usuario').prop('selectedIndex')].text;
    if (tipo_usuario == 'Soy anunciante particular') {
        $('#profesional input first-child').attr('required', 'false');
        $('#particular input first-child').attr('required', 'true');
        $('#particular').toggleClass('oculto');
    }else if (tipo_usuario == 'Soy profesional inmobiliario') {
        $('#particular input first-child').attr('required', 'false');
        $('#profesional input first-child').attr('required', 'true');
        $('#profesional').toggleClass('oculto');
    }else {
        $('#particular first-child').attr('required', 'false');
        $('#profesional first-child').attr('required', 'false');
    }
}
