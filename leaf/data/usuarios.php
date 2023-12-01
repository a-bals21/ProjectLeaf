<?php
require './conexionbd.php';

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


?>