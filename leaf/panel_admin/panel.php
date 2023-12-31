<?php
require __DIR__ . "/../verificador/admin_valido.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Admin</title>

    <link rel="stylesheet" href="./../css/normalize.css">
    <link rel="stylesheet" href="./../css/main_style.css">
    <link rel="stylesheet" href="./../css/rejillas.css">
    
    <script src="./../js/admin.js"></script>
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
                <h2>Panel - Administrador</h2>
            </div>
            <nav>
                <a href="./panel.php">Usuarios</a>
                <a href="./add_producto.php">Añadir productos</a>
                <a href="./add_editorial.php">Añadir editorial</a>
                <a href="./add_autor.php">Añadir autor</a>
            </nav>
        </header>
        <div id="usuarios" class="rejilla" style="--c:3">
            <div class="header">Nombre de usuario</div>
            <div class="header">Tipo de usuario</div>
            <div class="header"></div>
            
            <?php
            require __DIR__ . "/../data/usuarios.php";
            $USUARIOS = obtenerUsuarios();

            foreach ($USUARIOS as $usuario) {
                mostrarUsuario($usuario);
                print '<div class="controles">';
                if ($usuario->username != 'admin-leaf') {
                    print '<input type="button" username="' . $usuario->username . '" value="Eliminar" onclick="borrarUsuario(this)">';
                }
                print "</div>";
            }
            ?>
        </div>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>