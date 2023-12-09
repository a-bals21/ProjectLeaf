<?php
require_once __DIR__ . '/conexionbd.php';
require_once __DIR__ . '/usuarios.php';

if (session_status() != PHP_SESSION_ACTIVE) session_start();

$username = $_SESSION['username'];
$newpassword = $_POST['newpassword'];
$password = $_POST['password'];

$db = new Conexion();

// Verificar contraseña de usuario
$result = $db->conexion->query("select * from Usuario where username='$username'");
$fila = $result->fetch_assoc();

if (password_verify($password, $fila['password'])) {
    $password_h = password_hash($newpassword, PASSWORD_DEFAULT);
    
    // Actualizar contraseña del usuario
    $db->conexion->query("update Usuario set password='$password_h' where username='$username'");
    
    // Actualizar la contraseña de la sesion
    $_SESSION['password'] = $newpassword;
    
    
    header('Location: ./../panel_cliente/panel.php');
} else {
    header('Location: ./../panel_cliente/editar_password.php?err=1');
}
