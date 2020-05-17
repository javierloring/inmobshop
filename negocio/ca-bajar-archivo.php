<?php
//con este script borramos los archivos subidos
if(isset($_POST['archivo'])){
    $archivo = $_POST['archivo'];
    $archivos_subidos = scandir('fotos-videos');
    //var_dump($archivos_subidos);
    //die;
    foreach($archivos_subidos as $nombre) {
        if ($nombre == $archivo){
            unlink('fotos-videos/'.$nombre);
            echo 'El archivo se ha quitado correctamente';
            exit;
        }
    }
    echo 'No se ha encontrado el archivo a quitar.';
}
