<?php

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset = "utf-8">
        <title> Ejemplo simple de Dropzone </title>
        <!--
          NO SIMPLEMENTE COPIE ESAS LÍNEAS. Descargue los archivos JS y CSS de
          última versión (https://github.com/enyo/dropzone/releases/latest), y
          ¡Hospédelos usted mismo!
      -->
        <script src = "..\js\dropzone.js"> </script>
        <link rel = "stylesheet" href = "..\css\dropzone.css">
    </head>
    <body>
        <p>
          Este es el ejemplo más mínimo de Dropzone. La carga en este ejemplo
          no funciona, porque no hay un servidor real para manejar la carga del archivo.
        </p>
        <!-- Cambiar / objetivo de carga a su dirección de carga -->
        <form action = "..\fotografias\ <?php echo $user. "\\$foto" ?>" class = "dropzone"> </form>
    </body>
</html>
