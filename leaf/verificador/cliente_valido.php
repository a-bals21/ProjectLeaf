<?php
require_once __DIR__.'/../data/conexionbd.php';

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];

    $db = new Conexion();

    $result = $db->conexion->query(
        "select * from Usuario where username ='$username'"
    );

    $row = $result->fetch_assoc();

    if ($result->num_rows <= 0 || !password_verify($_SESSION['password'], $row['password'])) {
        if ($row['tipo_usuario'] != 'cliente') header("Location: https://librerialeaf.000webhostapp.com/inicio_sesion.php");
    }
} else {
    header("Location: https://librerialeaf.000webhostapp.com/inicio_sesion.php");
}
