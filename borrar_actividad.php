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

$conexion->query("DELETE from actividad WHERE id_actividad like $idActividad ;");
$conexion->close();
header("Location: actividades.php");

?>