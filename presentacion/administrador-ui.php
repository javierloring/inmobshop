<?php
//iniciamos sesión
if(isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    session_start();
    $_SESSION['usuario']['usuario'] = $usuario;
    $_SESSION['usuario']['password'] = $password;
    $_SESSION['usuario']['hora'] = time();//current timestamp
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>administrador-casashop</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <h1>Aquí gestiona el administrador</h1>
        <form class="" action="..\negocio\cerrar-sesion.php" method="post">
            <input type="submit" name="cerrar" value="Cerrar Sesión">
        </form>
    </body>
</html>
