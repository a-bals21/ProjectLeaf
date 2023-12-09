<?php
require_once __DIR__ . '/conexionbd.php';
require_once __DIR__ . '/usuarios.php';

$username = $_POST['username'];
$password = $_POST['password'];

$db = new Conexion();

// Verificar disponibilidad del nuevo nombre de usuario
$result = $db->conexion->query("select * from Usuario where username='$username'");

if ($result->num_rows > 0) {
header('Location: ./../registro_usuario.php?err=1');
}

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

$id = obtenerClienteID($username);

$generos = array("romance", "horror", "drama-misterio", "comic-manga", "accion-aventura", "cf-fantasia");

foreach ($generos as $gen) {
    if (isset($_POST[$gen])) {
        if ($_POST[$gen] == 'on') {
            $query = "INSERT INTO ClienteGensFav VALUES ('$id', '$gen');";
            $db->conexion->query($query);
        }
    }
}

header('Location: ./../inicio_sesion.php');
