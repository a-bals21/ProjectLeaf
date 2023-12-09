<?php

require_once __DIR__ . '/../data/conexionbd.php';
$db = new Conexion();

// Información del producto
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$imagen = "assets/img/" . $_FILES['imagen']['name'];
$stock = $_POST['stock'];
$categoria = $_POST['tipo-producto'];

$file_parts = explode(".", $imagen);
$file_extension = strtolower(end($file_parts));

if ($file_extension == 'php') {
    header('Location: ./../panel_admin/add_producto.php?err=9');
}

move_uploaded_file($_FILES['imagen']['tmp_name'], "./../".$imagen);

$db->conexion->query("insert into "
    . "Producto (nombre, precio, descripcion, imagen, categoria, stock) "
    . "values ('$nombre',$precio,'$descripcion','$imagen','$categoria',$stock)");

if ($categoria == 'libro') {
    $id_producto = -1;
    $ISBN = $_POST['isbn'];
    $year = $_POST['publicado'];
    $editorial = $_POST['editorial'];
    $genero = $_POST['genero-literario'];

    // Obtener ID del producto
    $result = $db->conexion->query("select * from Producto "
        . "where nombre = '$nombre' AND precio = $precio AND descripcion = '$descripcion' "
        . "AND imagen = '$imagen' AND categoria = '$categoria' AND stock = $stock");

    if ($result->num_rows > 0) {
        $id_producto = $result->fetch_assoc()['ID'];
    }

    $db->conexion->query("insert into Libro "
        . "values ('$ISBN', $year, '$genero', '$editorial', $id_producto)");
}

header('Location: ./../panel_admin/add_producto.php?err=0');


