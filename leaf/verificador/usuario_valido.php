<?php
require './../data/conexionbd.php';

$esValido = true;

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];

    $db = new Conexion();

    $result = $db->conexion->query(
        "select * from Usuario where username ='$username'"
    );

    $row = $result->fetch_assoc();

    if ($result->num_rows > 0
        && password_verify($_SESSION['password'], $row['password'])
    ) {
        if ($_GET["u"] == 'c') {
            if ($row['usertype'] != 'cliente') $esValido = false;
        } else {
            if ($row['usertype'] != 'admin') $esValido = false;
        }
    } else {
        $esValido = false;
    }
} else {
    $esValido = false;
}

if (!$esValido) {
    header("Location: ./../index.php");
}
