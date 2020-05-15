<?php
//utilizamos recursos de la aplicación
require '../vendor/autoload.php';
//la configuración general
require '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
require_once '../datos/Demandante.php';
//la capa de negocio
require '../negocio/funciones-registro.php';
var_dump($_GET);
if(isset($_GET['id_usuario']) && isset($_GET['val'])){
    $id_usuario = $_GET['id_usuario'];
    $token = $_GET['val'];
    $mensaje = validaIdToken($id_usuario, $token);

    //obtenemos el tipo de usuario para dirigirlo a su área de gestión
    if(Demandante::esDemandante($id_usuario)){
        $area_gestion = '..\presentacion\ag-demandante-b&f.php';
    } elseif(Particular::esParticular($id_usuario)){
        $area_gestion = '..\presentacion\ag-particular-contratos.php';
    } elseif (Profesional::esProfesional($id_usuario)) {
        $area_gestion = '..\presentacion\ag-profesional-contratos.php';
    }
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
                    <a href="<?= $area_gestion ?>" class="w3-button w3-indigo">
                        Iniciar sesión
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>
