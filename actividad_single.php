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

$stmt_actividades = $conexion->prepare("SELECT titulo, descripcion, fecha_fin, E.estado, A.id_grado_actividad, O.recompensa FROM actividad A JOIN estado_actividad E JOIN grado_actividad O ON A.id_estado_actividad = E.id_estado_actividad and O.id_grado_actividad = A.id_grado_actividad WHERE A.id_actividad = ? ;");
$stmt_actividades->bind_param("i", $idActividad);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();
$actividadArray = [];
while ($row = $result_actividades->fetch_assoc()) {
    $actividadArray[] = $row;
}
$stmt_actividades->close();
$conexion->close();

$pastFechaLimite=false;
$isHoy=false;

//formatear fecha
$fcha=date("d M Y", strtotime($actividadArray[0]['fecha_fin']));
$fchaHoy=date("d M Y");
if($fcha <= $fchaHoy and ($actividadArray[0]['estado']!="Completada")){
    $actividadArray[0]['fecha_fin']='<a class="a-rojo">'.$fcha.'</a>';
    if($fcha < $fchaHoy){
        $pastFechaLimite=true;
    }else{
        $isHoy=true;
    }
}else{
    $actividadArray[0]['fecha_fin']=$fcha;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $actividadArray[0]['titulo']; ?></title>
</head>
<body class="body-home">
    <?php include 'encabezado.php'; ?>

    <div class="dashboard-container-actividad">
        <div class="actividad-div1">
            <button class="dashboard-button" onclick="location.href='actividades.php'">Volver</button>
            
            <p>Actividad asignada:</p>

            <h1 class="act-h1"><?php echo $actividadArray[0]['titulo']; ?></h1>
            <hr>

            <p class="sing-act-desc"><b>Descripción: </b><?php echo $actividadArray[0]['descripcion']; ?></p>

            <p class="pe"><b>Fecha límite: </b><?php echo $actividadArray[0]['fecha_fin'];
                if($pastFechaLimite){
                    echo " (Vencido)";
                }elseif($isHoy){
                    echo " (Hoy!)";
                }
            ?></p> 
            <p class="pe"><b>Estado: </b> <?php echo $actividadArray[0]['estado']?></p>

            <p><?php
                if($actividadArray[0]['estado']!="Completada"){
                    $monedas = $actividadArray[0]['recompensa'];

                    if($pastFechaLimite){
                        $monedas/=2;
                    }

                    echo "<u>Completa esta actividad para reclamar $monedas monedas</u>";
                }
            ?></p>

        </div>

        <div class="actividad-panelcontrol">
            <b>Acciones:</b><br>
            <?php
                if($actividadArray[0]['estado']!="Completada"){
                    echo '<button class="dashboard-button-verde"';
                    $location = "'completar_actividad.php?idActividad=$idActividad'"; //que
                    echo 'onclick="location.href='.$location.'">';
                    echo 'Marcar como completada</button>';
                }
            ?>
            
            <?php
                echo '<button class="dashboard-button-rojo"';
                $location = "'borrar_actividad.php?idActividad=$idActividad'"; //abueno pues
                echo 'onclick="confirmacion('.$idActividad.')">';
                echo 'Eliminar actividad</button>';
            ?>
        </div>

    </div>
</body>
<script>
    function confirmacion(id){
        if(window.confirm("Desea eliminar esta actividad?")){
            window.location.href="borrar_actividad.php?idActividad="+id;
        }
    }
</script>
</html>