drop procedure if exists obtenerUsuario;
drop procedure if exists obtenerAutores;

delimiter //

create procedure obtenerProductos(in page_size integer, in page_offset integer)
begin
    select * from Producto
    limit page_size
    offset page_offset;
end //

create procedure obtenerAutores(in this_isbn varchar(255))
begin
    select (autor) from LibroAutor
    where ISBN = this_isbn
    inner join Autor on LibroAutor.autor = Autor.ID;
end //

delimiter ;