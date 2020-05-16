<?php
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
require_once '../datos/Demandante.php';
//la capa de negocio
require_once '../negocio/funciones-registro.php';
#var_dump($_GET);

//si no recibimos un id de usuario, y un token reenviamos al home
if(empty($_GET['id_usuario'])){
    header('Location: ..\index.php');
}
if(empty($_GET['token'])){
    header('Location: ..\index.php');
	
//recuperamos los datos devueltos por el usuario
if(isset($_GET['id_usuario']) && isset($_GET['val'])){
    $usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_STRING);
    $token = filter_input(INPUT_GET, 'val', FILTER_SANITIZE_STRING);
	//validamos la corrección del token
    $mensaje = validaIdToken($id_usuario, $token);
	//definimos la variable para el área de grstión;
	$area_gestion = '';

    //obtenemos el tipo de usuario para dirigirlo a su área de gestión
    var_dump(Demandante::esDemandante($id_usuario));
    var_dump(Particular::esParticular($id_usuario));
    var_dump(Profesional::esProfesional($id_usuario));
	#die();
    if(Demandante::esDemandante($id_usuario)){
        $area_gestion = '..\presentacion\ag-demandante-b&f.php';
    }
	else if(Particular::esParticular($id_usuario)){
		var_dump('que pasa?');
        $area_gestion = '..\presentacion\ag-particular-contratos.php';
    }
	else if(Profesional::esProfesional($id_usuario)) {
        $area_gestion = '..\presentacion\ag-profesional-contratos.php';
    }
	var_dump($area_gestion);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Activación</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
		<script src="..\js\index.js" charset="utf-8"></script>
		<script src="..\js\registro.js"></script>
        <script src="..\js\w3.js"></script>

    </head>
    <body>
        <div class="w3-container w3-ligth-blue">
            <div class="w3-panel w3-blue">
                <h3><?php echo $mensaje ?></h3>
            </div>
            <div class="w3-button">
                <p>
                    <a href="<?php echo $area_gestion?>" class="w3-button w3-indigo">
                        Iniciar sesión
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>
