<?php
//iniciamos sesión
session_start();
$nombre = 'gestor-jlm';//obtener de $_SESSION
//accedemos a la base de datos

include_once('..\datos\BD.php');
#die();
$dbh = BD::conectar();
//Acceso a comprobar anuncio
//Acceso a crear seervicio
//Acceso a subir informe
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <ul>
            <li>
                <a href="..\negocio\gestor-comprobar-anuncio.php">
                    Comprobar anuncio
                </a>
            </li>
            <li>
                <a href="..\negocio\gestor-crear-servicio.php">
                    Crear servicio
                </a>
            </li>
            <li>
                <a href="..\negocio\gestor-subir-informe.php">
                    Subir informe
                </a>
            </li>
        </ul>
    </body>
</html>
