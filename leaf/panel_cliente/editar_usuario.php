<?php
require __DIR__."/../verificador/cliente_valido.php";
require __DIR__."/../data/usuarios.php";
if (session_status() != PHP_SESSION_ACTIVE) session_start();

$username = $_SESSION['username'];
$cliente = obtenerCliente($username);
$generos = obtenerClienteGensFav($cliente->id);
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
                <h2>Actualizar datos</h2>
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
            } else if ($err == 2) {
                echo '<div class="nota">Nombre de usuario ya registrado</div>';
            }
        }
        ?>
        <form action="./../data/actualizar_cliente.php" method="post">
            <fieldset>
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" id="nombres" value="<?php echo $cliente->nombres?>" placeholder="nombres" autofocus required>
            </fieldset>
            <fieldset>
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" value="<?php echo $cliente->apellidos?>" placeholder="apellidos" required>
            </fieldset>
            <fieldset>
                <legend>Sexo</legend>
                <div>
                    <input type="radio" name="sexo" id="femenino" value="f" required <?php if ($cliente->sexo == 'f') echo "checked"?>>
                    <label for="femenino">Femenino</label>
                </div>
                <div>
                    <input type="radio" name="sexo" id="masculino" value="m" <?php if ($cliente->sexo == 'm') echo "checked"?>>
                    <label for="masculino">Masculino</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Dirección</legend>
                <textarea name="direccion" id="direccion" cols="30" rows="10" placeholder="domicilio"
                    required><?php echo $cliente->direccion?></textarea>
            </fieldset>
            <fieldset>
                <legend>Géneros literarios favoritos</legend>
                <div>
                    <input type="checkbox" name="romance" id="romance" <?php if (in_array('romance', $generos)) echo "checked"?>>
                    <label for="romance">Romance</label>
                </div>
                <div>
                    <input type="checkbox" name="horror" id="horror" <?php if (in_array('horror', $generos)) echo "checked"?>>
                    <label for="horror">Horror</label>
                </div>
                <div>
                    <input type="checkbox" name="drama-misterio" id="drama-misterio" <?php if (in_array('drama-misterio', $generos)) echo "checked"?>>
                    <label for="drama-misterio">Drama/Misterio</label>
                </div>
                <div>
                    <input type="checkbox" name="comic-manga" id="comic-manga" <?php if (in_array('comic-manga', $generos)) echo "checked"?>>
                    <label for="comic-manga">Cómic/Manga</label>
                </div>
                <div>
                    <input type="checkbox" name="accion-aventura" id="accion-aventura"  <?php if (in_array('accion-aventura', $generos)) echo "checked"?>>
                    <label for="accion-aventura">Acción/Aventura</label>
                </div>
                <div>
                    <input type="checkbox" name="cf-fantasia" id="cf-fantasia" <?php if (in_array('cf-fantasia', $generos)) echo "checked"?>>
                    <label for="cf-fantasia">Ciencia Ficción/Fantasía</label>
                </div>
            </fieldset>
            <fieldset>
                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username" id="username" value="<?php echo $username?>" placeholder="usuario" required>
            </fieldset>
            <fieldset>
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" value="<?php echo $cliente->email?>" placeholder="correo electrónico" required>
            </fieldset>
            <fieldset>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="contraseña" required>
                </div>
                <div class="nota">Introducir su contraseña para actualizar sus datos</div>
            </fieldset>
            <input type="submit" value="Actualizar datos">
        </form>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>