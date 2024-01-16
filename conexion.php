<?php
// Archivo: conexion.php

$host = "localhost";
$user = "root";
$password = "";
$database = "formulario";

$conex = mysqli_connect($host, $user, $password, $database);

if (!$conex) {
    die("La conexión falló: " . mysqli_connect_error());
}
?>
