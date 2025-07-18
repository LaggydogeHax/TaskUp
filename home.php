<?php 
require 'database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$id_usuario = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['username'];

// Obtener datos del usuario
$stmt_usuario = $conexion->prepare("SELECT nombre, apellido FROM usuario WHERE id_usuario = ?");
$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$stmt_usuario->bind_result($nombre, $apellido);
$stmt_usuario->fetch();
$stmt_usuario->close();

// Obtener balance del usuario
$balance_total = 0;
$stmt_balance = $conexion->prepare("SELECT total_moneda FROM balance WHERE id_usuario = ?");
$stmt_balance->bind_param("i", $id_usuario);
$stmt_balance->execute();
$stmt_balance->store_result();
if ($stmt_balance->num_rows > 0) {
    $stmt_balance->bind_result($balance_total);
    $stmt_balance->fetch();
} else {
    // Si no hay balance, insertar uno por defecto
    $stmt_insert_balance = $conexion->prepare("INSERT INTO balance (id_usuario, total_moneda) VALUES (?, 0)");
    $stmt_insert_balance->bind_param("i", $id_usuario);
    $stmt_insert_balance->execute();
    $stmt_insert_balance->close();
}
$stmt_balance->close();

// Obtener actividades recientes (por ejemplo, las 5 más recientes o las 5 incompletas)
$actividadesBasicas = [];
$actividadesImportantes = [];
$actividadesIntermedio = [];

$ac=1; //actividades basicas
$stmt_actividades = $conexion->prepare("SELECT a.id_actividad, titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 1 and fecha_fin >= date(now()) and E.estado!='Completada' ORDER BY fecha_fin ASC LIMIT 3");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesBasicas[] = $row;
}

$ac=2;//actividades internmedias
$stmt_actividades = $conexion->prepare("SELECT a.id_actividad, titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 2 and fecha_fin >= date(now()) and E.estado!='Completada' ORDER BY fecha_fin ASC LIMIT 3");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesIntermedias[] = $row;
}

$ac=3; //actividades importantes
$stmt_actividades = $conexion->prepare("SELECT a.id_actividad, titulo, descripcion, fecha_fin, E.estado FROM actividad A JOIN estado_actividad E ON A.id_estado_actividad = E.id_estado_actividad WHERE id_usuario = ? and A.id_grado_actividad = 3 and fecha_fin >= date(now()) and E.estado!='Completada' ORDER BY fecha_fin ASC LIMIT 3");
$stmt_actividades->bind_param("i", $id_usuario);
$stmt_actividades->execute();
$result_actividades = $stmt_actividades->get_result();

while ($row = $result_actividades->fetch_assoc()) {
    $actividadesImportantes[] = $row;
}

$stmt_actividades->close();

// Obtener logros recientes o incompletos
$logros = [];
$stmt_logros = $conexion->prepare("SELECT titulo, descripcion, recompensa_dinero, ES.estado FROM logro L JOIN estado_logro ES ON L.id_estado_logro = ES.id_estado_logro WHERE id_usuario = ? ORDER BY id_logro DESC LIMIT 3");
$stmt_logros->bind_param("i", $id_usuario);
$stmt_logros->execute();
$result_logros = $stmt_logros->get_result();
while ($row = $result_logros->fetch_assoc()) {
    $logros[] = $row;
}
$stmt_logros->close();

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body class="body-home">
    <?php 
        include 'encabezado.php';
    ?>

    <div class="dashboard-container">
        <h1 class="dashboard-h1">Bienvenido/a, <?php echo htmlspecialchars($nombre) . " " . htmlspecialchars($apellido); ?>!</h1>
        <hr>

        <div class="dashboard-section balance-section">
            <h2 class="dashboard-h2">Tu Balance Actual:</h2>
            <p class="dashboard-balance-amount">Monedas: <span class="balance-value"><?php echo htmlspecialchars($balance_total); ?></span></p>
            <button class="dashboard-button" onclick="location.href='shop.php'">Gachapon!!!!</button>
        </div>

        <h2 class="dashboard-h2">Tus Próximas Actividades:</h2>
        <button class="dashboard-button" onclick="location.href='actividades.php'">Ver todas las Actividades</button>
        <?php  
            include 'script_actividades.php';
        ?>

        <div class="dashboard-section logros-section">
            <h2 class="dashboard-h2">Tus Logros Recientes</h2>
            <?php if (empty($logros)): ?>
                <p>Aún no tienes logros. ¡Completa tareas para ganar recompensas!</p>
            <?php else: ?>
                <ul class="dashboard-list">
                    <?php foreach ($logros as $logro): ?>
                        <li class="dashboard-list-item">
                            <h3><?php echo htmlspecialchars($logro['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($logro['descripcion']); ?></p>
                            <p>Recompensa: <?php echo htmlspecialchars($logro['recompensa_dinero']); ?> monedas</p>
                            <p>Estado: <span class="status-<?php echo strtolower($logro['estado']); ?>"><?php echo htmlspecialchars($logro['estado']); ?></span></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="dashboard-button" onclick="location.href='logros.php'">Ver todos los Logros</button>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>