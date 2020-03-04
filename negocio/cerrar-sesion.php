<?php
//cerrar sesión es eliminar la sesión actual y volver al index.php
sesion_start();
unset($_SESSION);
header('Location: index.php');
