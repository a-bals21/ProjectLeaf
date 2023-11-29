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
                    <legend for="tipo de producto">tipo de producto</legend>
                    <input type="radio" name="libro" id="libro">libro
                    <input type="radio" name="otro" id="otro">otro producto
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