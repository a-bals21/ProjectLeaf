<?php
require_once __DIR__ . '/conexionbd.php';
require_once __DIR__ . '/usuarios.php';

if (session_status() != PHP_SESSION_ACTIVE) session_start();

$user_a = $_SESSION['username'];
$username = $_POST['username'];
$password = $_POST['password'];

$db = new Conexion();

$result = $db->conexion->query("select * from Usuario where username='$user_a'");
$fila = $result->fetch_assoc();

if (password_verify($password, $fila['password'])) {
    if ($user_a != $username) {
        $result = $db->conexion->query("select * from Usuario where username='$username'");
        
        if ($result->num_rows > 0) {
            // Verificar disponibilidad del nuevo nombre de usuario
            header('Location: ./../panel_cliente/editar_usuario.php?err=2');
        }
    } 
} else {
    // Verificar contraseña de cliente
    header('Location: ./../panel_cliente/editar_usuario.php?err=1');
}

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$sexo = $_POST['sexo'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];

$db = new Conexion();

// Actualizar usuario y cliente
$db->conexion->query("update Usuario set username='$username' where username='$user_a'");
$db->conexion->query("update Cliente set nombres='$nombres', apellidos='$apellidos', sexo='$sexo', direccion='$direccion', email='$email', username='$username' where username='$user_a'");

// Actualizar los generos favoritos del cliente
$id = obtenerClienteID($username);
$query = "delete from ClienteGensFav where ID = '$id'";
$db->conexion->query($query);

$generos = array("romance", "horror", "drama-misterio", "comic-manga", "accion-aventura", "cf-fantasia");

foreach ($generos as $gen) {
    if (isset($_POST[$gen])) {
        if ($_POST[$gen] == 'on') {
            $query = "INSERT INTO ClienteGensFav VALUES ('$id', '$gen');";
            $db->conexion->query($query);
        }
    }
}

// Actualizar nombre de usuario de la sesion
$_SESSION['username'] = $username;

header('Location: ./../panel_cliente/panel.php');
