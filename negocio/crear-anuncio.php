<?php
session_start();
if(isset($_SESSION['usuario']['user'])){
    $user = $_SESSION['usuario']['user'];
    //como direccionar la colección de fotos?
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset = "utf-8">
        <title> Ejemplo simple de Dropzone </title>

        <script src = "..\js\dropzone.js"> </script>
        <link rel = "stylesheet" href = "..\css\dropzone.css">
    </head>
    <body>

        <h2>Carga aquí las fotos de tu anuncio.</h2>
        <p>Puedes arrastrarlas y previsualizarlas antes de descargar.</p>
        <!-- Cambiar / objetivo de carga a su dirección de carga -->
        <form action = "..\fotografias\ <?php echo $user. "\\$foto" ?>" class = "dropzone"> </form>
    </body>
</html>
