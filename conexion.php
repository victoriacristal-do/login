<?php

// datos de conexion con mysql
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'usuario';

// conecto con la bae de datos
$mysqli = new mysqli($server, $user, $pass, $db);

// mostrar errores (eliminar esta línea si está en un sitio en produccion)
mysqli_report(MYSQLI_REPORT_ERROR);

?>