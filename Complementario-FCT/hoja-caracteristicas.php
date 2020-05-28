<?php
require_once '../config.php';

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Inmobshop-características</title>
        <link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
        <script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
        <script src="..\js\w3.js"></script>
    </head>
    <body id="caracteristicas">
        <div id="cabecera" class="w3-row w3-container w3-margin w3-center">
            <div class="w3-col l3 m12 s12">
                <h2>
                    <a href="..\index.php">
                        <img src="..\media\logo\inmobshop_5_orange.png" alt="">
                    </a>
                </h2>
            </div>
            <div class="w3-col l6 m12 s12 w3-card w3-text-inmobshop">
                <div class="w3-row w3-container">
                    <div id="logo_complementario"
                    class="w3-container w3-col l4 m12 s12 w3-inmobshop w3-text-inmobshop w3-border"
                    style="padding: 40px 0;margin-top: 40px;">
                        <img class = "" style = "height: 100%; padding-bottom: 250px;"
                               src = "<?= LOGO_INMOBSHOP ?>"/>
                    </div>
                    <div class="w3-container w3-col l8 m12 s12 w3-text-inmobshop">
                        <div>
                            <div>
                                <span><h1><b>INMOBSHOP</b></h1></span>
                                <span>
                                    <h3>
                                        UN PORTAL INMOBILIARIO DEL SIGLO XXI: CHALETS, PISOS, TERRENOS Y MÁS …
                                    </h3>
                                </span>
                                <h6 class="w3-text-brown" style="padding: 5px 0;">
                                    <b>
                                        j. loring moreno – Proyecto DAW - IES Aguadulce
                                    </b>
                                </h6>
                                <b>
                                </b>
                                <h6 style="padding: 5px 0;">
                                    ….SI QUIERES DAR A CONOCER TUS PRODUCTOS
                                    INMOBILIARIOS DE UNA FORMA DIRECTA Y CLARA,
                                    EN UN AMBIENTE QUE TRANSMITA SERIEDAD Y
                                    DISFRUTANDO DE UN ENTORNO ACCESIBLE Y AMIGABLE….
                                </h6>
                                <h6 style="padding: 5px 0;">
                                    ….QUIERES CONTACTAR CON PERSONAS INTERESADAS
                                     EN LA COMPRA DE INMUEBLES SIMILARES AL TUYO.…
                                </h6>
                                <h6 style="padding: 5px 0;">
                                    ….SI ESTÁS BUSCANDO TU VIVIENDA IDEAL…
                                </h6>
                                <h6 style="padding: 10px 0;">
                                    ….O PASAR UNAS VACACIONES EN LA PLAYA DE TUS SUEÑOS…
                                </h6>
                            </div>
                            <div>
                                <p>Visita nuestro portal web en <a href="http://www.inmobshop.com
                                    ">www.inmobshop.com</a>	<b>CONÓCENOS</b></p>
                                <p>O nuestra aplicaión en local <a href="../index.php
                                    ">www.inmobshop.com</a>	<b>CONÓCENOS</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w3-col l3 m12 s12">
                <p></p>
            </div>
        </div>
        <div id="descripcion" class="w3-row w3-container w3-margin">
            <div class="w3-col l3 m12 s12">
                <p></p>
            </div>
            <div class="w3-col l6 m12 s12 w3-card  w3-padding w3-text-inmobshop">
                <div class="">
                    <h3>
                        <b>
                            INMOBSHOP ES EL PORTAL PARA CONSEGUIRLO !!!
                        </b>
                    </h3>
                </div>
                <div class="">
                    <p>
                        Desde Inmobshop queremos ofrecer una aplicación con la
                        que te encuentres a gusto a la hora de buscar la vivienda
                        que mejor se adapte a tus necesidades, bien se trate de
                        venta o alquiler, o de pasar tus vacaciones en la playa
                        o en la montaña.
                    </p>
                    <p>
                        Pero si lo que deseas es buscar un local o una oficina en
                         una ubicación que consideres adecuada para montar tu
                         negocio, o bien encontrar esa plaza de garaje o trastero,
                          junto a tu trabajo, Inmobshop también te ofrece una
                          oportunidad inmejorable.
                    </p>
                </div>
                <div class="">
                    <h5 onclick="mostrar('mas')" class="w3-text-brown" style="padding: 10px 0;">
                        <b>
                            Mostrar más información...
                        </b>
                    </h5>
                </div>
                <div id="mas" class="w3-hide w3-container">
                    <p>
                        Podrás realizar búsquedas en las que contemples la zona
                        de tu interés y, si tienes más de una zona en tu cabeza,
                        podrás guardar las que te interesen para consultarlas más
                        adelante.
                    </p>
                    <p>
                        Si no  te has decidido por una oferta pero hay algunas
                        que te parecen igual de interesantes, puedes seleccionarlas
                         como favoritas para compararlas en otro momento con más
                         detenimiento.
                    </p>
                    <p>
                        Si en tu caso no deseas buscar, si no anunciar tu inmueble,
                        tenemos diferentes servicios que pueden adaptarse de una
                        forma óptima a tus necesidades. Además dispondrás de
                        informes que pueden orientarte sobre los precios más
                        adecuados del mercado.
                    </p>
                    <p>
                        Si eres un profesional inmobiliario te ofrecemos una
                        posición desde la que poder operar con tus productos de
                        la mejor manera y que tus ofertas llegen a una enorme
                        cantidad de clientes potenciales.
                    </p>
                    <p>
                        Nuestra plantilla de gestores realiza un trabajo
                        personalizado con un estricto registro de las operaciones
                        para poder informarte en todo momento de tus movimientos.
                    </p>
                    <p>
                        Dispondrás de un área de gestión específica desde donde
                        crear tus anuncios, y adjuntarlos a los contratos que
                        consideres más adecuados; dispondrás de una amplia gama
                        de servicios para profesionales y de informes actualizados
                        de los inmuebles de tu interés; un apartado específico
                        para organizar y comunicarte con los contactos que tengan
                        tus anuncios y una sección para mantener actualizado tu
                        perfíl.
                    </p>
                </div>
            </div>
            <div class="w3-col l3 m12 s12">
                <p></p>
            </div>
        </div>
        <script>
            function mostrar(id) {
              var x = document.getElementById(id);
              if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
              } else {
                x.className = x.className.replace(" w3-show", "");
              }
            }
        </script>
    </body>
</html>
