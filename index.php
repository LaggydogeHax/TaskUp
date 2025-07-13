<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Iniciar Sesión</title>
</head>
<body class="index-body">
    <?php
        $pag="login";
        include 'encabezado.php';
    ?>

    <div class="index-div-formulario">
        <h1 class="index-h1">Inicio de sesión</h1>
        <form action="login_d.php" method="post" class="index-form-formulario">
            <div class="index-div-usuario">
                <input type="text" name="alias" class="index-input-usuario" required>
                <label class="index-label">Usuario</label>
            </div>

            <div class="index-div-contraseña">
                <input type="password" name="contraseña" minlength="4" maxlength="16" class="index-input-contraseña" required>
                <label class="index-label">Contraseña</label>
            </div>
            
            <input type="submit" value="Iniciar" class="index-input-submit">
        </form>
    </div>

    <p class="index-p-error index-errorMsg"> <!-- muestra mensaje de error por url (ver login.php) -->
        <?php
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "noUser":
                        echo "<u>Usuario no encontrado</u>";
                    break;
                    case "contInv":
                        echo "<u>Contraseña incorrecta</u>";
                    break;
                    case "usrCreado":
                        echo "<u>Usuario creado correctamente, inicie sesión</u>";
                    break;
                }
            }
        ?>
    </p>

    <p class="index-p">¿No estás registrado?<a href="registro.php" class="index-a"> Regístrate aquí</a></p>
</body>
</html>