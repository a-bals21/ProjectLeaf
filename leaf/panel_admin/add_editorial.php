<?php
require __DIR__ . "/../verificador/admin_valido.php";
if (session_status() != PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Admin</title>

    <link rel="stylesheet" href="./../css/normalize.css">
    <link rel="stylesheet" href="./../css/main_style.css">
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
                    <a href="./panel.php">Panel</a>
                    <a href="./../cerrar_sesion.php">Desloguear</a>
                </nav>
            </div>
        </div>
    </header>
    <section>
        <header>
            <div>
                <h2>Panel - Administrador</h2>
            </div>
            <nav>
                <a href="./panel.php">Volver</a>
            </nav>
        </header>
        <h3>Registrar editorial</h3>
        <form action="./../data/registrar_editorial.php" method="post">
            <fieldset>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </fieldset>
            <?php
            if (isset($_GET['err'])) {
                $err = $_GET['err'];
                if ($err == 1) {
                    echo '<div class="nota">Editorial ya registrada</div>';
                } else if ($err == 0) {
                    echo '<div class="nota">La editorial ha sido registrada!</div>';
                }
            }
            ?>
            <input type="submit" value="Registrar">
        </form>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>