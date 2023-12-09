<?php
require './../verificador/admin_valido.php';
require_once './conexionbd.php';

$username = $_GET['username'];

$db = new Conexion();

$db->conexion->query("delete from Usuario where username='$username'");
?>