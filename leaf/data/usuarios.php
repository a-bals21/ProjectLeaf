<?php
require_once __DIR__.'/conexionbd.php';

class Usuario {
    public $username;
    public $password;
    public $tipo_usuario;

    function __construct($username, $password, $tipo_usuario)
    {
        $this->username = $username;
        $this->password = $password;
        $this->tipo_usuario = $tipo_usuario;
    }
}

class Cliente {
    public $id;
    public $nombres;
    public $apellidos;
    public $sexo;
    public $direccion;
    public $email;
    public $username;

    function __construct(
        $id,
        $nombres,
        $apellidos,
        $sexo,
        $direccion,
        $email,
        $username
    )
    {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->sexo = $sexo;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->username = $username;
    }
}

class Administrador {
    public $clave;
    public $nombres;
    public $apellidos;
    public $username;

    function __construct(
        $clave,
        $nombres,
        $username
    )
    {
        $this->clave = $clave;
        $this->nombres = $nombres;
        $this->username = $username;
    }
}

const PAGE_SIZE = 10;

function obtenerUsuarios(int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $usuarios = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Usuario limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $usuarios[] = crearUsuario($fila);
        }
    }

    return $usuarios;
}

function obtenerCliente(string $username): Cliente | null
{
    $cliente = null;
    $db = new Conexion();

    $result = $db->conexion->query("select * from Cliente where username = '$username'");

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();

        $cliente = crearCliente($fila);
    }

    return $cliente;
}

function obtenerClienteID(string $username): int
{
    $id = -1;
    $db = new Conexion();

    $result = $db->conexion->query("select ID from Cliente where username = '$username'");

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();

        $id = $fila['ID'];
    }

    return $id;
}

function obtenerClienteGensFav(string $id): array
{
    $generos = array();
    $db = new Conexion();

    $result = $db->conexion->query("select * from ClienteGensFav where id = '$id'");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $generos[] = $fila['genero'];
        }
    }

    return $generos;
}

function mostrarUsuario(Usuario $usuario) {
    echo "<div>" . $usuario->username . "</div>";
    echo "<div>" . $usuario->tipo_usuario . "</div>";
}

function mostrarCliente(Cliente $cliente) {
    echo "<div>ID: " . $cliente->id . "</div>";
    echo "<div>Nombre de usuario: " . $cliente->username . "</div>";
    echo "<div>Nombre Completo: " . $cliente->nombres . " " . $cliente->apellidos . "</div>";
    echo "<div>Sexo: " . $cliente->sexo . "</div>";
    echo "<div>Domicilio: " . $cliente->direccion . "</div>";
    echo "<div>Correo: " . $cliente->email . "</div>";
}

function crearUsuario(array $data): Usuario | null
{
    $usuario = null;

    $usuario = new Usuario(
        $data["username"],
        $data["password"],
        $data["tipo_usuario"]
    );

    return $usuario;
}



function crearCliente(array $data): Cliente | null
{
    $cliente = null;

    $cliente = new Cliente(
        $data["ID"],
        $data["nombres"],
        $data["apellidos"],
        $data["sexo"],
        $data["direccion"],
        $data["email"],
        $data["username"],
    );

    return $cliente;
}

?>