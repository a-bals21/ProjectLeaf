<?php
require __DIR__.'/../data/conexionbd.php';

$db = new Conexion();
$username = $_GET['username'];
$estaDisponible = true;

$result = $db->conexion->query("select * from Usuario where username = '$username'");

if ($result->num_rows > 0) {
    $estaDisponible = false;
}

printf(json_encode(array("disponible" => $estaDisponible)));
?>
