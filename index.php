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
            <div class = "w3-row w3-panel w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <a  href="#">
                        <img class = "w3-button w3-hover-inmobshop"
                             style = "height: 100%; padding-bottom: 10px;"
                               src = "media\logo\inmobshop_2_orange.png"/>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "negocio\buscar-ofertas.php">
                        <p style="padding-top: 20px;">
                            Buscar ofertas
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "negocio\crear-anuncio.php">
                        <p style="padding-top: 20px;">
                            Crea tu anuncio
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "negocio\registro.php">
                        <p style="padding-top: 20px;">
                            Regístrate
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "negocio\iniciar-sesion.php">
                        <p style="padding-top: 20px;">
                            Inicia sesión
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <p></p>
                </div>
            </div>
        </header>
        <main>
            <div id="breadcrumbs" class="w3-row w3-panel">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div class="w3-col l8 m12 s12">
                    <ul class="breadcrumb w3-ul">
                      <!-- <li><a href="#">Home</a></li>
                      <li><a href="#">Home</a></li>
                      <li><a href="#">Home</a></li>
                      <li><a href="#">Home</a></li> -->
                      <li>Home</li>
                    </ul>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div id="anuncio_nivel5" class="w3-row w3-panel">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-display-container">
                    <div id="portada" class="">
                        <img src = "datos\user-fotografias\Temas-imagenes\interiores\interior_15.webp"
                            width = "100%"
                             alt = "">
                        <!-- <img src="datos\user-fotografias\<?php echo $_url_portada ?>" alt=""> -->
                    </div>
                    <div id ="enlace" class="w3-display-topright w3-container">
                        <p style="bacKground-color: #eee; padding:  5px 40px; color: #000066;">
                            <a href="negocio\anuncio-especifico.php">Lujoso chalet en Zahara de los Atunes, 2.500.000 €</a>
                            <!-- <a href="negocio\anuncio-específico.php?id_anuncio=<?php echo $_id_anuncio ?>"></a> -->
                        </p>

                    </div>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div class="w3-row w3-container">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div class ="w3-col l8 m12 s12 w3-container w3-center">
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
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div class="w3-row">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div class="w3-col l8 m12 s12">
                    <p></p>
                </div>
                <div class="w3-col l2 m12 s12">
                    <a class = "w3-text-inmobshop w3-large w3-button w3-hover-none w3-hover-text-amber"
                        href = "#"
                    >
                        <b>Volver</b>
                    </a>
                </div>
            </div>
        </main>
        <footer>
            <div class = "w3-row  w3-panel w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-inmobshop" style="height: 80px;">
                    <p class = "w3-text-amber w3-small"
                       style = "text-align: center;padding-top: 20px;">
                        2020
                    </p>
                </div>
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                </div>
            </div>
        </footer>
        <script src="js\is-inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                var portada = document.getElementById('portada');
                coloccar_portada(portada);
                $('select').on('change', enviar_usuario);
            });
        </script>
    </body>
</html>
