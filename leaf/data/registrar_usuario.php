<?php
require_once __DIR__ . '/conexionbd.php';

$username = $_POST['username'];
$password = $_POST['password'];
$password = password_hash($password, PASSWORD_DEFAULT);
$tipo_usuario = 'cliente';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$sexo = $_POST['sexo'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];

$db = new Conexion();

$db->conexion->query("INSERT INTO Usuario VALUES ('$username', '$password', '$tipo_usuario')");
$db->conexion->query("INSERT INTO Cliente(nombres, apellidos, sexo, direccion, email, username) VALUES ('$nombres', '$apellidos', '$sexo', '$direccion', '$email', '$username')");

header('Location: ./../inicio_sesion.php');
