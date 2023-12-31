<?php
include __DIR__.'/../data/productos.php';

if(session_status() != PHP_SESSION_ACTIVE) session_start();

function hayProductoEnCarrito( int $producto_id ) {
    $carrito = $_SESSION['carrito'];

    if (isset($carrito[$producto_id])) {
        return true;
    }

    return false;
}

$producto_id = $_GET['id'];

// Decrementa la cantidad del producto
if (hayProductoEnCarrito($producto_id)) {
    if ($_SESSION['carrito'][$producto_id] > 1) {
        $_SESSION['carrito'][$producto_id] -= 1;
    } else {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// TODO: MOSTRAR PRODUCTO Y CARRITO CON FINES DE DESARROLLO
$usuario = obtenerProducto( $producto_id );

$info = array(
    "Agregando a '$usuario->nombre' al carrito",
    "Carrito:".json_encode($_SESSION['carrito'])
);

print json_encode($info);
?>
