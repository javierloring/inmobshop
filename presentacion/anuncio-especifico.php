
<?php
require '../vendor/autoload.php';
require '../datos/Anuncio.php';
require '../config.php';
$id_anuncio = 0;
#var_dump($_GET);
if(isset($_GET['id_anuncio'])){
	$id_anuncio = $_GET['id_anuncio'];
}
$breadcrumb = '';
if(isset($_GET['nombre']) && isset($_GET['url'])) {
	$breadcrumb = array('nombre' => $_GET['nombre'], 'url' => $_GET['url']);
	// $nombre = $_GET['nombre'];
	// $url = $_GET['url'];
	#var_dump($breadcrumb, $breadcrumb['nombre'], $breadcrumb['url']);
}
#var_dump($breadcrumb, $id_anuncio);
//------------FORMULARIO DE CONTACTO
if(isset($_POST['nombre']) && ISSET($_POST['email']) && isset($_POST['telefono'])){
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	if($usuario = Usuario::obtenUsuario($nombre)){
		$email_bd = $usuario->getEmail();
		if($email_bd != $email){
			$mensaje = 'Debe estar registrado para contactar con el anunciante';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Anuncio-inmobshop</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
        <script src="..\js\anuncio-especifico.js"></script>
        <script src="..\js\w3.js"></script>

    </head>
    <body>
		<header>
            <div class = "w3-row w3-container w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <a  href="<?= HOME_INMOBSHOP ?>">
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
        <main>
            <div id="breadcrumbs" class="w3-row w3-container w3-padding">
                <div class="w3-col l2 m12 s12">
                    <p id="identificador_anuncio" class="oculto"><?= $id_anuncio ?></p>
					<P></P>
                </div>
                <div class="w3-col l8 m12 s12">
                    <ul class="breadcrumb w3-ul">
                      	<?php
					  	$html = '';
					  	if($breadcrumb['nombre']  == 'Home'){
						  	$html .= '<li><a href="' . $breadcrumb['url'] . '">Home</a></li>';
							#var_dump($html);
						} else if($breadcrumb['nombre']  == 'res_busq'){
							$html .= '<li><a href="/inmobshop/index.php">Home</a></li>';
							$html .= '<li><a href="/inmobshop/resultado-busqueda.php" id="anterior">resultado busqueda</a></li>';
							#var_dump($html);
						}
					  	echo $html;
					  	?>
                  		<li>anuncio</li>
                    </ul>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div class="w3-row w3-container">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div id="anuncio" class ="w3-col l6 m12 s12 w3-container w3-center">
                    <div id="slider" class="w3-content w3-display-container">
                    </div>
					<div id="descripcion" class="w3-col w3-border">
						<p>Aquí la descripción</p>
					</div>
                </div>
				<div id="contacto" class="w3-col l2 m12 s12 w3-container w3-canter w3-border w3-border-inmobshop">
					<form id="form_3" class="" action="#" method="post">
						<div class="w3-medium w3-text-inmobshop w3-padding-large w3-center">
							<b>Contactar</b> con el anunciante
						</div>
						<div class="w3-center">
							<textarea name = "mensaje"
								      rows = "8"
								      cols = ""
							   placeholder = "Consulte al anunciante los detalles del anuncio..."
							     maxlength = "255"
							   	  required
									 style = "width: 100%;"></textarea>
						</div>
						<div class="w3-medium w3-text-inmobshop w3-padding-large w3-center">
							<b>Introduzca</b> sus datos
						</div>
						<div class="w3-center">
							<input type = "text"
							       name = "nombre"
								  value = ""
						    placeholder = "Nombre"
							  maxlength = "45"
							   required
							      style = "width: 100%; margin-top: 15px;">
						</div>
						<div class="w3-center">
							<input type = "email"
							       name = "email"
								  value = ""
					        placeholder = "Email"
						      maxlength = "254"
							    pattern = "[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
							   required
							      style = "width: 100%; margin-top: 15px;">
						</div>
						<div class=" w3-center">
							<input type = "tel"
							       name = "telefono"
							      value = ""
							placeholder = "Teléfono"
							  maxlength = "9"
							    pattern = ""
							   required
							      style = "width: 100%; margin-top: 15px;">
						</div>
						<div class="">
							<div class="w3-center w3-border"
							     style="width: 100%; margin-top: 15px; padding-top:15px;">
								<span><i class="material-icons inmobshop">call</i></span>
								<span style="color: #000066"><b>444 444 444</b></span>
							</div>
							<div class="w3-center w3-border"
								 style="width: 100%; margin-top: 0;">
								<img src = "..\datos\logos-profesionales\prof-id-1\vallealto.png"
								   width = "100%"
								   title = "vallealto, s.l."
								     alt = "vallealto, s.l.">
							</div>
						</div>
						<div id="boton_contactar"
							 class=" w3-center w3-button w3-inmobshop w3-hover-indigo"
						     style="width: 100%; margin: 15px 0;">
							<p>Contactar</p>
						</div>
					</form>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
			<div class="w3-row w3-container">

			</div>
			<div id="subir" class="w3-row w3-bootom" style="position:relative;bottom: 0;">
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
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 50px;">
                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-inmobshop" style="height: 50px;">
                    <p class = "w3-text-amber w3-small"
                       style = "text-align: center;padding-top: 20px;">
                        2020
                    </p>
                </div>
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 50px;">
                </div>
            </div>
        </footer>
        <script type="text/javascript">
			//no admite $(function(){}); pues los botones de avance del slider
			//registran el evento plusDivs()
			$('#anterior').on('click', volver_anterior);
			//creamos el html para el slider con la colección de fotos del anuncio
			//el id_del anuncio se toma de un párrafo oculto en las migas de pan
			var id_anuncio = $('#identificador_anuncio').html();
			//establecemos el índice par ala primera foto
			var slideIndex = 1;
			//creamos el slider
			crear_slider(id_anuncio);
			//rellenar contenido

			//el formulario se gestiona con la función contactar
			$('#boton_contactar').on('click', contactar);

        </script>
    </body>
</html>
