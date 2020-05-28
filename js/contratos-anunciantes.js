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
//nueva variable que cuenta los contratos vigentes
num_contratos_vigentes = 0;
contratos_en_vigor = '';

nombre_servicio = document.getElementById('salida_nombre').innerHTML;
contratar_servicio = $('#contratar');

//recupera servicios disponibles para el tipo de usuario
//registra eventos en el listado para rellenar el cuadro de detalle
function mostrar_servicios_tipo(tipo_usuario){
    servicios_tipo_usuario.html('');
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
    var anuncios = $('#anuncios');
    anuncios.html('');
    url1 = '..\\negocio\\anuncios-vinculados.php';
    adjunto1 = {'id_usuario': id_usuario,
                'tipo_usuario': tipo_usuario};
    $.post(url1, adjunto1)
        .done(function(respuesta1){//obtenemos contratos en vigor
            contratos_en_vigor = $.parseJSON(respuesta1);
            var html1 = '';
            var html2 = '';
            for (var i = 0; i < contratos_en_vigor['contratos'].length; i++) {//-----FOR 1
                //-------------------------------------------------------------
                //genera los div para las cabeceras de los contratos
                html1 += '<div id="contratos_vigor'+(i+1)+'"'
                            +'class="w3-col w3-small w3-text-inmobshop"'
                            +'style="width: 100%;margin: 0;padding-left: 30px;">'
                            +'<div id="salida_nombre_contrato'+(i+1)+'" class="w3-col w3-panel"'
                            +'style="width: 50%;margin: 0;">'
                            +'</div>'
                            +'<div class="w3-col w3-panel"'
                            +'style="width: 25%;margin: 0;text-align: right;">'
                            +'<b>Fecha</b><input id="id_contrato_ocul" type="hidden" value="">'
                            +'</div>'
                            +'<div id="salida_fecha_contrato'+(i+1)+'"'
                            +'class="w3-col w3-panel"'
                            +'style="width: 25%;margin: 0;">'
                            +'</div>'
                        +'</div>'
                        +'<div id="salida_anuncios_vinculados'+(i+1)+'" '
                            +'class="w3-col w3-small w3-text-inmobshop"'
                            +'style="width: 100%;margin: 0;">'
                        +'</div>';
                //var p_contratos = $('#p_contratos');//redefinida
                var salida_anuncios_vinculados = $('#salida_anuncios_vinculados'+i);
                if(i == 0){
                    anuncios.html(html1);
                    //p_contratos.after(html1);
                    html1 = '';
                }else {
                    salida_anuncios_vinculados.after(html1);
                    html1 = '';
                }
                var s_nombre_contrato = contratos_en_vigor['contratos'][i].nombre_servicio;
                var salida_nombre_contrato = $('#salida_nombre_contrato'+(i+1));//redefinida
                salida_nombre_contrato.html('<b>C'+(i+1)+'. ' + s_nombre_contrato +'</b>');
                var s_fecha = contratos_en_vigor['contratos'][i].fecha_contrato;
                var salida_fecha_contrato = $('#salida_fecha_contrato'+(i+1));//redefinida
                salida_fecha_contrato.html(s_fecha);
                var s_id_contrato = contratos_en_vigor['contratos'][i].id_contrato;
                var salida_id_contrato = $('#id_contrato_ocul');
                salida_id_contrato.prop('value', s_id_contrato);
                html2 = '<table class="w3-table-all w3-striped">'
                            +'<tr>'
                            +'<th>Id</th>'
                            +'<th>Contrato vinculado</th>'
                            +'<th>Localización</th>'
                            +'<th>Tipo operación</th>'
                            +'<th>Tipo inmueble</th>'
                            +'<th>Precio €</th>'
                            +'</tr>';
                var salida_anuncios_vinculados = $('#salida_anuncios_vinculados'+(i+1));
                salida_anuncios_vinculados.html(html2);
                html3 = '';
                // html2 = '';
                for (var j = 0; j <= contratos_en_vigor['anuncios'][s_id_contrato].length-1; j++) {
                    if(contratos_en_vigor['anuncios'][s_id_contrato][j].id_contrato == s_id_contrato){
                        var s_id = contratos_en_vigor['anuncios'][s_id_contrato][j].id_anuncio;
                        var s_nombre_contrato = contratos_en_vigor['anuncios'][s_id_contrato][j].nombre_servicio;
                        var s_contrato_vinculado = 'C'+(i+1)+'. ' + s_nombre_contrato;
                        var via = contratos_en_vigor['anuncios'][s_id_contrato][j].via;
                        var num_via = contratos_en_vigor['anuncios'][s_id_contrato][j].numero_via;
                        var cod_postal = contratos_en_vigor['anuncios'][s_id_contrato][j].cod_postal;
                        var localidad = contratos_en_vigor['anuncios'][s_id_contrato][j].localidad;
                        var provincia = contratos_en_vigor['anuncios'][s_id_contrato][j].provincia;
                        var s_localizacion = via + ', ' + num_via + ', '
                                        + cod_postal + ' ' + localidad + ', '
                                        + provincia;
                        var s_tipo_operacion = contratos_en_vigor['anuncios'][s_id_contrato][j].tipo_operacion;
                        var s_precio = contratos_en_vigor['anuncios'][s_id_contrato][j][28];//precio
                        var s_tiempo = contratos_en_vigor['anuncios'][s_id_contrato][j].tiempo;
                        if(contratos_en_vigor['anuncios'][s_id_contrato][j].id_construccion != null){
                            s_tipo_inmueble = contratos_en_vigor['anuncios'][s_id_contrato][j].tipo_construccion;
                        }else if(contratos_en_vigor['anuncios'][s_id_contrato][j].id_terreno != null){
                            s_tipo_inmueble = contratos_en_vigor['anuncios'][s_id_contrato][j].tipo_suelo;
                        }

                        html3+= '<tr><td>'
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
                                    html3+=
                                    + s_precio +'/' + s_tiempo
                                    +'</tr>';
                                }else {
                                    html3+=
                                    + s_precio
                                    +'</tr>';
                                }
                    }
                }
                html3 += '</table>';
                html2 += html3;
                var salida_anuncios_vinculados = $('#salida_anuncios_vinculados'+(i+1));
                salida_anuncios_vinculados.html(html2);
            }//------------------------------------------------------cierra FOR1
    });
}

//desactiva el botón contratar servicio
function desactivar_contratar(id_contrato){
    $('#contratar').off('click', contrata);
    contratar_servicio.prop('class', 'w3-container w3-gray w3-center w3-padding w3-margin');
    contratar_servicio.prop('title', 'No puede contratar nuevos servicios porque tiene un pago pendiente.');
    contratar_servicio.prop('disabled', true);
    contratar_servicio.prop('data-id_contrato', id_contrato);
}

//activa el botón contrataar servicio tras la realización del pago
function activar_contratar(id_contrato){
    $('#contratar').on('click', contrata);
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
                //alert('ENHORABUENA! ya has contratado el servicio.');
            }else {
                //alert('LO SENTIMOS NO has podido contratar el servicio.');
            }
            desactivar_contratar(respuesta);
            mostrar_servicios_tipo(id_usuario);
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
