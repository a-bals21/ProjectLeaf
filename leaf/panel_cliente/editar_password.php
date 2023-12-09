<?php
require __DIR__."/../verificador/cliente_valido.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Cliente</title>

    <link rel="stylesheet" href="./../css/normalize.css">
    <link rel="stylesheet" href="./../css/main_style.css">
    <link rel="stylesheet" href="./../css/rejillas.css">
</head>

<body>
    <header>
        <div class="header">
            <div>
                <a href="./../index.php">
                    <picture>
                        <img src="./../assets/img/leaf.svg" width="40vw" alt="logo_leaf">
                    </picture>
                </a>
                <a href="./../index.php">leaf</a>
            </div>
            <div>
                <nav>
                    <a href="./../index.php">Inicio</a>
                    <a href="./../cerrar_sesion.php">Desloguear</a>
                </nav>
            </div>
        </div>
    </header>
    <section>
        <header>
            <div>
                <h2>Cambiar contraseña</h2>
            </div>
            <nav>
                <a href="./panel.php">Volver</a>
            </nav>
        </header>
        <?php
        if (isset($_GET['err'])) {
            $err = $_GET['err'];
            if ($err == 1) {
                echo '<div class="nota">Contraseña de usuario incorrecta</div>';
            }
        }
        ?>
        <form action="./../data/actualizar_password_usuario.php" method="post">
            <fieldset>
                <div>
                    <label for="newpassword">Nueva contraseña:</label>
                    <input type="password" name="newpassword" id="newpassword" placeholder="contraseña" required>
                </div>
            </fieldset>
            <fieldset>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="contraseña" required>
                </div>
                <div class="nota">Introducir su contraseña para actualizar sus datos</div>
            </fieldset>
            <input type="submit" value="Cambiar contraseña">
        </form>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>