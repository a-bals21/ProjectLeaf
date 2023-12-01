<?php
require './../data/conexionbd.php';

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];

    $db = new Conexion();

    $result = $db->conexion->query(
        "select * from Usuario where username ='$username'"
    );

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usertype = $row['usertype'];

        if (password_verify($_SESSION['password'], $row['password'])) {
            if ($usertype == 'admin') {
                header("Location: ./../panel_admin/panel.php");
            } else {
                header("Location: ./../panel_cliente/panel.php");
            }
        } else {
            header("Location: ./../inicio_sesion.php?err=2");
        }
    } else {
        header("Location: ./../inicio_sesion.php?err=1");
    }
}

header("Location: ./../inicio_sesion.php");
