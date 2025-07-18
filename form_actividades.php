<?php
session_start();
if(!isset($_SESSION['username'])){
    session_destroy();
    header("Location: index.php");
}


require 'database.php';



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Añadir actividad</title>
</head>
<body class="index-body">
    <?php include 'encabezado.php'; ?>

    <div class="registro-div-formulario">
        <h1 class="index-h1">Añadir actividad</h1>
        <form action="añadir_actividad.php" method="post">
            <div class="registro-div-nombre">
                <input type="text" name="titulo" class="registro-input-nombre" required>
                <label class="registro-label">Titulo</label>
            </div>
            <div class="registro-div-apellido">
                <input type="text" name="desc" class="registro-input-apellido" required>
                <label class="registro-label">Descripción</label>
            </div>
            <div class="registro-div-nivel">
                <select name="lvl" class="registro-input-nivel" required>
                    <div class="opciones-registro">
                        <option value="1">Básico</option>
                        <option value="2">Medio</option>
                        <option value="3">Importante</option>
                    </div>
                </select>
                <label class="registro-label">Nivel de importancia</label>
            </div>
            <div class="registro-div-contraseña">
                <input type="date" min="<?= htmlspecialchars(date("Y-m-d",strtotime("-1 day")))?>" name="fecha" class="registro-input-contraseña" required value="<?= htmlspecialchars(date("Y-m-d",strtotime("-1 day")))?>">
                <label class="registro-label">Fecha</label>
            </div>

            <input type="submit" value="Añadir actividad">
        </form>
    </div>


</body>
</html>