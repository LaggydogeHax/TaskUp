<?php
$host = "localhost";
$usuario = "root"; // tu usuario de MySQL
$contraseña = "";     // tu contraseña de MySQL
$dataBase = "gtc_gamificacion"; //nombre de la base de datos

$conexion = new mysqli($host, $usuario, $contraseña, $dataBase);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
