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
