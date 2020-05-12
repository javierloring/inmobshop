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
    if(!$('#particular').attr('class', 'oculto')){
        $('#particular').toggleClass('oculto');
        $('#particular input').attr('required', 'false');
    }
    if(!$('#profesional').attr('class', 'oculto')){
        $('#profesional').toggleClass('oculto');
        $('#profesional input').attr('required', 'false');
    }
    var tipo_usuario = $('#tipo_usuario')
            .prop('options')[$('#tipo_usuario').prop('selectedIndex')].text;
    if (tipo_usuario == 'Soy anunciante particular') {
        $('#particular').toggleClass('oculto');
        $('#particular input').attr('required', 'true');
    }else if (tipo_usuario == 'Soy profesional inmobiliario') {
        $('#profesional').toggleClass('oculto');
        $('#profesional input').attr('required', 'true');
    }
}
