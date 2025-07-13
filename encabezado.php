<?php
    $documentoRoot = $_SERVER['DOCUMENT_ROOT'];
    $rutaAbsolutaLogo = $documentoRoot . '/imagenes/logo.png';
    $relativa = '../imagenes/logo.png';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Imagenes/logo.png">
</head>
<body>
    
    <header class="encabezado-header">
            <?php
                if(isset($_SESSION['username'])){
                    echo '
                        <div class="encabezado-div-logo">
                            <a><img src="Imagenes/logo.png" alt="Logo de empresa" class="encabezado-img-logo"></a>
                        </div>
                        <nav>
                            <ul class="encabezado-ul">
                                <li class="encabezado-li"><a class="encabezado-a">'.$_SESSION['username'].'</a></li>
                                <li class="encabezado-li"><a class="encabezado-a" href="logout_d.php">Cerrar Sesion</a></li>   
                            </ul>
                        </nav>
                    ';
                }else{
                    echo '
                        <div class="encabezado-div-logo">
                            <a href="#"><img src="imagenes/logo.png" alt="Logo de empresa" class="encabezado-img-logo"></a>
                        </div>
                        <nav>
                            <ul class="encabezado-ul">';
                            if(isset($pag)){
                                if($pag=="login"){
                                    echo '<li class="encabezado-li"><a href="registro.php" class="encabezado-a">Registrarse</a></li>';
                                }elseif($pag=="reg"){
                                    echo '<li class="encabezado-li"><a href="index.php" class="encabezado-a">Iniciar Sesion</a></li>';
                                }
                            }else{
                                echo '<li class="encabezado-li"><a href="logout_d.php" class="encabezado-a">error</a></li>';
                            }
                            echo '</ul>
                        </nav>
                    ';
                }
            ?>
    </header>
</body>
</html>


