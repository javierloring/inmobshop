//buscamos todos los servicios que el usuario tiene contratados y todos
//los servicios que el usuario puede contratar
//disponemos del id_de usuario y del tipo de usuario

//localización de las salidas
servicios_tipo_usuario = $('#cuerpo_servicios_tipo');
detalle_servicio = $('#detalle_servicio');
salida_nombre = $('#salida_nombre');
salida_nivel = $('#salida_nivel');
salida_num_anuncios = $('#salida_num_anuncios');
salida_num_dias = $('#salida_num_dias');
salida_descripcion = $('#salida_descripcion');
salida_precio = $('#salida_precio');
salida_nombre_contrato = $('#salida_nombre_contrato');
salida_fecha_contrato = $('#salida_fecha_contrato');


function mostrar_servicios_tipo(tipo_usuario){
    var url = '..\\negocio\\servicios-tipo-usuario.php';
    var adjunto = {'tipo_usuario': tipo_usuario};
    $.post(url, adjunto)
    .done(function(respuesta) {
        var servicios = $.parseJSON(respuesta);
        var html = '';
        for (var i = 0; i < servicios.length; i++) {
            var nombre = servicios[i].nombre_servicio;
            html+='<p class="servicio w3-hover-text-blue"><b>'+nombre+'</b></p>';
            servicios_tipo_usuario.html(html);
        }
        servicios_lista = document.getElementsByClassName('servicio');
        for (var i = 0; i < servicios_lista.length; i++) {
            servicios_lista[i].addEventListener('click', detalla_servicio);
        }
    });
}

function detalla_servicio(e) {
    var nombre = e.target.innerHTML;
    var url = '..\\negocio\\servicios-tipo-usuario.php';
    var adjunto = {'tipo_usuario': tipo_usuario};
    $.post(url, adjunto)
    .done(function(respuesta) {
        var servicios = $.parseJSON(respuesta);
        for (var i = 0; i < servicios.length; i++) {
            if(nombre == servicios[i].nombre_servicio){
                var s_nombre = servicios[i].nombre_servicio;
                salida_nombre.html(s_nombre);
                var s_nivel = servicios[i].nivel_servicio;
                salida_nivel.html(s_nivel);
                var s_num_anuncios = servicios[i].num_anuncios;
                salida_num_anuncios.html(s_num_anuncios);
                var s_num_dias = servicios[i].num_dias;
                salida_num_dias.html(s_num_dias);
                var s_descripcion = servicios[i].descripcion;
                salida_descripcion.html(s_descripcion);
                var s_precio = servicios[i].precio;
                salida_precio.html(s_precio);
            }
        }
    });
}

//mostramos los contratos en vigor del usuario y los anuncios vinculados a los mismos
//realizamos la consulta a la BD y la dibujamos en una tabla
function mostrar_contratos_en_vigor(){
    url1 = '..\\negocio\\contratos-en-vigor.php';
    url2 = '..\\negocio\\anuncios-vinculados.php'
    adjunto = {'id_usuario': id_usuario,
                'tipo_usuario': tipo_usuario};
    $.post(url1, adjunto)
        .done(function(respuesta){
            var contratos = $.parseJSON(respuesta);
            var html1 = '';
            for (var i = 0; i < contratos.length; i++) {
                var s_nombre_contrato = contratos[i].nombre_servicio;
                salida_nombre_contrato.html('<b>C'+(i+1)+'. ' + s_nombre_contrato +'</b>');
                var s_fecha = contratos[i].fecha_contrato;
                salida_fecha_contrato.html(s_fecha);
            }
            $.post(url2, adjunto)
                .done(fucntion(){

                });
        });

}
//al contratar se crea un nuevo registro en la base de datos en la tabla contratos
//y al pagarlo el pagado se pasa a 1 se crea un registro del alta el contrato en
//la tabla registros
function contratar_servicio(){
    nombre_servicio = $('#salida_nombre').val();
    url = '..\\negocio\\registrar-contrato.php';
    adjunto = {'id_usuario': id_usuario,
               'tipo_usuario': tipo_usuario,
               'nombre_servicio': nombre_servicio};
    $.post(url, adjunto)
        .done(function(respuesta){

        });
}

function pagar_servicio(){
    nombre_servicio = $('#salida_nombre').val();
    url = '..\\negocio\\registrar-pago.php';
    adjunto = {'id_usuario': id_usuario,
               'tipo_usuario': tipo_usuario,
               'nombre_servicio': nombre_servicio};
    $.post(url, adjunto)
        .done(function(respuesta){
            if(respuesta){
                exito = 'El pago se ha realizado correctamente.'
            }else {
                error = 'El pago no se ha realizado corecctamente.'
            }
        });
    registrar_alta();
}

function registrar_alta(){
    nombre_servicio = $('#salida_nombre').val();
    url = '..\\negocio\\registrar-alta.php';
    adjunto = {'id_usuario': id_usuario,
               'tipo_usuario': tipo_usuario,
               'nombre_servicio': nombre_servicio};
    $.post(url, adjunto)
        .done(function(respuesta){
            if(respuesta){
                exito = 'El alta se ha realizado correctamente.'
            }else {
                error = 'El alta no se ha realizado corecctamente.'
            }
        });
}
