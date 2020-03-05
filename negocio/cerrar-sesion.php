<?php
//cerrar sesión es eliminar la sesión actual y volver al index.php
sesion_start();
session_destroy();;
header('Location: ..\index.php');
