<?php
require __DIR__.'/data/conexionbd.php';
if(session_status() != PHP_SESSION_ACTIVE) session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $db = new Conexion();

    $result = $db->conexion->query(
        "select * from Usuario where username ='$username'"
    );

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tipo_usuario = $row['tipo_usuario'];

        if (password_verify($_SESSION['password'], $row['password'])) {
            if ($tipo_usuario == 'admin') {
                header("Location: /panel_admin/panel.php");
            } else {
                header("Location: /panel_cliente/panel.php");
            }
        } else {
            header("Location: /inicio_sesion.php?err=2");
        }
    } else {
        header("Location: /inicio_sesion.php?err=1");
    }
} else {
    header("Location: /inicio_sesion.php");
}
?>