<?php
echo $_SERVER['PHP_SELF'];

//definimos que acceso vamos a permitir con el inicio de sesión
$destino = '..\presentacion\administrador-ui.php';
//------------------------------------------------------------------------------
//comprobamos si se trata del administrador, de algún gestor

if(isset($_POST['tipo-usuario']) == 'particular'){
    $destino = "presentacion\particular-ui.php";//Acceso particulares
    //verificamos si está registrado

}
if(isset($_POST['tipo-usuario']) == 'profesional'){
    $destino = "presentacion\profesional-ui.php";//Acceso profesionales
    //verificamos si está registrado

}
if(isset($_POST['tipo-usuario']) == 'demandandante'){
    $destino = "presentacion\demandante-ui.php";//Acceso demandantes
    //verificamos si está registrado
}
if(isset($_POST['tipo-usuario']) == '' &&
    isset($_POST['usuario']) == 'adminmobshop' &&
    isset($_POST['password']) == 'pasinmobshop'){
    $destino = "presentacion\administrador-ui.php";//Acceso administrador
}
if(isset($_POST['tipo-usuario']) == '' &&
    isset($_POST['usuario']) != 'adminmobshop') {
    //verificamos si el gestor está registrado
    $destino = "presentacion\gestor-ui.php";//Acceso gestores
}


//------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form class = "inicio-sesion"
             action = "<?php echo $destino; ?>"
             method = "post"
        >
            <fieldset>
                <legend>Inicio de sesión</legend>
                <p><b>Nombre:</b></p>
                <input type = "text"
                       name = "usuario"
                    pattern = "^[a-zA-Z][a-zA-Z0-9-_\.]{3,45}$"
                      title = "Un nombre de usuario apropiado debe comenzar con
                      una letra, contener letras, números, guiones bajos y
                      puntos, y tener entre 3 y 45 caracteres de longitud"
                      value = ""
                   required
                >
                <p><b>Contraseña:</b></p>
                <input type = "password"
                       name = "password"
                   required
                >
                <p>
                <div class="">
                <input type = "submit"
                       name = "iniciar-sesion"
                      value = "Iniciar Sesión"
                >
                </div>
                </p>
            </fieldset>
        </form>
<?php
var_dump($_POST, $destino);
?>
    </body>
</html>
