<?php

require 'vendor/autoload.php';
echo $_SERVER['PHP_SELF'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Home-inmobshop</title>
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="css\w3.css">
        <link rel="stylesheet" href="css\inmobshop.css">
        <script src="js\w3.js"></script>
    </head>
    <body>
        <header>
            <div class = "w3-panel w3-bar w3-inmobshop"
                 style = "height:80px; position: fixed; top: 0; left: 0;">
                <a class="w3-bar-item w3-button w3-hover-none" style="width:16.6%;" href="#">
                    <img class = "w3-bar-item w3-button w3-hover-inmobshop"
                         style = "height:100%; padding-bottom: 10px;"
                           src = "media\logo\inmobshop_2_orange.png" />
                </a>
                <div class="">
                    <a class = "w3-bar-item w3-button w3-hover-none w3-text-amber w3-hover-text-white w3-large"
                       style = "width:16.6%;"
                        href = "negocio\buscar-ofertas.php">
                        <p style="padding-top: 20px;">
                            Buscar la mejor oferta
                        </p>
                    </a>
                    <a class = "w3-bar-item w3-button w3-hover-none w3-text-amber w3-hover-text-white w3-large"
                       style = "width:16.6%;"
                        href = "negicio\crear-anuncios.php">
                        <p style="padding-top: 20px;">
                            Crea tu anuncio
                        </p>
                    </a>
                    <a class = "w3-bar-item w3-button w3-hover-none w3-text-amber w3-hover-text-white w3-large"
                       style = "width:16.6%;"
                        href = "negocio\registro.php">
                        <p style="padding-top: 20px;">
                            Regístrate
                        </p>
                    </a>
                    <a class = "w3-bar-item w3-button w3-hover-none w3-text-amber w3-hover-text-white w3-large"
                       style = "width:16.6%;"
                        href = "negocio\iniciar-sesion.php">
                        <p style="padding-top: 20px;">
                            Inicia sesión
                        </p>
                    </a>
                </div>
            </div>
        </header>
        <main class="w3-container">
            <div class ="w3-container" style="position: fixed; top: 80; left: 0;" >
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
                <a class = "w3-text-inmobshop w3-large w3-button w3-hover-none w3-hover-text-amber"
                   style = "position: fixed; bottom: 100; left: 83.3%;"
                    href = "#">
                    <b>Volver</b>
                </a>
            </div>
        </main>
        <footer>
            <div class = "w3-panel w3-bar w3-inmobshop"
                 style = "height:80px; position: fixed; bottom: 0; left: 0;">
                <div class="w3-bar-item" style="width:16.6%;">
                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
                </div>
                <div class="w3-bar-item" style="width:66.6%;">
                    <p class = "w3-text-amber w3-small"
                       style = "text-align: center;padding-top: 20px;">
                        2020
                    </p>
                </div>
            </div>
        </footer>
        <script src="js\is-inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                $('select').on('change', enviar_usuario);
            });
        </script>
    </body>
</html>
