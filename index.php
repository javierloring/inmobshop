<?php

require 'vendor/autoload.php';
echo $_SERVER['PHP_SELF'];
$passgestor1 = password_hash('passgestor1', PASSWORD_DEFAULT);
$passgestor2 = password_hash('passgestor2', PASSWORD_DEFAULT);
$passusu1 = password_hash('passusu1', PASSWORD_DEFAULT);
$passusu2 = password_hash('passusu2', PASSWORD_DEFAULT);
$passusu3 = password_hash('passusu3', PASSWORD_DEFAULT);
$passusu4 = password_hash('passusu4', PASSWORD_DEFAULT);
$passusu5 = password_hash('passusu5', PASSWORD_DEFAULT);
$passusu6 = password_hash('passusu6', PASSWORD_DEFAULT);
var_dump($passusu1,$passusu2, $passusu3, $passusu4, $passusu5, $passusu6);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>casashop</title>
        <link rel="stylesheet" href="css/ui.css">
    </head>
    <body>
        <h1>Comenzando la aplicación</h1>
        <form class = "inicio_sesion"
               name = 'inicio_sesion'
             action = "negocio\iniciar-sesion.php"
             method = "post"
        >
            <p><b>Indique un tipo de usuario para iniciar sesión:</b></p>
            <select class="tipo_usuario" name="tipo_usuario">
                <option value="" required></option>
                <option value="particular">soy anunciante particular</option>
                <option value="profesional">soy profesional inmobiliario</option>
                <option value="demandante">busco ofertas inmobiliarias</option>
                <option value="--"></option>
            </select>
        </form>
        <script src="js\inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                $('select').on('change', enviar_usuario);
            });
        </script>
    </body>
</html>
