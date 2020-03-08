<?php
require '..\vendor\autoload.php';
use  Monolog \ Logger ;
use  Monolog \ Handler \ StreamHandler ;
use  Monolog \ Handler \ FirePHPHandler ;

// Cree el registrador
$logger = new  Logger ( 'gestores' );
// Ahora agregue algunos controladores
$logger -> pushHandler ( new  StreamHandler(__DIR__. '\gestores.log' , Logger :: DEBUG ));
$logger -> pushHandler ( new  FirePHPHandler());

// Ahora puede usar su registrador
#$logger -> info ('Mi registrador ya está listo.');
