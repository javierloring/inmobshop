<?php
//Recibe los datos del espacio de arrastre (dropzone) como un objeto FormData
//que contiene las entradas del formulario fotos, con los nombres de archivo y
//los comentarios realizados por el usuario.
require_once '../datos/Anuncio.php';
require_once '../datos/Fotos.php';
$error = '';
$exito = '';
//comprobamos que se recibe el campo oculto con el id de usuario y que no está vacío
//entonces tampoco está vacío el campo tipo de usuario
if(!empty($_POST)){//campo oculto en form(fotos)
    $id_usuario = $_POST['id_us_fotos'];
    $tipo_usuario = $_POST['tipo_usuario'];
    //si recibimos algún contenido registramos las fotos en la base de datos
    //tenemos que conocer el número de anuncios que ya tiene el usuario para añadir
    //una carpeta con número consecutivo
    $peticion = Anuncio::obtenNumeroAnunciosId($id_usuario, $tipo_usuario);
    //tenemos que obtener fotos del directorio mis-fotos y volcarlas en
    //datos/user-fotografias/substring$tipo_usuario(4)/fotos(anuncio actual),
    //tambien recupeeramos el $id_tipo_usuario
    $num_anuncios = $peticion[0];
    $anuncio_actual = $num_anuncios + 1;
    $id_tipo_usuario = $peticion[1];
    //definimos la carpeta general del usuario
    $tipo_carpeta = substr($tipo_usuario, 0, 4);//el 4 es la longitud de part o prof
    $carpeta_usuario = $tipo_carpeta . '-id-' . $id_tipo_usuario;
    //definimos la subcarpeta para las fotos del anuncio actual
    $carpeta_anuncio = 'fotos-' . $anuncio_actual;
    $ruta = '../datos/user-fotografias/' . $carpeta_usuario . '/' . $carpeta_anuncio;
    //creamos el directorio para guardar los archivos
    if(mkdir($ruta)){
        //movemos cada archivo de la carpeta mis-fotos al nuevo directorio y lo
        //renombramos como fot(cont)).jpg
        $archivos_descargados = scandir('mis-fotos', SCANDIR_SORT_NONE);
        #var_dump($archivos_descargados, 'descargados');
        //guardamos los archivos en la carpeta del usuario y los renumeramos
        $origen = 'mis-fotos/';
        for ($i=2; $i < count($archivos_descargados); $i++) {
            rename($origen.$archivos_descargados[$i], $ruta . '/foto' . ($i-1) . '.jpg');
        }
        $archivos_movidos = scandir($ruta, SCANDIR_SORT_NONE);
        #var_dump($ruta, $archivos_movidos, 'movidos');
        //Ahora vamos a guardar el registro de las urls de archivos y los comentarios en la base de datos
        //creamos una cadena ordenada con la secuencia de ruta de archivo y comentarios
        //que luego podremos analizar para recuperar los datos almacemados en el
        //árbol de fotos de usuarios de la aplicación
        if(isset($_POST['archivos']) && isset($_POST['comentarios'])){
            #var_dump($_POST['archivos'], $_POST['comentarios']);
            $json = '';
            $url = '';
            $texto = '';
            $cont = 1;
            $ruta = substr($ruta, 3);
            foreach ($_POST['archivos'] as $key => $value) {
                $url = $ruta . '/f' . $cont . '.jpg';
                $texto = $_POST['comentarios'][$key];
                $json .= ("\"" . $url ."\":\"". $texto ."\", ");
                $cont ++;
            }
            #var_dump($json);
            $registro = Fotos::insertaFotos($json);//devuelve el lastinsertid
            //debemos recuperar el id del registro creado para añadirlo al anuncio
            //como id_fotos. devolvemos el registro creado
            echo $registro;
        }else {
            $mensaje = 'No se recibieron los archivos y comentarios';
            echo $mensaje;
        }
    }
}else{
    $mensaje = 'El usuario no tiene privilegios de anunciante.';
    echo $mensaje;
}
