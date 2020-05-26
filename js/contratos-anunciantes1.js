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
salida_anuncios_vinculados = $('#salida_anuncios_vinculados');
nombre_servicio = document.getElementById('salida_nombre').innerHTML;
contratar_servicio = $('#contratar');

//recupera servicios disponibles para el tipo de usuario
//registra eventos en el listado para rellenar el cuadro de detalle
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
//rellena el cuadro de detalle de los servicios contratables para el tipo de usuario
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
    url2 = '..\\negocio\\anuncios-vinculados.php';
    url3 = '..\\negocio\\tipo-inmueble.php';
    adjunto1 = {'id_usuario': id_usuario,
                'tipo_usuario': tipo_usuario};
    $.post(url1, adjunto1)
        .done(function(respuesta1){
            var contratos_en_vigor = $.parseJSON(respuesta1);
            var html = '';
            for (var i = 0; i < contratos_en_vigor.length; i++) {
                var s_nombre_contrato = contratos_en_vigor[i].nombre_servicio;
                salida_nombre_contrato.html('<b>C'+(i+1)+'. ' + s_nombre_contrato +'</b>');
                var s_fecha = contratos_en_vigor[i].fecha_contrato;
                salida_fecha_contrato.html(s_fecha);
                adjunto2 = {'id_contrato': contratos_en_vigor[i].id_contrato,
                            'id_usuario': id_usuario,
                            'tipo_usuario': tipo_usuario};
                $.post(url2, adjunto2)
                    .done(function(respuesta2){
                        var anuncios_vinculados = $.parseJSON(respuesta2);
                        html = '<table class="w3-table w3-bordered">'
                                    +'<tr>'
                                    +'<th>Id</th>'
                                    +'<th>Contrato vinculado</th>'
                                    +'<th>Localización</th>'
                                    +'<th>Tipo operación</th>'
                                    +'<th>Tipo inmueble</th>'
                                    +'<th>Precio €</th>'
                                    +'</tr>';
                        for (var i = 0; i < anuncios_vinculados.length; i++) {
                            var s_id = anuncios_vinculados[i].id_anuncio;
                            var s_contrato_vinculado = 'C'+(i+1)+'. ' + s_nombre_contrato;
                            var via = anuncios_vinculados[i].via;
                            var num_via = anuncios_vinculados[i].numero_via;
                            var cod_postal = anuncios_vinculados[i].cod_postal;
                            var localidad = anuncios_vinculados[i].localidad;
                            var provincia = anuncios_vinculados[i].provincia;
                            var s_localizacion = via + ', ' + num_via + ', '
                                            + cod_postal + ' ' + localidad + ', '
                                            + provincia;
                            var s_tipo_operacion = anuncios_vinculados[i].tipo_operacion;
                            var s_precio = anuncios_vinculados[i].precio;
                            var s_tiempo = anuncios_vinculados[i].tiempo;
                            adjunto3 = {'id_anuncio': s_id};
                            $.post(url3, adjunto3)
                                .done(function(respuesta3){
                                    var tipo_inmueble = $.parseJSON(respuesta3);
                                    var s_tipo_inmueble = tipo_inmueble[0];
                                    html+= '<tr><td>'
                                            + s_id
                                            +'</td><td>'
                                            + s_contrato_vinculado
                                            +'</td><td>'
                                            + s_localizacion
                                            +'</td><td>'
                                            +s_tipo_operacion
                                            +'</td><td>'
                                            +s_tipo_inmueble
                                            +'</td><td>'
                                            if(s_tiempo){
                                                html+=
                                                + s_precio +'/' + s_tiempo
                                                +'</tr>';
                                            }else {
                                                html+=
                                                + s_precio
                                                +'</tr>';
                                            }
                                    html += '</table>';
                                    salida_anuncios_vinculados.html(html);
                            });
                        }
                    });
            }
        });
}

//desactiva el botón contratar servicio
function desactivar_contratar(id_contrato){
    contratar_servicio.prop('class', 'w3-container w3-gray w3-center w3-padding w3-margin');
    contratar_servicio.prop('title', 'No puede contratar nuevos servicios porque tiene un pago pendiente.');
    contratar_servicio.prop('disabled', true);
    contratar_servicio.prop('data-id_contrato', id_contrato);
}

//activa el botón contrataar servicio tras la realización del pago
function activar_contratar(id_contrato){
    contratar_servicio.prop('class', 'w3-container w3-inmobshop w3-hover-blue w3-center w3-padding w3-margin');
    contratar_servicio.prop('title', 'Antes de vincular anuncios a tu servicio debes realizar el pago del mismo.');
    contratar_servicio.prop('disabled', true);
    contratar_servicio.prop('data-id_contrato', id_contrato);
}

//el boton de contratar servicios se anula hasta que se pague el servicio contratado
//tenemos que comprobar si el usuario tiene contrato pendiente de pago
function contrato_pendiente(id_usuario, tipo_usuario){
    url = '..\\negocio\\contrato-pendiente.php';
    adjunto = {'id_usuario': id_usuario,
               'tipo_usuario': tipo_usuario};
    $.post(url, adjunto)
        .done(function(respuesta){
            var contrato = $.parseJSON(respuesta);
            if(!contrato){
                return contrato;
            } else {
                var s_id_contrato = contrato['id_contrato'];
                contratar_servicio.prop('class', 'w3-container w3-gray w3-center w3-padding w3-margin');
                contratar_servicio.prop('title', 'No puede contratar nuevos servicios porque tiene un pago pendiente.');
                contratar_servicio.prop('disabled', true);
                contratar_servicio.prop('data-id_contrato', s_id_contrato);
            }
        });
}

//al contratar se crea un nuevo registro en la base de datos en la tabla contratos
function contrata(){
    url = '..\\negocio\\registrar-contrato.php';
    adjunto = {'id_usuario': id_usuario,
               'tipo_usuario': tipo_usuario,
               'nombre_servicio': document.getElementById('salida_nombre').innerHTML};
    $.post(url, adjunto)
        .done(function(respuesta){
            if(respuesta > 0){//debe ser el id del contrato----------------OJO!!
                alert('ENHORABUENA! ya has contratado el servicio.');
            }else {
                alert('LO SENTIMOS NO has podido contratar el servicio.');
            }
            desactivar_contratar(respuesta);
            mostrar_contratos_en_vigor();//OJO esta debe ser la última sentencia
        });
}

//el pagado se pasa a 1
function pagar_servicio(){
    url = '..\\negocio\\registrar-pago.php';
    var id_contrato = contratar_servicio.prop('data-id_contrato');
    adjunto = {'id_contrato': id_contrato};
    $.post(url, adjunto)
        .done(function(respuesta){
            if(respuesta > 0){
                activar_contratar(id_contrato);
                registrar_alta(id_contrato);
            }else {
                return error = 'El pago no se ha realizado corecctamente.'
            }
        });
}
//se registra en el registro de la aplicación, el alta del contrato
function registrar_alta(id_contrato){
    url = '..\\negocio\\registrar-alta-contrato.php';
    adjunto = {'id_contrato': id_contrato,
                'id_usuario': id_usuario,
                'tipo_usuario': tipo_usuario,
                'nombre_servicio': document.getElementById('salida_nombre').innerHTML};
    $.post(url, adjunto)
        .done(function(respuesta){
            if(respuesta){//numero de registros afectados
                exito = 'El alta se ha realizado correctamente.'
            }else {
                error = 'El alta no se ha realizado corecctamente.'
            }
        });
}
