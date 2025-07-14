<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    session_destroy();
    header("Location: index.php");
}

require 'database.php';

$id_usuario = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['username'];

// Obtener datos del usuario
$stmt_usuario = $conexion->prepare("SELECT nombre, apellido FROM usuario WHERE id_usuario = ?");
$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$stmt_usuario->bind_result($nombre, $apellido);
$stmt_usuario->fetch();
$stmt_usuario->close();

// Obtener todas las actividades
$actividadesBasicas = [];
$actividadesImportantes = [];
$actividadesIntermedio = [];

$ac=1; //actividades basicas
$stmt_actividades = $conexion->prepare("SELECT titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 1 ORDER BY fecha_fin ASC");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesBasicas[] = $row;
}

$ac=2;//actividades internmedias
$stmt_actividades = $conexion->prepare("SELECT titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 2 ORDER BY fecha_fin ASC");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesIntermedias[] = $row;
}

$ac=3; //actividades importantes
$stmt_actividades = $conexion->prepare("SELECT titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 3 ORDER BY fecha_fin ASC");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesImportantes[] = $row;
}

$stmt_actividades->close();

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-home">

    <?php include 'encabezado.php'?>

    <div class="dashboard-container">
        <h2 class="dashboard-h2">Todas Tus Actividades:</h2>
        <div class="act-ividades">
            <p>Actividades completadas: 0</p>
            <p>Actividades incompletas: 0</p>
            <p>Total de actividades: 0</p>
        </div>
        <hr>
        <br>

        <button class="dashboard-button" onclick="location.href='form_actividades.php'">Añadir actividad a la lista</button>
        <button class="dashboard-button" onclick="location.href='form_actividades.php'">Gestionar actividades</button>
        <?php 
            include 'script_actividades.php';
        ?>
        <button class="dashboard-button" onclick="location.href='home.php'">Volver</button>
    </div>
</body>
</html>