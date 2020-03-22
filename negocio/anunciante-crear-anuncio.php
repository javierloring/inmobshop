<?php
//id_anuncio
//1. fecha_anuncio
//2. estado('pendiente', 'aprobado')
//3. id_operacion
//4. id_inmueble
//5. descripcion
//6. id_profesional
//7. id_particular
//8. id_contrato
id_gestor
id_fotos
id_videos
//iniciamos sesión
session_start();
$nombre = 'anunciante-tipo-#x->nombre';//obtener de $_SESSION
//accedemos a la base de datos
require ('..\datos\BD.php');
$dbh = BD::conectar();

//El anuncio se crea añadiendole las instancias de las entidades que lo componen:
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
$id_operacion = DB::last_insert_id($tabla);
//CUATRO------------------------------------------------------------------CUATRO
//El anuncio tiene un inmueble: lo creamos y obtenemos su id

//CINCO--------------------------------------------------------------------CINCO
if (isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
}else {

}
//SEIS----------------------------------------------------------------------SEIS
if (isset($_POST['usuario']['id'])) {
    $id_usuario = $_POST['usuario']['id'];
    if (DB::es_profesional($id_usuario)) {
        $id_profesional = BD::get_id_profesional($id_usuario);//crear/ver metodo
    } else {
        $id_particular = BD::get_id_particular($id_usuario);//crear/ver metodo
    }
} else {
    // code...
}

//El anuncio tiene una descripción
//El anuncio
//OCHO----------------------------------------------------------------------OCHO
//El anuncio se crea para un contrato vigente del que tenemos su id
if (isset($_POST['contrato']['id'])) {
    $id_contrato = $_POST['contrato']['id'];
}else {
    // code...
}
//NUEVE--------------------------------------------------------------------NUEVE
//El anuncio tiene una colección de fotos
//El anuncio tiene una colección de vídeos
//subimos los archivos de imagen o vídeo mientras que el usuario quiera pra Crear
//una colección
do {
    // code...
} while ($a <= 10);
if (isset($_POST['acc']) && $_FILES['archivo']['error'] == 0)
{
    //crea el directorio para que el anunciante guarde sus fotos-videos
    $dir_fotos = "user-fotografias\\".$nombre;
    //añadimos el nombre del archivo
    $url = $dir_informes."\\".$_FILES['archivo']['name'];
    mkdir($dir_informes, 0777, true);
	//sube el archivo del nuevo informe al directorio de informes del gestor
	move_uploaded_file($_FILES['archivo']['tmp_name'], $url);
    #var_dump($_FILES['archivo']);
//------------------------------------------------------------------------OJO!!!

    //DB::insertar_registro($dbh, $tabla, $campos, $valores)
    $tabla = 'fotos';
    $campos = ['numero_foto',
                'texto',
                'url_foto',
                'id_anuncio'];
    $nombre_informe = $_POST['nombre_informe'];
    $fecha_informe = date('y/m/d');
    //el informe se va a consultar desde la capa de presentación
    $url_informe = "..\\negocio\\".$url;
    $destinatario_informe = $_POST['destinatario_informe'];
    $activado = 0;
    //obtenemos el id del gestor------------------------------------------------
    $nombre_gestor = $nombre;//$_SESSION['nombre']
    $sql = "SELECT id_gestor FROM gestores
           WHERE nombre_gestor = '${nombre_gestor}'";
    $resultado = $dbh->query($sql);//objeto PDOStatement
    $registro = $resultado->fetch();
    $gestor_id = $registro['nombre_gestor'];
    //--------------------------------------------------------------------------
    $valores = [$nombre_informe,
                $fecha_informe,
                $url_informe,
                $destinatario_informe,
                $activado,
                $gestor_id
            ];
//------------------------------------------------------------------------OJO!!!
    DB::insertar_registro($dbh, $tabla, $campos, $valores);
    //registramos la operación
    #$registrar = "$nombre_gestor. Subido informe: $nombre_informe.";
    $registrar = "El gestor fulano ha subido el informe zutano.";
    $logger->info($registrar);
}else {
	$error[] = 'El archivo no se guardó de forma correcta: vuelva a intentarlo.';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>subir-informe-gestor</title>
    </head>
    <body>
        <h3>Informes pendientes de supervisión:</h3>
        <?php
        //listado de informes pendientes de supervisión
        // foreach ($informes as $key => $value) {
        //     // code...
        // }
        ?>
        <fieldset>
            <legend>Subir imagen-video a anuncio</legend>
            <form method="post"
                  action="anunciante-subir-imagen-video.php"
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
