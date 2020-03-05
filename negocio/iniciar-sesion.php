<?php
require('..\datos\BD.php');
echo $_SERVER['PHP_SELF'];

//definimos que acceso vamos a permitir con el inicio de sesión
$destino = $_SERVER['PHP_SELF'];
//------------------------------------------------------------------------------
//comprobamos si se trata del administrador, de algún gestor

if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario'] == 'particular'){
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $dbh = conectar();
        $tabla = 'usuarios';
        $registro = obtner_un_usuario($dbh, $tabla, $usuario);
        if(isset($registro['id_particular'])){
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
    isset($_POST['usuario']) == 'adminmobshop' &&
    isset($_POST['password']) == 'pasinmobshop'){
    $destino = "..\presentacion\administrador-ui.php";//Acceso administrador
}
if(isset($_POST['tipo_usuario']) && $_POST['tipo_usuario']  == '--' &&
    isset($_POST['usuario']) != 'adminmobshop') {
        //verificamos si está registrado
        $esta_registrado = false;
        if($esta_registrado) {
            $destino = "..\presentacion\gestor-ui.php";//Acceso particulares
        }
}
#var_dump($_POST['tipo_usuario'], $destino);

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
