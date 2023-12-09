<?php
require __DIR__ . "/conexionbd.php";

$db = new Conexion();

$nombre = $_POST['nombre'];

$result = $db->conexion->query("select * from Editorial where nombre='$nombre'");

if ($result->num_rows > 0) {
    header('Location: ./../panel_admin/add_editorial.php?err=1');
} else {
    $db->conexion->query("insert into Editorial(nombre) values ('$nombre')");
    header('Location: ./../panel_admin/add_editorial.php?err=0');
}
