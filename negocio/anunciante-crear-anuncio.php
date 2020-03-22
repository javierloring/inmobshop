<?php
//id_anuncio
//1. fecha_anuncio
//2. estado('pendiente', 'aprobado')
//3. id_operacion
//4. id_inmueble
//5. descripcion
//6. id_profesional
//6. id_particular
//7. id_contrato
//8. id_gestor
//9. id_fotos
//10. id_videos
//iniciamos sesión
session_start();
$nombre = 'anunciante-tipo-#x->nombre';//obtener de $_SESSION
//accedemos a la base de datos
require ('..\datos\BD.php');
$dbh = BD::conectar();
//El anuncio se crea añadiendole las instancias de las entidades que lo componen:
//El id_anuncio se genera de forma automática al insertar inicialmente el anuncio
//UNO------------------------------------------------------------------------UNO
$fecha = new DateTime('now', 'Europe/London');
//DOS------------------------------------------------------------------------DOS
$estado = 'pendiente';//default
//TRES----------------------------------------------------------------------TRES
//El anuncio tiene una operación: la creamos y obtenemos su id
//Definimos los campos de la operación
$tipo_operacion = '';//('compra', 'alquiler', 'vacacional', 'compartir')
$precio = 0;
$tiempo = '';//('semana', 'quincena', 'mes')
if (isset($_POST['operacion'][''])) {
    // code...
} else {
    // code...
}

//damos de alta la operación
//DB::insertar_registro($dbh, $tabla, $campos, $valores)
$tabla = 'operaciones';
$campos = ['tipo_operacion',
            'precio',
            'tiempo'];
//creamos el array de valores
$valores = [$tipo_operacion,
            $precio,
            $tiempo
        ];
//insertamos el registro
DB::insertar_registro($dbh, $tabla, $campos, $valores);
//obtenemos el id de la operación recien creada
$id_operacion = DB::last_insert_id($tabla);//crear método
//CUATRO------------------------------------------------------------------CUATRO
//El anuncio tiene un inmueble: lo creamos y obtenemos su id

//CINCO--------------------------------------------------------------------CINCO
//El anuncio tiene una descripción
if (isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
}else {

}
//SEIS----------------------------------------------------------------------SEIS
//El anuncio tiene un anunciante
if (isset($_POST['usuario']['id'])) {
    $id_usuario = $_POST['usuario']['id'];
    if (DB::es_profesional($id_usuario)) {
        $id_profesional = BD::get_id_profesional($id_usuario);//crear/ver metodo
        $id_particular = null;
    } else {
        $id_particular = BD::get_id_particular($id_usuario);//crear/ver metodo
        $id_profesional = null;
    }
} else {
    $errores[0] = 'El anuncio no puede crearse sin un id de anunciante.';
}
//SIETE--------------------------------------------------------------------SIETE
//El anuncio se crea para un contrato vigente del que tenemos su id
if (isset($_POST['contrato']['id'])) {
    $id_contrato = $_POST['contrato']['id'];
}else {
    $errores[1] = 'El anuncio no puede publicarse si no tiene contratado un'.
    ' servicio de publicación. Realice un contrato por favor. Existen tarifas'.
    ' gratuitas que precisan darse de alta aunque precise de pago.';
}
//OCHO----------------------------------------------------------------------OCHO
//El anuncio tiene uun supervisor que se introduce al momento de publicarlo tras
//la revisión del anuncio.
//NUEVE--------------------------------------------------------------------NUEVE
//El anuncio tiene una colección de fotos
//subimos los archivos de imagen mientras que el usuario quiera para crear una
//colección, que será un objeto JSON con las urls y textos de cada foto.
$datos_fotos = '';
do {
    if (isset($_POST['acc']) && $_FILES['archivo']['error'] == 0)
    {
        //crea la carpeta para que el anunciante guarde sus fotos
        $carp = (isset($id_particular))?:$id_profesional;
        $dir_fotos = "user-fotografias\\" . $carp;
        //añadimos el nombre del archivo
        $url = $dir_fotos."\\".$_FILES['archivo']['name'];
        mkdir($dir_fotos, 0777, true);
    	//sube el archivo de la nueva foto al directorio de fotos del anunciante
    	move_uploaded_file($_FILES['archivo']['tmp_name'], $url);
        #var_dump($_FILES['archivo']);
        //texto que acompaña a la imagen
        if (isset($_POST['texto_foto']) && $_POST['texto_foto'] != '') {
            $texto = $_POST['texto_foto'];
        } else {
            $texto = '';
        }
        //creamos un valor que convertiremos a un objeto JSON mediante la función
        //CAST(value AS JSON) de MySQL ¿?

        $datos_fotos . =  $url ."\": \"". $texto ."\", ";
    }else {
    	$errores[2] = 'El archivo no se guardó de forma correcta: vuelva a intentarlo.';
    }
    if (isset($_POST['no_mas_fotos'])) {
        $a = 'stop';
        $datos_fotos = rtrim($datos_fotos, ', ');
        $datos_fotos = "{". $datos_fotos ."}";
        var_dump($datos_fotos);//---------------------------------------------VD
    } else {
        $a = '';
    }
} while ($a != 'stop');
$tabla = 'fotos';
$campos = ['urls_texto_fotos'];
$valores = [$datos_fotos];
//insertamos el registro de las fotos en la base de datos
DB::insertar_registro($dbh, $tabla, $campos, $valores);
//recuperamos el id de las fotos recien registradas
$id_fotos = DB::last_insert_id($tabla);
//DIEZ----------------------------------------------------------------------DIEZ
//El anuncio tiene una colección de vídeos
//subimos los archivos de vídeo mientras que el usuario quiera para crear una
//colección, que será un objeto JSON con las urls y textos de cada vídeo.
$datos_videos = '';
do {
    if (isset($_POST['acc']) && $_FILES['archivo']['error'] == 0)
    {
        //crea la carpeta para que el anunciante guarde sus fotos
        $carp = (isset($id_particular))?:$id_profesional;
        $dir_videos = "user-videos\\" . $carp;
        //añadimos el nombre del archivo
        $url = $dir_videos."\\".$_FILES['archivo']['name'];
        mkdir($dir_videos, 0777, true);
    	//sube el archivo de la nueva foto al directorio de fotos del anunciante
    	move_uploaded_file($_FILES['archivo']['tmp_name'], $url);
        #var_dump($_FILES['archivo']);
        //texto que acompaña a la imagen
        if (isset($_POST['texto_video']) && $_POST['texto_video'] != '') {
            $texto = $_POST['texto_video'];
        } else {
            $texto = '';
        }
        //creamos un valor que convertiremos a un objeto JSON mediante la función
        //CAST(value AS JSON) de MySQL ¿?

        $datos_videos . =  $url ."\": \"". $texto ."\", ";
    }else {
    	$error[] = 'El archivo no se guardó de forma correcta: vuelva a intentarlo.';
    }
    if (isset($_POST['no_mas_videos'])) {
        $a = 'stop';
        $datos_videos = rtrim($datos_videos, ', ');
        $datos_videos = "{". $datos_videos ."}";
        var_dump($datos_videos);//---------------------------------------VD_JSON
    } else {
        $a = '';
    }
} while ($a != 'stop');
$tabla = 'videos';
$campos = ['urls_texto_videos'];
$valores = [$datos_videos];
//insertamos el registro de los vídeos en la base de datos
DB::insertar_registro($dbh, $tabla, $campos, $valores);
//recuperamos el id de los vídeos recien registrados
$id_videos = DB::last_insert_id($tabla);
//----------------------------------------------------------------INSERT ANUNCIO
$tabla = 'anuncios';
$campos = ['fecha_anuncio',
            'estado',
            'id_operacion',
            'id_inmueble',
            'descripcion',
            'id_profesional',
            'id_particular',
            'id_contrato',
            'id_gestor',
            'id_fotos',
            'id_videos'
        ];
//definimos los valores pendientes
$fecha_anuncio = new DateTime('now', 'Europe/London');
$
$valores = []
//--------------------------------------------------------------------------HTML

//1. fecha_anuncio
//2. estado('pendiente', 'aprobado')
//3. id_operacion
//4. id_inmueble
//5. descripcion
//6. id_profesional
//6. id_particular
//7. id_contrato
//8. id_gestor
//9. id_fotos
//10. id_videos
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>subir-informe-gestor</title>
    </head>
    <body>
        <h3>Defina los datos para el Anuncio:</h3>
        <!-- operación -->
        <fieldset>
            <legend>Que operación desea realizar?</legend>
            <form id="" cla method="post"
                  action="anunciante-crear-anuncio.php"
                 enctype="multipart/form-data"> <!--???????-->

                <!-- Enviamos la confirmación de haber recibido el archivo -->
                <input type="hidden"
                       name="acc"
                      value="envio">
                <div class="">
                    <label for="texto">
                        Escribe un texto para la foto-video:
                    </label>
                </div>
                <input type="text"
                       name="texto"
                      value=""
                placeholder="texto foto-video"
                   required >
                <br><br>
                <div class="">
                    <label for="destinatario_informe">
                        Escribe el nombre del destinatario del informe:
                    </label>
                </div>
                <input type="file"
                       name="archivo"
                   required >
                <br><br>
                <button type="submit">Enviar</button>
                <div class="error">
                    <?php echo $error[0]; ?>
                </div>
            </form>
        </fieldset>

    </body>
</html>
