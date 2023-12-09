<?php
if(session_status() != PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión</title>

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main_style.css">
    <link rel="stylesheet" href="./css/rejillas.css">
</head>

<body>
    <header>
        <div class="header">
            <div>
                <a href="./index.php">
                    <picture>
                        <img src="./assets/img/leaf.svg" width="40vw" alt="logo_leaf">
                    </picture>
                </a>
                <a href="./index.php">leaf</a>
            </div>
            <div>
                <div id="notificaciones"></div>
                <a href="./carrito.php" title="Carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                        viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg>
                </a>
                <a href="./verificador/sesion_iniciada.php" title="Sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="nav">
            <nav>
                <a href="#">Libros</a><a href="#">Ebooks</a><a href="#">Accesorios</a><a href="#">Audiolibros</a>
            </nav>
        </div>
    </header>
    <section>
        <article>
            <header>
                <h2>Iniciar Sesión</h2>
            </header>
            <form action="./procesar_inicio_sesion.php" method="post" id="form-inicio">
                <fieldset>
                    <label for="username">Usuario:</label>
                    <input type="text" name="username" id="username" placeholder="Nombre de usuario" autofocus required>
                </fieldset>
                <fieldset>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                </fieldset>
                <input type="submit" value="Iniciar Sesión">
            </form>
            <?php
                if (isset($_GET['err'])) {
                    echo '<p class="nota">';
                    if ($_GET['err'] == 1) {
                        echo 'Usuario no existente';
                    } else {
                        echo 'Contraseña incorrecta';
                    }
                    echo '</p>';
                }
            ?>
        </article>
        <article>
            <h4>¿Aún sin cuenta?</h4>
            <a href="./registro_usuario.php">Regístrate</a>
        </article>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>