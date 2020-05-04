<?php
//cerrar sesión es eliminar la sesión actual y volver al index.php
session_start();
session_unset();
session_destroy();
header('Location: ..\index.php');
