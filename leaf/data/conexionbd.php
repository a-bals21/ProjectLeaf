<?php
class Conexion
{
    public const HOST = "localhost";
    public const USER = "id21579331_leaf";
    public const PASSWORD = "Proyectoleaf#2023";
    public const DB_NAME = "id21579331_dbleaf";
    public mysqli $conexion;

    function __construct()
    {
        $this->conexion = mysqli_connect(
            $this::HOST,
            $this::USER,
            $this::PASSWORD,
            $this::DB_NAME
        ) or die($this->conexion->error);
    }

    function __destruct()
    {
        $this->conexion->close();
    }

    public function cerrar()
    {
        $this->conexion->close();
    }
}
