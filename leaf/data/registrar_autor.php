<?php
require __DIR__ . "/conexionbd.php";

$db = new Conexion();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

$result = $db->conexion->query("select * from Autor where nombres='$nombre' AND apellidos ='$apellido'");

if ($result->num_rows > 0) {
    header('Location: ./../panel_admin/add_autor.php?err=1');
} else {
    $db->conexion->query("insert into Autor(nombres, apellidos) values ('$nombre', '$apellido')");
    header('Location: ./../panel_admin/add_autor.php?err=0');
}
