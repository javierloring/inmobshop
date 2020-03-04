<?php
$comprobar = '';
if(isset($_POST['comprobar'])){
    $comprobar = 'COMPROBADO';
    var_dump($comprobar);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>comprobar-anuncio</title>
    </head>
    <body>
        <h1><?php echo $comprobar; ?></h1>
        <form class="comprobar-anuncio" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name="comprobar" value="comprobar">
                Comprobar
            </button>
        </form>
    </body>
</html>
