<?php
$crear = '';
if(isset($_POST['crear'])){
    $crear = 'CREADO';
    var_dump($crear);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>crear-seervicio</title>
    </head>
    <body>
        <h1><?php echo $crear; ?></h1>
        <form class="comprobar-anuncio" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name="crear" value="crear">
                Crear
            </button>
        </form>
    </body>
</html>
