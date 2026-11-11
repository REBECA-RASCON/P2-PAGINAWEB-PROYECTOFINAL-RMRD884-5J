<?php
// Abre la sesion actual
session_start();
// Borra los datos de la sesion
$_SESSION = [];
// Cierra la sesion
session_destroy();
// Regresa a la pagina de inicio de sesion
header("Location: sesion.html");
exit;
