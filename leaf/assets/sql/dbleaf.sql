create database if not exists bdLeaf;

use bdLeaf;

-- ENTIDADES --

CREATE TABLE Usuario(
    username VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('cliente', 'admin') default 'cliente' NOT NULL,
    primary key(username)
);

CREATE TABLE Cliente(
    ID INT unsigned AUTO_INCREMENT,
    nombres VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    sexo CHAR NOT NULL,
    direccion text NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255),
    primary key (ID),
    foreign key(username) references Usuario(username) on update cascade on delete cascade
) engine = innodb;

-- Campos multivalor para Cliente
-- Generos favoritos
CREATE TABLE ClienteGensFav (
    ID INT unsigned,
    genero VARCHAR(255),
    primary key(ID, genero),
    foreign key(ID) references Cliente(ID) on update cascade on delete cascade
) engine = innodb;
-- -------------------------------

CREATE TABLE Administrador(
    CLAVE VARCHAR(255),
    nombres VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    username VARCHAR(255),
    primary key(CLAVE),
    foreign key(username) references Usuario(username) on update cascade on delete cascade
) engine = innodb;

CREATE TABLE Producto(
    ID INT unsigned AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    imagen TEXT NOT NULL, -- direccion de la imagen
    categoria ENUM('S/C', 'libro', 'juego', 'papelería', 'audiolibro', 'ebook') default 'S/C' NOT NULL,
    stock INT unsigned NOT NULL default 0,
    primary key (ID)
);

create table Oferta(
    ID INT unsigned AUTO_INCREMENT,
    precio_oferta FLOAT(10,2) NOT NULL,
    fecha_expiracion DATE NOT NULL,
    producto INT unsigned,
    primary key(ID),
    foreign key(producto) references Producto(ID) on update cascade on delete cascade
) engine = innodb;

-- Notificacion hacia el estado de un Producto
CREATE TABLE Notificacion(
    ID INT unsigned AUTO_INCREMENT,
    mensaje VARCHAR(255),
    producto INT unsigned,
    primary key(ID),
    foreign key(producto) references Producto(ID) on update cascade on delete cascade
) engine = innodb;

CREATE TABLE Compra(
    ID INT unsigned AUTO_INCREMENT,
    fecha_compra DATE NOT NULL, -- El formato es AAAA-MM-DD
    total FLOAT(10, 4) NOT NULL,
    de_cliente INT unsigned,
    primary key(ID),
    foreign key(de_cliente) references Cliente(ID) on update cascade on delete cascade
) engine = innodb;

-- 3FN para columnas de Libro
create table Editorial(
    ID INT unsigned AUTO_INCREMENT,
    nombre VARCHAR(250) NOT NULL,
    primary key(ID)
);
-- --------------------------

CREATE TABLE Libro(
    ISBN VARCHAR(255),
    año_publicado YEAR NOT NULL,
    genero ENUM('S/G', 'horror', 'romance', 'drama/misterio', 'comic/manga', 'accion/aventura', 'ciencia ficción/fantasía') default 'S/G' NOT NULL,
    editorial INT unsigned,
    ID_producto INT unsigned,
    primary key(ISBN),
    foreign key(editorial) references Editorial(ID) on update cascade on delete cascade,
    foreign key(ID_producto) references Producto(ID) on update cascade on delete cascade
) engine = innodb;

-- 3FN para tabla AutorLibro
create table Autor(
    ID INT unsigned AUTO_INCREMENT,
    nombres VARCHAR(250) not null,
    apellidos VARCHAR(250) not null,
    primary key(ID)
);
-- ----------------------------

-- Relaciones entre tablas - Muchos a Muchos
-- Autor o autores de los libros
create table LibroAutor(
    ISBN VARCHAR(255),
    autor INT unsigned,
    primary key (ISBN, autor),
    foreign key(ISBN) references Libro(ISBN) on update cascade on delete cascade,
    foreign key(autor) references Autor(ID)on update cascade on delete cascade
) engine = innodb;

-- Relacion de productos que contiene una compra
create table DetalleCompra(
    compra INT unsigned,
    producto INT unsigned,
    primary key(compra, producto),
    foreign key(compra) references Compra(ID) on update cascade on delete cascade,
    foreign key(producto) references Producto(ID) on update cascade on delete cascade
) engine = innodb;

-- Suscripcion a productos de los clientes (lista de favoritos)
CREATE TABLE Suscripcion(
    cliente INT unsigned,
    producto INT unsigned,
    primary key(cliente, producto),
    foreign key(cliente) references Cliente(ID) on update cascade on delete cascade,
    foreign key(producto) references Producto(ID) on update cascade on delete cascade
) engine = innodb;
