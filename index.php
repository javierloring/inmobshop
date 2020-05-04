<?php

require 'vendor/autoload.php';
echo $_SERVER['PHP_SELF'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>casashop</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body class="w3-center">
        <h1>Comenzando la aplicación</h1>
        <form class = ""
               name = 'inicio_sesion'
             action = "negocio\iniciar-sesion.php"
             method = "post"
        >
            <label>Indique un tipo de usuario para iniciar sesión:</label>
            <select class="tipo_usuario" name="tipo_usuario">
                <option value="" required></option>
                <option value="particular">soy anunciante particular</option>
                <option value="profesional">soy profesional inmobiliario</option>
                <option value="demandante">busco ofertas inmobiliarias</option>
                <option value="--"></option>
                <option value="registros\logger-gestores.php">quiero probar el registro</option>
            </select>
        </form>
        <a href='negocio\informes-gestores\gest-id2\est-alquileres.php'>
            acceda al informe de prueba: productos de la tienda
        </a>
        <script src="js\is-inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                $('select').on('change', enviar_usuario);
            });
        </script>
    </body>
</html>
