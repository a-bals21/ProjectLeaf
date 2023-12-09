<?php
if(session_status() != PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>

    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main_style.css">
    <link rel="stylesheet" href="./css/rejillas.css">
    <link rel="stylesheet" href="./css/carrito.css">

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
                <nav>
                    <a href="./index.php">Volver</a>
                </nav>
            </div>
        </div>
        <div class="nav">
            <nav>
                <a href="#">Libros</a><a href="#">Ebooks</a><a href="#">Accesorios</a><a href="#">Audiolibros</a>
            </nav>
        </div>
    </header>
    <section>
        <header>
            <div>
                <h2>Carrito</h2>
            </div>
        </header>
        <?php
        include __DIR__.'/data/productos.php';

        if (count($_SESSION["carrito"]) == 0) {
            echo '<div class="vacio">';
            echo "Nada en el carrito... ";
            echo '<a href="/index.php">Ir a comprar</a>';
            echo "<div>";
        } else {
            print '<div id="productos" class="rejilla" style="--c:6">';
            print '<div class="header">Imagen</div>';
            print '<div class="header">Producto</div>';
            print '<div class="header">Precio unidad</div>';
            print '<div class="header">Cantidad</div>';
            print '<div class="header">Precio total</div>';
            print '<div class="header"></div>';

            $productos = $_SESSION["carrito"];
            $suma = 0;

            foreach ($productos as $producto_id => $cantidad) {
                $usuario = obtenerProducto($producto_id);
                $usuario->cantidad = $cantidad;

                mostrarProductoCarrito($usuario, "./");

                $precioTotal = floatval($usuario->precio) * intval($usuario->cantidad);
                print '<div class="precio-total-producto"><p>$' . number_format($precioTotal, 2) . "</p></div>";

                print '<div class="controles">';
                print '<input type="button" producto-id="' . $usuario->id . '" value="Quitar 1 del carrito" onclick="restarDeCarrito(this)">';;
                print '<input type="button" producto-id="' . $usuario->id . '" value="Eliminar del carrito" onclick="eliminarDeCarrito(this)">';
                print "</div>";

                $suma += $precioTotal;
            }
            print "<div></div><div></div><div></div><div></div>";
            print "<div>Total:</div><div>$" . number_format($suma, 2) . " mxn</div>";
            print '</div>'; // Cierra contenedor de productos
        }
        ?>
    </section>
    <footer>
        <p>leaf&copy;</p>
    </footer>

    <script type="text/javascript">
        let carro = document.querySelector("#productos")

        if (carro != null) {
            carro.scrollIntoView({
                beahvior: "smooth",
                block: "center"
            })
        }
    </script>
</body>

</html>