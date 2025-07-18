<?php
session_start();
if(!isset($_SESSION['user_id']) or !isset($_GET['idActividad'])){
    session_destroy();
    header("Location: index.php");
}

require 'database.php';

$idActividad = $_GET['idActividad'];
$id_usuario = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['username'];

$stmt_actividades = $conexion->prepare("SELECT fecha_fin, E.estado, A.id_grado_actividad, O.recompensa FROM actividad A JOIN estado_actividad E JOIN grado_actividad O ON A.id_estado_actividad = E.id_estado_actividad and O.id_grado_actividad = A.id_grado_actividad WHERE A.id_actividad = ? ;");
$stmt_actividades->bind_param("i", $idActividad);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();
$actividadArray = [];
while ($row = $result_actividades->fetch_assoc()) {
    $actividadArray[] = $row;
}
$stmt_actividades->close();

if($actividadArray[0]['estado']=="Completada"){
    header("Location: home.php");
}

$pastFechaLimite=false;
$isHoy=false;

//formatear fecha
$fcha=date("d M Y", strtotime($actividadArray[0]['fecha_fin']));
$fchaHoy=date("d M Y");
if($fcha < $fchaHoy){
    $pastFechaLimite=true;
}

$monedas = $actividadArray[0]['recompensa'];
if($pastFechaLimite){
    $monedas/=2;
}

$conexion->query("UPDATE `balance` SET `total_moneda`=`total_moneda`+$monedas WHERE `id_usuario` = $id_usuario;");
$conexion->query("UPDATE `actividad` SET `id_estado_actividad`='1' WHERE id_actividad like $idActividad ;");
$conexion->close();
header("Location: actividad_single.php?idActividad=$idActividad");
?>