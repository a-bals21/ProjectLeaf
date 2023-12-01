<?php
require './conexionbd.php';

class Producto
{
    public $id;
    public $nombre;
    public $precio;
    public $descripcion;
    public $imagen;
    public $categoria;
    public $cantidad;

    public function __construct(
        $id,
        $nombre,
        $precio,
        $descripcion,
        $imagen,
        $categoria,
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->categoria = $categoria;
        $this->cantidad = 0;
    }
}

class Libro
{
    public $ISBN;
    public $year;
    public $genero;
    public $editorial;
    public $autores;
    public $id_producto;

    public function __construct(
        $ISBN,
        $year,
        $genero,
        $editorial,
        $id_producto
    ) {
        $this->ISBN = $ISBN;
        $this->year = $year;
        $this->genero = $genero;
        $this->editorial = $editorial;
        $this->id_producto = $id_producto;
    }
}

const PAGE_SIZE = 40;

function obtenerProductos(int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $productos = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Producto limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $productos[] = crearProducto($fila);
        }
    }

    return $productos;
}

/**
 * Devuelve un arreglo con los productos que en su titulo contenga la cadena dada
 */
function obtenerProductosPorTitulo(string $word, int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $productos = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Producto where nombre like '%$word%' limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $productos[] = crearProducto($fila);
        }
    }

    return $productos;
}

function obtenerStockProducto(int $id): int
{
    $stock = -1;
    $db = new Conexion();

    $result = $db->conexion->query("select stock from Producto where ID = $id");

    if ($result->num_rows > 0) {
        $fila = $result->fetch_array();

        $stock = $fila["stock"];
    }

    return $stock;
}

function obtenerProducto(int $id): Producto | null
{
    $producto = null;
    $db = new Conexion();

    $result = $db->conexion->query("select * from Producto where ID = $id");

    if ($result->num_rows > 0) {
        $fila = $result->fetch_array();

        $producto = crearProducto($fila);
    }

    return $producto;
}

function obtenerLibros(int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $libros = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Libro limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $libro = crearLibro($fila);
            if ($libro != null) $libro->autores = obtenerAutores($libro->ISBN);

            $libros[] = $libro;
        }
    }

    return $libros;
}

function obtenerLibrosPorGenero(string $genero, int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $libros = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Libro where genero = '$genero' limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $libro = crearLibro($fila);
            if ($libro != null) $libro->autores = obtenerAutores($libro->ISBN);

            $libros[] = $libro;
        }
    }

    return $libros;
}

function obtenerLibrosPorTitulo(string $titulo, int $page_number = 1, int $page_size = PAGE_SIZE): array
{
    $libros = array();
    $db = new Conexion();

    $page_offset = ($page_number - 1) * $page_size;

    $result = $db->conexion->query("select * from Producto where name like '%$titulo%' and tipo_producto = 'libro' limit $page_size offset $page_offset");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $libro = crearLibro($fila);
            if ($libro != null) $libro->autores = obtenerAutores($libro->ISBN);

            $libros[] = $libro;
        }
    }

    return $libros;
}

function obtenerLibro(string $ISBN): Libro | null
{
    $libro = null;
    $db = new Conexion();

    $result = $db->conexion->query("select * from Libro where ISBN = '$ISBN'");

    // Obtencion del libro
    if ($result->num_rows > 0) {
        $data = $result->fetch_array();

        $libro = crearLibro($data);
    }

    if ($libro != null) $libro->autores = obtenerAutores($libro->ISBN);


    return $libro;
}

function obtenerLibroPorID(int $id): Libro | null
{
    $libro = null;
    $db = new Conexion();

    $result = $db->conexion->query("select * from Libro where ID_producto = $id");

    // Obtener Libro
    if ($result->num_rows > 0) {
        $data = $result->fetch_array();

        $libro = crearLibro($data);
    }

    if ($libro != null) $libro->autores = obtenerAutores($libro->ISBN);

    return $libro;
}

function obtenerAutores(string $ISBN): array
{
    $autores = array();
    $db = new Conexion();

    $result = $db->conexion->query("select autor from LibroAutor where ISBN = '$ISBN' inner join Autor on LibroAutor.autor = Autor.ID");

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $autores[] = $fila["nombres"] . " " . $fila["apellidos"];
        }
    }

    return $autores;
}

function mostrarProducto(Producto $producto, string $ruta_raiz)
{
    setlocale(LC_MONETARY, 'es_MX');

    print '<div class="imagen-producto"><img src="' . $ruta_raiz . $producto->imagen . '" alt="imgProducto"></div>';
    print "<div class='nombre-producto' title='" . $producto->nombre . "'>" . $producto->nombre . "</div>";
    print '<div class="precio-producto"><p>$' . number_format(floatval($producto->precio), 2) . " mxn</p></div>";
}

function mostrarProductoCarrito(Producto $producto, string $ruta_raiz)
{
    mostrarProducto($producto, $ruta_raiz);
    print '<div class="cantidad-producto"><p>' . $producto->cantidad . "</p></div>";
}

function crearProducto(array $data): Producto | null
{
    $producto = null;

    $producto = new Producto(
        $data["ID"],
        $data["nombre"],
        $data["precio"],
        $data["descripcion"],
        $data["imagen"],
        $data["categoria"]
    );

    return $producto;
}

function crearLibro(array $data): Libro | null
{
    $libro = null;

    $libro = new Libro(
        $data["ISBN"],
        $data["año_publicado"],
        $data["genero"],
        $data["editorial"],
        $data["ID_producto"]
    );

    return $libro;
}
