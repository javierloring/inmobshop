
//mostramos los contratos en vigor del usuario y los anuncios vinculados a los mismos
//realizamos la consulta a la BD y la dibujamos en una tabla
function mostrar_anuncios(){
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
                html1 +='<div id="salida_anuncios_vinculados'+(i+1)+'" '
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
                if(i == 0){
                    html2 = '<table class="w3-table-all w3-striped">'
                                +'<tr>'
                                +'<th>Id</th>'
                                +'<th>Contrato vinculado</th>'
                                +'<th>Localización</th>'
                                +'<th>Tipo operación</th>'
                                +'<th>Tipo inmueble</th>'
                                +'<th>Precio €</th>'
                                +'<th>Vincular a contrato</th>'
                                +'<th>Editar</th>'
                                +'<th>Borrar</th>'
                                +'</tr>';
                }else {
                    html2 = '<table class="w3-table-all w3-striped">';
                }
                var salida_anuncios_vinculados = $('#salida_anuncios_vinculados'+(i+1));
                salida_anuncios_vinculados.html(html2);
                html3 = '';
                if(contratos_en_vigor['anuncios'][s_id_contrato] != undefined){
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
                                        +'</td>';
                                    }else {
                                        html3+=
                                        + s_precio
                                        +'</td>';
                                    }
                            html3 += '<td style="text-align: center;">'
                                    +'<a class="vincular" href="" data-id_anuncio ="'+s_id+'"'
                                    +'data-operacion="'+s_tipo_operacion+'"'
                                    +'data-tipo_inmueble="'+s_tipo_inmueble+'"'
                                    +'>Vincular</a>'
                                    +'</td>'
                                    +'<td>'
                                    +'<div class="w3-col l2 m6 s6 w3-center">'
                                        +'<a href="">'
                                            +'<span><i class="material-icons inmobshop editar"'
                                            +'style = "font-size: 35px;">create</i></span>'
                                        +'</a>'
                                    +'</div>'
                                    +'</td>'
                                    +'<td>'
                                    +'<div class="w3-col l2 m6 s6 w3-center">'
                                        +'<a href="">'
                                            +'<span><i class="material-icons inmobshop borrar"'
                                            +'style = "font-size: 35px;">delete_sweep</i></span>'
                                        +'</a>'
                                    +'</div>'
                                    +'</td>'
                                    +'</tr>';
                        }
                    }
                }
                html3 += '</table>';
                html2 += html3;
                var salida_anuncios_vinculados = $('#salida_anuncios_vinculados'+(i+1));
                salida_anuncios_vinculados.html(html2);
            }//------------------------------------------------------cierra FOR1
            //registramos eventos en los botones de la tabla de anuncios
            $('.vincular').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                pasar_vinculo_anuncios(event);
            });
            $('.editar').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                editar_anuncios();
            });
            $('.borrar').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                borrar_anuncios();
            });
            $('.vincular_ok').on('click', function(event){
                event.preventDefault();
                event.stopPropagation();
                vincular_anuncios();
            });
    });
}

//una función para abrir el vincular anuncios a contratos
function pasar_vinculo_anuncios(e){
    alert('AQUÍ se muestran anuncios en el formulario vincular, gratis');
    var s_id_anuncio = e.target.dataset.id_anuncio;
    var s_tipo_operacion = e.target.dataset.operacion;
    var s_tipo_inmueble = e.target.dataset.tipo_inmueble;
    salida_id_anuncio = $('#salida_id');
    salida_id_anuncio.html(s_id_anuncio);
    salida_tipo_operacion = $('#salida_tipo_operacion');
    salida_tipo_operacion.html(s_tipo_operacion);
    salida_tipo_inmueble = $('#salida_tipo_inmueble');
    salida_tipo_inmueble.html(s_tipo_inmueble);
}
//una función para abrir el editor de anuncios
function editar_anuncios(){
    alert('AQUÍ se editan anuncios, gratis');

}
//una función para eliminar anuncios
function borrar_anuncios(){
    alert('AQUÍ se borran anuncios, gratis');
}
//una función para vincular anuncios
function vincular_anuncios(){
    alert('AQUÍ se vinculan anuncios, gratis');
    url = '..\\negocio\\vincular-anuncio.php';
}
//rellena los contratos vigentes
function rellenar_contratos_vigentes(){
    url = '..\\negocio\\contratos-en-vigor.php';
    adjunto = {'id_usuario': id_usuario,
                'tipo_usuario': tipo_usuario};
    $.post(url, adjunto)
        .done(function(respuesta){
            var contratos = $.parseJSON(respuesta);
            var cont_vigentes = $('#contratos_vigentes');
            html = '';
            for (var i = 0; i < contratos.length; i++) {
                var s_nombre_contrato = contratos[i].nombre_servicio;
                html += '<div id="contratos_vigentes'+(i+1)+'" '
                            +'class="w3-col w3-small w3-text-inmobshop"'
                            +'style="width: 100%;margin: 0;">'
                            + '<b>C'+(i+1)+'. ' + s_nombre_contrato +'</b>'
                        +'</div>';
                if(i == contratos.length-1){
                    salida_contratos = $('#contratos_vigentes');
                    salida_contratos.html(html);
                }
            }
        });

}
