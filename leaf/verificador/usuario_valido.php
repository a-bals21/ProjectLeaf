<?php
require __DIR__ . '/../data/conexionbd.php';

session_start();

$esValido = false;

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $db = new Conexion();

    $result = $db->conexion->query(
        "select * from Usuario where username ='$username' and password = '$password'"
    );

    if ($result->num_rows <= 0) header("Location: " . __DIR__ . "/../index.php");
} else {
    header("Location: " . __DIR__ . "/../index.php");
}
