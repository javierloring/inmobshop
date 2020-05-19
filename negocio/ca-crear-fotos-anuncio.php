<?php
//Recibe los datos del espacio de arrastre (dropzone) como un objeto FormData
//para crear el objeto string tipo 'JSON' a guardar en la base de datos
//los datos del FormData se recogen en el array $_POST que tiene los elementos
//id del usuario y tipo de usuario (campos ocultos)
//archivos, con los nombres de archivo y los elementos comentarios, con los
//comentarios realizados por el usuario.
require_once '../datos/Anuncio.php'
require_once '../datos/Foto.php';

$error = '';
$exito = '';
//comprobamos que se recibe el campo oculto con el id de usuario y que no está vacío
if(!empty($_POST['id_fotos'])){
    $id_usuario = $_POST['id_fotos'];
    $tipo_usuario = $_POST['tipo_usuario'];
    //registramos las fotos en la base de datos si recibimos algún contenido
    //tenemos que conocer el número de anuncios que ya tiene el usuario para añadir
    //una carpeta con número consecutivo
    $peticion = Anuncios::obtenNumeroAnunciosId($id_usuario, $tipo_usuario);
    //tenemos que obtener los anuncios del directorio mis-fotos y volcarlas en
    //datos/user-fotografias/substring$tipo_usuario(4)/fotos(anuncio actual)
    $num_anuncios = $peticion[0];
    $anuncio_actual = $num_anuncios + 1;
    $id_tipo_usuario = $peticion[1];
    $tipo_carpeta = substr($tipo_usuario, 0, 4);
    $carpeta_usuario = $tipo_carpeta . '-id' . $id_tipo_usuario;
    $carpeta_anuncio = 'fotos-' . $anuncio_actual;
    $ruta = '..\datos\user-fotografias\\' . $carpeta_usuario . '\\' . $carpeta_anuncio;
    //creamos el directorio para guardar los archivos
    if(mkdir($ruta)){
        //movemos cada archivo de la carpeta mis-fotos al nuevo directorio y lo
        //renombramos como foti.jpg
        $archivos_descargados = scandir('..\negocio\mis-fotos', SCANDIR_SORT_NONE);
        $cont = 1;
        foreach ($archivos_descargados as $archivo) {
            move_uploaded_file($file, $ruta . '\f' . $cont . '.jpg');
            $cont ++;
        }
    }
    if(isset($_POST['archivos']) && isset($_POST['comentarios'])){
        #var_dump($_POST['archivos'], $_POST['comentarios']);
        $json = '';
        $url = '';
        $texto = '';
        $cont = 1;
        foreach ($_POST['archivos'] as $key => $value) {
            $url = $ruta . '\f' . $cont . '.jpg';
            $texto = $_POST['comentarios'][$key];
            $registro .= ("\"". $url ."\": \"". $texto ."\", ");
            $cont ++;
        }
        #var_dump($json);
        $dbh = BD::conectar();
        $tabla = 'fotos';
        $campos = ['urls_textos_fotos'];
        $valores = [$json];
        BD::insertar_registro($dbh, $tabla, $campos, $valores);



        $mensaje['exito'] = 'exito';
        echo json_encode($mensaje);

    }else {
        $error = 'No se recibieron los archivos y comentarios';
        $mensaje['error'] = $error;
        echo json_encode($mensaje);
    }
}else{
    $error = 'El usuario no tiene privilegios de anunciante.';
    $mensaje['error'] = $error;
    echo json_encode($mensaje);
}


#var_dump($json);
#header('Location: index.php');
