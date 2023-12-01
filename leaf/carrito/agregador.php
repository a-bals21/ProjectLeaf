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

// Aumenta la cantidad del producto, sino existe lo inicia
if (hayProductoEnCarrito($producto_id)) {
    $_SESSION['carrito'][$producto_id] += 1;
} else {
    $_SESSION['carrito'][$producto_id] = 1;
}

// TODO: MOSTRAR PRODUCTO Y CARRITO CON FINES DE DESARROLLO
$producto = obtenerProducto( $producto_id );

$info = array(
    "Agregando a '$producto->nombre' al carrito",
    "Carrito:".json_encode($_SESSION['carrito'])
);

print json_encode($info);
?>