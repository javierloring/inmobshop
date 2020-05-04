<?php
use datos\{DB, Usuario, Particular};
// require('..\datos\DB.php');
// require('..\datos\Usuario.php');
// require('..\datos\Particular.php');
var_dump($_POST);
echo $_SERVER['PHP_SELF'];

//definimos que acceso vamos a permitir con el inicio de sesión
$destino = $_SERVER['PHP_SELF'];
if(isset($_POST['tipo_usuario'])) $_tipo_usuario = $_POST['tipo_usuario'];
//------------------------------------------------------------------------------
//comprobamos si se trata del administrador, o de algún gestor

if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'particular'){
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $user = $_POST['usuario'];
        $pass = $_POST['password'];
        if(Usuario::registrado($user, $pass) && Particular::esParticular($user, $pass)) {
            $destino = "..\presentacion\particular-ui.php";//Acceso particulares
        }else {
            $error[] = 'El tipo de usuario introducido, el nombre o la contraseña'.
                    ' indicados no se corresponde con los existentes en el registro'.
                    ' Por favor pruebe de nuevo.';
        }
    }

var_dump('paso por aquí');
}
if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario']  == 'profesional'){

    //verificamos si está registrado
    $esta_registrado = false;
    if($esta_registrado) {
        $destino = "..\presentacion\profesional-ui.php";//Acceso particulares
    }
}
if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario']  == 'demandante'){

        //verificamos si está registrado
        $esta_registrado = false;
        if($esta_registrado) {
            $destino = "..\presentacion\demandante-ui.php";//Acceso particulares
        }
}
if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario']  == '--' &&
    isset($_POST['usuario']) &&  $_POST['usuario'] == 'user-inmobshop' &&
    isset($_POST['password']) &&  $_POST['password'] == 'pass-inmobshop') {
        var_dump('paso por aquí2');
    header('Location: ..\presentacion\administrador-ui.php');//Acceso administrador
}
if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario']  == '--' &&
    isset($_POST['usuario']) &&  $_POST['usuario'] != 'user-inmobshop') {
        //el administrador general no precisa registro
        $destino = "..\presentacion\gestor-ui.php";//Acceso particulares
}

//------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>inicio sesión - inmobshop</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <input type="hidden" name="tipo_usuario" value="<?php echo $_tipo_usuario ?>">
            </fieldset>
        </form>
<?php
var_dump($_POST, $destino);
?>
    </body>
</html>
