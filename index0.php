<?php

    require 'vendor/autoload.php';
    require 'config.php';
    #echo $_SERVER['PHP_SELF'];
    $url = $_SERVER['PHP_SELF'];
    $nombre = 'Home';
    #var_dump($url, $nombre);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Home-inmobshop</title>
        <link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="css\w3.css">
        <link rel="stylesheet" href="css\inmobshop.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="js\w3.js"></script>
    </head>
    <body class="w3-row">
        <header class="w3-container w3-inmobshop"
		style="position: sticky; position: -webkit-sticky; top: 0;z-index: 1;">
            <div class = "w3-row w3-container ">
                <div class="w3-col l2 m12 s12" style="height: 80px;">
                    <a  href="#">
                        <img class = "w3-button w3-hover-inmobshop"
                             style = "height: 100%; padding-bottom: 10px;"
                               src = "<?= LOGO_INMOBSHOP ?>"/>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "<?= BUSCAR_OFERTAS ?>">
                        <p style="padding-top: 20px;">
                            Buscar ofertas
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "<?= CREA_TU_ANUNCIO ?>">
                        <p style="padding-top: 20px;">
                            Crea tu anuncio
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "<?= REGISTRATE ?>">
                        <p style="padding-top: 20px;">
                            Regístrate
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m6 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "<?= INICIA_SESION ?>">
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
        <main class="w3-container">
            <div id="breadcrumbs" class="w3-row w3-panel">
                <div class="w3-col l2 m12 s12">
					<p></p>
                    <p class="oculto"><?= $nombre ?></p>
                </div>
                <div class="w3-col l8 m12 s12">
                    <ul class="breadcrumb w3-ul">
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
                    <div id="portada" class="w3-center">
                    </div>
                    <div id ="enlace" class="w3-display-topright w3-container">
                        <p style="background-color: #eee; padding:  5px 40px; color: #000066;">

                        </p>
                    </div>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div id="heredado" class="w3-row w3-container">
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
					<div id=" lorem_ipsum"class="">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
						</p>
					</div>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div class="w3-row w3-bootom" style="position:relative;bottom: 0;">
				<div class="w3-col l2 m12 s12">
					<p></p>
				</div>
				<div class="w3-col l8 m12 s12">
					<p></p>
				</div>
				<div id="subir" class="w3-col l2 m12 s12" style = "font-size: 30px;">
					<a class = "w3-text-inmobshop w3-large w3-hover-text-blue"
						href = "#"
					>
					<span><i class="material-icons inmobshop"
						>arrow_upward</i><b class="">Subir</b>
					</span>
					</a>
				</div>
			</div>
        </main>
        <footer class="w3-container w3-inmobshop">
            <div class = " w3-row  w3-panel w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 60px;">
                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-inmobshop" style="height: 60px;">
                    <p class = "w3-text-amber w3-small"
                       style = "text-align: center;padding-top: 20px;">
                        2020
                    </p>
                </div>
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 60px;">
                </div>
            </div>
        </footer>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script src="js\index.js" charset="utf-8"></script>
        <script src="js\inicio-sesion.js" charset="utf-8"></script>
        <script type="text/javascript">
                colocar_portada();//gestiona los anuncios de nivel 5
                $('select').on('change', enviar_usuario);//probando navegación
        </script>
    </body>
</html>
