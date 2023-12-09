<?php
if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main_style.css">
    <link rel="stylesheet" href="./css/stick_header.css">
    <link rel="stylesheet" href="./css/rejillas.css">
    <link rel="stylesheet" href="./css/index.css">

    <script type="text/javascript" src="./js/carrito.js"></script>
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
                <a href="https://librerialeaf.000webhostapp.com/carrito.php" title="Carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg>
                </a>
                <a href="https://librerialeaf.000webhostapp.com/verificador/sesion_iniciada.php" title="Sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
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
        <div id="anuncio">

        </div>
    </section>
    <section>
        <header>
            <div>
                <h2>Busqueda</h2>
            </div>
            <div class="buscador">
                <form action="./buscador.php" method="post">
                    <fieldset>
                        <label for="buscar">Buscar:</label>
                        <input type="text" name="buscar" id="buscar" value="<?php echo $_POST['buscar']?>" placeholder="Nombre del libro">
                    </fieldset>
                    <input type="submit" value="Buscar">
                </form>
            </div>
        </header>
        <div id="productos" class="rejilla" style="grid-template-columns: repeat(auto-fill, minmax(12rem, 1fr));">
            <?php
            require __DIR__.'/data/productos.php';
            
            $busqueda = $_POST["buscar"];
            if (isset($_GET['page'])) {
                $pagina = intval($_GET['page']);
                $USUARIOS = obtenerProductosPorTitulo($busqueda, $pagina);
            } else {
                $USUARIOS = obtenerProductosPorTitulo($busqueda);   
            }

            foreach ($USUARIOS as $usuario) {
                print '<div class="producto">';
                mostrarProducto($usuario, "./");
                print '<div class="controles">';
                print '<input type="button" producto-id="' . $usuario->id . '" value="Agregar al carrito" onclick="sumarACarrito(this)">';
                print "</div>";
                print "</div>";
            }
            ?>
        </div>
    </section>
    <section>
        <input type="button" value="<" onclick="decrementar()">
        <form action="./buscador.php" method="post" id="control">
            <fieldset>
                <input type="hidden" name="buscar" id="buscar" value="<?php echo $_POST['buscar']?>">
                <input type="number" name="page" id="page" value="<?php
                if (isset($_POST['page'])) {
                    echo $_POST['page'];
                } else {
                    echo 1;
                }
                ?>">
            </fieldset>
            <input type="submit" value="Ir">
        </form>
        <input type="button" value=">" onclick="aumentar()">
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>
    
    <script>
        let control = document.querySelector("form#control")
        
        function aumentar() {
            let pagina = document.querySelector("#page")
            
            pagina.value = parseInt(pagina.value) + 1
            control.submit()
        }
        
        function decrementar() {
            let pagina = document.querySelector("#page")
            
            if (parseInt(pagina.value) > 1) {
                pagina.value = parseInt(pagina.value) - 1
            }
            control.submit()
        }
    </script>
</body>

</html>