<?php

require 'vendor/autoload.php';
require 'config.php';
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
$nombre = 'Home';
#var_dump($url, $nombre);
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
        <script src="js\w3.js"></script>
    </head>
    <body>
        <header class="w3-container w3-padding w3-margin w3-inmobshop"
                style="position: sticky; position: -webkit-sticky; top: 0;">
            <h1>Hola fondo header</h1>
        </header>
        <main class="w3-container w3-blue">
            <h1>Hola fondo main</h1>
            <div id=" lorem_ipsum"class="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
                </p>
                <p style="position: sticky; position: -webkit-sticky; top: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in enim massa. Ut ut sollicitudin enim. Quisque finibus ac ipsum eu efficitur. In tristique justo eu nulla consectetur mattis. Integer fermentum lacus quis nibh hendrerit elementum. Duis vel lobortis enim. Praesent diam augue, hendrerit id risus at, vulputate efficitur ipsum. Aenean sit amet finibus enim, a hendrerit nibh. In malesuada egestas dui. Morbi risus ligula, varius et nisi ac, congue finibus nulla. Nam a quam lacus. Sed lobortis blandit leo sed porttitor. Praesent tincidunt odio ut vehicula sollicitudin. Nullam a magna porttitor, tempus nibh eu, cursus nisi. Nam ex tortor, accumsan non bibendum non, vestibulum ac erat. In congue tortor ullamcorper interdum finibus.
                </p>
            </div>
        </main>
        <footer class="w3-container w3-red">
            <h1>Hola fondo footer</h1>
        </footer>
        <script src="js\inicio-sesion.js" charset="utf-8"></script>
        <script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function(){
                var portada = document.getElementById('portada');
                colocar_portada(portada);//gestiona los anuncios de nivel 5
                $('select').on('change', enviar_usuario);//probar navegación
            });
        </script>
    </body>
</html>
