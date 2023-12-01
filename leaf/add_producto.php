<?php
require __DIR__ . "/comprobadores/usuario_valido.php";

if (isset($_SESSION['usertype'])) {
    $usertype = $_SESSION['usertype'];
    if ($usertype != 'admin') header("Location: " . __DIR__ . "/../index.php");
} else {
    header("Location: " . __DIR__ . "/../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>subir producto</title>
</head>

<body> <!--permite hacer el registro de los productos-->
    <section>
        <header>
            <h2>Registro de producto</h2>
        </header>
        <form action="#" method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="nombre">Nombre/Titulo:</label><br>
                <input type="text" id="nombre" name="nombre" required>
            </fieldset>
            <fieldset>
                <label for="precio">Precio:</label><br>
                <input type="number" id="precio" name="precio" min="0" required>
            </fieldset>
            <fieldset>
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" cols="30" rows="10">Escriba aquí</textarea>
            </fieldset>
            <fieldset>
                <label for="imagen">Imagen:</label><br>
                <input type="file" name="imagen" id="imagen" required>
            </fieldset>
            <fieldset>
                <label for="stock">Stock:</label><br>
                <input type="number" id="stock" name="stock" min="0" required>
            </fieldset>
            <fieldset>
                <label for="tipo-producto">Selecciona su categoría</label>
                <select name="tipo-producto" id="tipo-producto">
                    <option value="S/C" selected>Sin categoría</option>
                    <option value="libro"></option>
                    <option value="juego"></option>
                    <option value="papelería"></option>
                    <option value="audioLibro"></option>
                    <option value="ebook"></option>
                </select>
            </fieldset>
            <fieldset id="info-libro">
                <legend>Información sobre el libro:</legend>
                <fieldset>
                    <label for="ISBN">ISBN del libro</label><br>
                    <input type="text" id="ISBN" name="ISBN" required>
                </fieldset>
                <fieldset>
                    <label for="publicado">Año de publicacion</label>
                    <input type="number" name="publicado" id="publicado" min="0" required>
                </fieldset>
                <fieldset>
                    <label for="autor">Autor/Autores del libro:</label><br>
                    <input type="text" id="autor" name="autor" required>
                    <span class="note">Si es más de uno separalos con comas</span>
                </fieldset>
                <fieldset>
                    <label for="autor">Editorial del libro:</label><br>
                    <!-- Cambiar las opciones por un combobox obtenido de la base de datos -->
                    <input type="text" id="autor" name="autor" required>
                </fieldset>
                <fieldset>
                    <label for="genero-literario">Género:</label>
                    <select name="genero-literario" id="genero-literario">
                        <option value="S/G" selected>Sin genero</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                        <option value="drama/misterio">Drama/Misterio</option>
                        <option value="comic/manga">Comic/manga</option>
                        <option value="accion/aventura">Accion/Aventura</option>
                        <option value="ciencia ficción/fantasía">Ciencia Ficcion / Fantasía</option>
                    </select>
                </fieldset>
            </fieldset>
            <input type="submit" value="Registrar">
            <input type="reset" value="cancelar">
        </form>
    </section>

    <script>
        let campoFecha = document.querySelector("input#publicado");

        if (campoFecha != null) {
            campoFecha.max = (new Date()).getFullYear;
        }
    </script>
</body>

</html>