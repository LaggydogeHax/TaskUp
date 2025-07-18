<?php
require 'database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    session_destroy();
    header("Location: index.php");
}
$id_usuario = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['username'];

$balance_total = 0;
$stmt_balance = $conexion->prepare("SELECT total_moneda FROM balance WHERE id_usuario = ?");
$stmt_balance->bind_param("i", $id_usuario);
$stmt_balance->execute();
$stmt_balance->store_result();
if ($stmt_balance->num_rows > 0) {
    $stmt_balance->bind_result($balance_total);
    $stmt_balance->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Vicio extremo</title>
</head>
<body class="body-home">

    <?php 
        include 'encabezado.php';
    ?>

    <div class="dashboard-container">
        <button class="dashboard-button" onclick="location.href='home.php'">Volver</button>
        <h1>GACHA!!</h1>
        <hr>
        <p>Prueba tu suerte con el gachapon y obtén fotos de perfil</p>
        <p>Tus monedas: <span id="balance"><?php echo htmlspecialchars($balance_total); ?></span></p>

        <div class="gacha-div">
            <button class="dashboard-button-verde" onclick="rollGacha()">Probar (50 monedas)</button>

            <div class="gacharesult" id="gacharesult">
                <div class="pfp-box" id="pfp-box">
                    <p class="pe-id" id="pe-id"></p>
                </div>
            </div>

        </div>

    </div>
    
</body>
<script>
  function rollGacha() {
    if(parseInt(document.getElementById("balance").innerText) > 49){
        var randomIndex = Math.floor(Math.random() * 7);
        randomIndex=randomIndex+1;
        document.getElementById("gacharesult").innerText = "🎉 Felicidades!! obtuviste:";

        const imageBox = document.getElementById("gacharesult");
        const img = document.createElement("img");

        img.src = "Imagenes/gachapon/"+randomIndex+".png";
        img.alt = "pfp";
        img.style.width = "20%";
        img.style.borderRadius = "50px";

        imageBox.appendChild(img);

        document.getElementById("pe-id").innerText = "Anadir como foto de perfil";

    }else{
        document.getElementById("gacharesult").innerText = "No tienes suficientes monedas para esto...";
    }
    
  }
</script>
</html>