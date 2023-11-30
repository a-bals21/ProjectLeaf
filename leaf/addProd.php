<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>subir producto</title>
    </head>

    <body>  <!--permite hacer el registro de los productos-->
        <section>
            <form action="" method="post">
            <fieldset>
                    <label for="productos">Selecciona un tipo de producto</label>
                    <select name=producto id="producto">
                        <optio value="S/C"></option>
                        <optio value="libro"></option>
                        <optio value="juego"></option>
                        <optio value="papelería"></option>
                        <optio value="audioLibro"></option>
                        <optio value="ebook"></option>
                    </select>
            </fieldset>

            <fieldset>
                    <label for="generosLiterarios">Selecciona un tipo de producto</label>
                    <select name=gerero id="genero">
                        <optio value="S/G"></option>
                        <optio value="horror"></option>
                        <optio value="romance"></option>
                        <optio value="drama/misterio"></option>
                        <optio value="comic/manga"></option>
                        <optio value="accion/aventura"></option>
                        <optio value="ciencia ficción/fantasía"></option>
                    </select>
                </fieldset>

                <fieldset>
                    <label for="ISBN">ingrese el ISBN</label><br>
                    <input type="text" id="ISBN" name="ISBN">
                </fieldset>

                <fieldset>
                    <label for="titulo"> titulo de libro</label><br>
                    <input type="text" name="titulo">
                </fieldset>

                <fieldset>
                    <label for="precio"> precio del producto</label><br>
                    <input type="number" id="precio" name="precio" min="0">
                </fieldset>

                <fieldset>
                    <label for="autor"> autor del libro</label><br>
                    <input type="text" id="autor" name="autor">
                </fieldset>

                <fieldset>
                    <label for="descripcion">descripcion del producto</label>
                    <input name="textarea" cols="30" rows="10">Escriba aquí</textarea>
                </fieldset>
                
                <fieldset>
                    <label for="nombre">Nombre del producto</label><br>
                    <input type="text" id="nombre" name="nombre">
                </fieldset>

                <fieldset>
                    <label for="imagen">foto del producto</label><br>
                    <input type="file" name="immagen">
                </fieldset>

                <fieldset>
                    <label for="stock">número de productos disponibles</label><br>
                    <input type="number" id="stock" name="stock">
                </fieldset>

                    <input type="submit" value="publicar">
                    <input type="reset" value="cancelar">
            </form>
        </section>    
    </body>
</html>