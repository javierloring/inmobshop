<?php

require 'vendor/autoload.php';
echo $_SERVER['PHP_SELF'];

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
                <option value="registros\logger-gestores.php">quiero probar el registro</option>
            </select>
        </form>
        <script src="js\is-inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                $('select').on('change', enviar_usuario);
            });
        </script>
    </body>
</html>
