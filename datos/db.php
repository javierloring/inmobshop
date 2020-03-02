<?php
// Configuración necesaria para acceder a la data base.
$hostname = "localhost";
$usuariodb = "dwes";
$passworddb = "dwes";
$dbname = "tienda";

// Generando la conexión con el servidor
$conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
?>
