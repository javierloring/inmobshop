//creamos una zona para arrastrar los archivos
var dropzone = document.getElementById('dropzone');
//registramos los eventos especificos del drag an drop para el elemento
//dropzone
dropzone.ondragenter = dropzone.ondragover = function(e) {
    e.stopPropagation();
    e.preventDefault();
}
dropzone.ondrop = function(e) {
    e.stopPropagation();
    e.preventDefault();
    // obtenemos los datos del objeto u objetos soltados
    var dt = e.dataTransfer;
    var files = dt.files;
    // pasamos el array de obetos a la función para crear miniaturas
    crear_miniaturas(files);
    // pasamos cada elemento del array de objetos a la función de
    // subida de archivos
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        var videoType = /video.*/;
        //si no son imagenes o vídeos seguimos
        if (!(file.type.match(imageType) || file.type.match(videoType))) {
          continue;
        }
        subir_archivo(file);
    }
}
//una función para borrar el contenedor con la preview del archivo
function quitar_div(e) {
    var contenedor = e.parentElement;
    var archivo = contenedor.childNodes[0];
    var nombre_archivo = archivo.value;
    contenedor.parentElement.removeChild(contenedor);
    $.ajax({
        url: 'bajar_archivo.php',
        method: 'POST',
        data: {'archivo': nombre_archivo}
    })
    .done (function(respuesta) {
        alert(respuesta);
    });
}
//una funcion para manejar los archivos. Recorremos el FileList para
//buscar imágenes
function crear_miniaturas(files) {
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        var videoType = /video.*/;
        //si no son imagenes seguimos
        if (!(file.type.match(imageType) || file.type.match(videoType))) {
            alert('El archivo arrastrado no es de un tipo valido.')
            continue;
        }
        //creamos un elemento div que contenga los datos de la foto,
        //el nombre, una miniatura, un comentario y un botón para
        //quitar la foto.
        //Al elemento img donde guardaremos la miniatura en
        //el DOM, le asignamos una clase para facilitar su gestión
        //css, y le añadimos como propiedad file el archivo files[i],
        //finalmente añadimos a la zona de arrastre y previsualización
        //los elementos creados.
        var div = document.createElement('div');
        //jlm----------------añado espacio para nombre y comentario
        var nombre = document.createElement("input");
        nombre.setAttribute('type', 'text');
        nombre.setAttribute('name', 'archivos[]');
        nombre.setAttribute('value', '');
        nombre.value = file.name;
        div.appendChild(nombre);
        //----contenedor de miniatura
        if(file.type.match(imageType)){
            var img = document.createElement("img");
            img.src = 'ajax-loader.gif';
            img.classList.add("obj");
            img.file = file;
            div.appendChild(img);
        }else {
            var video = document.createElement("video");
            video.src = 'ajax-loader.gif';
            video.classList.add("obj");
            video.file = file;
            div.appendChild(video);
        }
        //----comentario de la foto o vídeo
        var comentario = document.createElement("input");
        comentario.setAttribute('type', 'text');
        comentario.setAttribute('name', 'comentarios[]');
        comentario.setAttribute('placeholder', 'comentario...');
        comentario.setAttribute('value', '');
        div.appendChild(comentario);
        //----quitar foto o vídeo
        var quitar = document.createElement('button');
        quitar.setAttribute('type', 'button');
        quitar.setAttribute('value', 'Quitar');
        quitar.setAttribute('onclick', 'quitar_div(this);');
        quitar.innerHTML='Quitar';
        div.appendChild(quitar);
        //----añadimos el contenedor de dato de archivo
        dropzone.appendChild(div);
        //jlm-------------------------------------------------------
        //A continuación establecemos el FileReader para controlar
        //la carga de la imagen de forma asíncrona y enlazarla con
        //el elemento img.
        //Después de crear el nuevo objeto FileReader, configuramos
        //su función onload,
        var reader = new FileReader();
        if(file.type.match(imageType)){
            reader.onload = (
                function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                }
            )(img);
        }else {
            reader.onload = (
                function(aVideo) {
                    return function(e) {
                        aVideo.src = e.target.result;
                    };
                }
            )(video);
        }

        //luego llamamos a readAsDataURL() para comenzar la operación
        //de lectura en segundo plano. Cuando el contenido completo
        //de la imagen ha sido cargado, se convierte a  data: URL,
        //el cuál es pasado al callback onload. Nuestra implementación
        //de esta rutina simplemente establece el atributo src del
        //elemento img cargado, cuyo resultado es la imagen apareciendo
        //en la miniatura en la pantalla del usuario.
        reader.readAsDataURL(file);
    } //---- fin de for
}
//Una función para subir un archivo al servidor
//pasar de AJAX puro a jQuery AJAX
function subir_archivo(file) {
    //jlm--------
    var url = "subir_archivo.php";
    var fd = new FormData();
    fd.append('myFile', file);
    $.ajax({
        url: url,
        method: 'POST',
        data: fd,
        processData: false,//no permitimos que convierta en querystring
        contentType: false,//no configura contentType
    })
    .done(function() {
            //return alert('éxito!');
        });
    //-----------
    // const uri = "subir_archivo.php";
    // const xhr = new XMLHttpRequest();
    // const fd = new FormData();
    //
    // xhr.open("POST", uri, true);
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState == 4 && xhr.status == 200) {
    //         //alert(xhr.responseText); // handle response.
    //     }
    // };
    // fd.append('myFile', file);
    // // Initiate a multipart/form-data upload
    // xhr.send(fd);
}
//Una función para enviar los datos del anuncio y alimentar la base de datos
function enviar_datos(e){
    e.stopPropagation();
    e.preventDefault();
    var url = 'crear_anuncio.php';
    var fd = new FormData('formulario_1');
    $.post(url, fd);
}
