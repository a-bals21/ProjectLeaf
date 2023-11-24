<?php
// CLASE SIMULANDO CONEXION A BASE DE DATOS
class Productos
{
    // ARREGLO SIMULANDO UNA BASE DE DATOS
    private array $PRODUCTOS;

    public function __construct()
    {
        // ID;NOMBRE;PRECIO;STOCK;DIR_IMAGE
        $this->PRODUCTOS = array(
            "1;Tableta Gráfica;12000;20;https://th.bing.com/th/id/OIP.v_hrIml7SjN_467iSw3tvQHaHa?pid=ImgDet&rs=1",
            '2;Monitor Ghia 19.5";8000;20;https://www.cyberpuerta.mx/img/product/M/CP-GHIA-MNLG-23-1.jpg',
            '3;Monitor Gamer Acer Nitro 23.8" 165Hz;4100;20;https://m.media-amazon.com/images/I/71yo3bmyBnL._AC_SX355_.jpg',
            "4;SSD Kingston Fury Renegade, 1TB;8000;1229;https://www.cyberpuerta.mx/img/product/M/CP-KINGSTON-SFYRS1000G-8c9247.jpg",
            "5;Tarjeta de Video Gigabyte NVIDIA Geforce GTX 1650;2559;20;https://www.cyberpuerta.mx/img/product/M/CP-MSI-GTX1650D6VENTUSXSOCV1-1.jpg",
            "6;SSD Kingston NV2 4TB;3809;20;https://www.cyberpuerta.mx/img/product/M/CP-KINGSTON-SNV2S4000G-d0ed28.jpg"
        );
    }

    public function obtenerProductos(): array
    {
        return $this->PRODUCTOS;
    }

    public function obtenerProducto(int $id): string
    {
        return $this->PRODUCTOS[$id-1];
    }
}

abstract class IProducto
{
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $image;

    public function __construct($id, $name, $price, $quantity, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
    }
}

class Producto extends IProducto
{
}

function obtenerProductos()
{
    $DB_CONN = new Productos();
    $productos = array();

    foreach ($DB_CONN->obtenerProductos() as $key => $value) {
        $data = explode(";", $value);
        $productos[] = new Producto(
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4]
        );
    }

    return $productos;
}

function obtenerProducto(int $id)
{
    $DB_CONN = new Productos();

    $data = explode(";", $DB_CONN->obtenerProducto($id));
    $producto = new Producto(
        $data[0],
        $data[1],
        $data[2],
        $data[3],
        $data[4]
    );

    return $producto;
}

function mostrarProducto(Producto $producto)
{
    setlocale(LC_MONETARY, 'es_MX');

    print '<div class="imagen-producto"><img src="' . $producto->image . '" alt="imgProducto"></div>';
    print "<div class='nombre-producto' title='" . $producto->name . "'>" . $producto->name . "</div>";
    print '<div class="precio-producto"><p>$' . number_format(floatval($producto->price), 2) . " mxn</p></div>";
}

function mostrarProductoCarrito(Producto $producto)
{
    mostrarProducto($producto);
    print '<div class="cantidad-producto"><p>' . $producto->quantity . "</p></div>";
}