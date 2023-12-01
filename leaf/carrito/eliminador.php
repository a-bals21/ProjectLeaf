<?php
include __DIR__.'/../data/productos.php';

session_start();

function hayProductoEnCarrito( int $producto_id ) {
    $carrito = $_SESSION['carrito'];

    if (isset($carrito[$producto_id])) {
        return true;
    }

    return false;
}

$producto_id = $_GET['id'];

if (hayProductoEnCarrito($producto_id)) {
    unset($_SESSION['carrito'][$producto_id]);
}

// TODO: MOSTRAR PRODUCTO Y CARRITO CON FINES DE DESARROLLO
$producto = obtenerProducto( $producto_id );

$info = array(
    "Agregando a '$producto->nombre' al carrito",
    "Carrito:".json_encode($_SESSION['carrito'])
);

print json_encode($info);
?>
