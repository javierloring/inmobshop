<?php
//iniciamos sesión
session_start();
$nombre = 'gestor-jlm';//obtener de $_SESSION
//accedemos a la base de datos
require ('..\datos\BD.php');
$dbh = BD::conectar();
//incorporamos el registrador de gestores
require ('..\registros\logger-gestores.php');
//declaramos la variable error para poder definir su contenido en caso de fallo
$error = [];
//subimos el archivo de informe del gestor
if (isset($_POST['acc']) && $_FILES['archivo']['error'] == 0)
{
    //crea el directorio para que el gestor guarde sus informes
    $dir_informes = "informes-gestores\\".$nombre;
    //añadimos el nombre del archivo
    $url = $dir_informes."\\".$_FILES['archivo']['name'];
    mkdir($dir_informes, 0777, true);
	//sube el archivo del nuevo informe al directorio de informes del gestor
	move_uploaded_file($_FILES['archivo']['tmp_name'], $url);
    #var_dump($_FILES['archivo']);

    //para dar de alta el informe en la base de datos usamos el método
    //DB::insertar_registro($dbh, $tabla, $campos, $valores)
    $tabla = 'informes';
    $campos = ['nombre_informe',
                'fecha_informe',
                'url_informe',
                'destinatario_informe',
                'activado',
                'id_gestor'];
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
            <legend>Subir informe a supervisión</legend>
            <form method="post"
                  action="gestor-subir-informe.php"
                 enctype="multipart/form-data">

                <!-- Enviamos la confirmación de haber recibido el archivo -->
                <input type="hidden"
                       name="acc"
                      value="envio">
                <div class="">
                    <label for="nombre_informe">
                        Escribe el nombre del informe:
                    </label>
                </div>
                <input type="text"
                       name="nombre_informe"
                      value=""
                placeholder="nombre del informe"
                   required >
                <br><br>
                <div class="">
                    <label for="destinatario_informe">
                        Escribe el nombre del destinatario del informe:
                    </label>
                </div>
                <input type="text"
                       name="destinatario_informe"
                      value=""
                placeholder="público...particular...profesional"
                   required >
                <br><br>
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
