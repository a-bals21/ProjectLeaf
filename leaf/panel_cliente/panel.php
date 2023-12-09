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
                <nav>
                    <a href="./editar_usuario.php">Editar perfil</a>
                    <a href="./editar_password.php">Editar contraseña</a>
                </nav>
            </div>
        </header>
        <h2>Información</h2>
        <div>
            <?php
            require __DIR__ . "/../data/usuarios.php";
            if (session_status() != PHP_SESSION_ACTIVE) session_start();
            $generos = array(
                "romance"=>"Romance",
                "horror"=>"Horror",
                "drama-misterio"=>"Drama/Misterio",
                "comic-manga"=>"Cómic/Manga",
                "cf-fantasia"=>"Ciencia Ficción / Fantasía");
            
            $CLIENTE = obtenerCliente($_SESSION['username']);

            mostrarCliente($CLIENTE);
            
            $generos_cliente = obtenerClienteGensFav($CLIENTE->id);
            if (count($generos_cliente)) {
                echo "<div><h3>Generos favoritos:</h3>";
                echo "<ul>";
                foreach ($generos_cliente as $genero) {
                    echo '<li>'. $generos[$genero] . '</li>';
                }
                echo "</ul></div>";
            } else {
                echo "<div><p>Sin géneros literarios favoritos</p></div>";
            }
            ?>
        </div>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>