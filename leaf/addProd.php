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
                    <label for="imagen">Sube una imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </fieldset>
                    <input type="text" name="titulo">
                    <input type="number" id="tentacles" name="tentacles" min="0">
                <fieldset>
                    <legend>Descripcion</legend>
                    <textarea name="textarea" cols="30" rows="10">Escriba aquí</textarea>
                </fieldset>
                
                    <input type="submit" value="publicar">
                    <input type="reset" value="cancelar">
            </form>
        </section>    
    </body>
</html>