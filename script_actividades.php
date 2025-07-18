<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>

        <div class="dashboard-section actividades-section">
            <?php if (empty($actividadesBasicas) && empty($actividadesIntermedias) && empty($actividadesImportantes)): ?>
                <p>No tienes actividades próximas. ¡Es un buen momento para añadir una!</p>
                <button class="dashboard-button" onclick="location.href='actividades.php'">Gestionar Actividades</button>
            <?php else: ?>
                <div class="act-container">
                    <div class="act-item-basico">
                        <h3 class="act-h3">BÁSICAS</h3>
                        <ul class="dashboard-list">
                            <?php 
                                if(empty($actividadesBasicas)){
                                    echo '<p class="dashboard-list-item">No tienes actividades próximas Básicas</p>';
                                }else{
                                    printListaActividades($actividadesBasicas);
                                }
                            ?>
                        </ul>
                    </div>

                    <div class="act-item-intermedio">
                        <h3 class="act-h3">INTERMEDIAS</h3>
                        <ul class="dashboard-list">
                            <?php 
                                if(empty($actividadesIntermedias)){
                                    echo '<p class="dashboard-list-item">No tienes actividades próximas Intermedias...</p>';
                                }else{
                                    printListaActividades($actividadesIntermedias);
                                }
                            ?>
                        </ul>
                    </div>

                    <div class="act-item-importante">
                        <h3 class="act-h3">IMPORTANTES</h3>
                        <ul class="dashboard-list">
                            <?php 
                                if(empty($actividadesImportantes)){
                                    echo '<p class="dashboard-list-item">No tienes actividades próximas Importantes...</p>';
                                }else{
                                    printListaActividades($actividadesImportantes);
                                }
                            ?>
                        </ul>
                    </div>
                </div>
        
            <?php endif; ?>
        </div>
</body>
</html>
<?php 
function printListaActividades($act){
    foreach ($act as $actividad){
        if(!isset($actividad['fecha_fin'])){
            return;
        }
        $fcha=date("d M Y", strtotime($actividad['fecha_fin']));
        $fchaHoy=date("d M Y");

        if($fcha <= $fchaHoy and ($actividad['estado']!="Completada")){
            $fcha='<a class="a-rojo">'.$fcha.'</a>';
        }

        echo '<li class="dashboard-list-item"> <a class="a-ocultar" href="actividad_single.php?idActividad='.$actividad['id_actividad'].'">';
            echo '<h3 class="act-titulo"> '.$actividad['titulo'].' </h3><hr class="act-hr-li">';
            echo '<p class="act-desc">'.$actividad['descripcion'].' </p>';
            echo '<p><b>Fecha límite:</b> '.$fcha.' </p>';
            echo '<p><b>Estado:</b> <span class="'.$actividad['estado'].'">'.$actividad['estado'].'</span></p>';
        echo '</li></a>';
    }
}
?>