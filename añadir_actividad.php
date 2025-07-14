<?php
session_start();

require 'database.php';

if(!isset($_SESSION['username'])){
    session_destroy();
    header("Location: index.php");
}

$titulo = $_POST['titulo'];
$desc = $_POST['desc'];
$fecha = $_POST['fecha'];
$nivel = $_POST['lvl'];
$id=$_SESSION['user_id'];
$uno=1;
$dos=2;
$stmt = $conexion->prepare("INSERT INTO `actividad`(`id_actividad`,`id_usuario`, `fecha_inicio`, `fecha_fin`, `titulo`, `descripcion`, `id_estado_actividad`, `id_lista_actividades`, `id_grado_actividad`) VALUES ('',?,?,?,?,?,?,?,?);");
$stmt->bind_param("ssssssss", $id, $fecha, $fecha,$titulo, $desc, $dos,$uno,$nivel);

if ($stmt->execute()) {
    header("Location: actividades.php");
} else {
    echo "Error al insertar: " . $stmt->error;
}


?>