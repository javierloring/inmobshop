//buscamos todos los servicios que el usuario tiene contratados y todos
//los servicios que el usuario puede contratar
//disponemos del id_de usuario y del tipo de usuario
//tenemos que tener dos recursos que llamar
//obtener-servicio-tipo-usuario
function mostrar_servicios_tipo(tipo_usuario){
    var url = '..\\negocio\\servicios-tipo-usuario.php';
    var adjunto = {'tipo_usuario': tipo_usuario};
    $.post(url, adjunto).
        done(function(datos) {
            servicios = $.parseJSON(datos);
            for (var i = 0; i < servicios.length; i++) {
                //añadimos a la tabla uan fila
                var servicios_tipo_usuario = document.getElementById('cuerpo_servicios_tipo');
                servicios[i].nombre_servico;
                var tr = document.createElement('tr');
                tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
                tr.onclick = function() {
                google.maps.event.trigger(markers[i], 'click');
                iconTd.appendChild(icon);
                nameTd.appendChild(name);
                tr.appendChild(iconTd);
                tr.appendChild(nameTd);
                results.appendChild(tr);
            }
        });
}
function mostrar_servicios_contratados(id){
    return servicios_id;
}
function mostrar_anuncios_vinculados(){
    if(tipo_usuario == 'particular'){
        servicios destinatario = 'todos'
        servicios destinatario = 'particular'

        respuesta colocar en tabla servicios
    }
}
