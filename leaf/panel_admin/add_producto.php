<?php
require __DIR__ . "/../verificador/admin_valido.php";
require __DIR__ . '/../data/productos.php';

if (session_status() != PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Admin</title>

    <link rel="stylesheet" href="./../css/normalize.css">
    <link rel="stylesheet" href="./../css/main_style.css">
</head>

<body>
    <header>
        <div class="header">
            <div>
                <a href="./../index.php">
                    <picture>
                        <img src="./../assets/img/leaf.svg" width="40vw" alt="logo_leaf">
                    </picture>
                </a>
                <a href="./../index.php">leaf</a>
            </div>
            <div>
                <nav>
                    <a href="./panel.php">Panel</a>
                    <a href="./../cerrar_sesion.php">Desloguear</a>
                </nav>
            </div>
        </div>
    </header>
    <section>
        <header>
            <div>
                <h2>Panel - Administrador</h2>
            </div>
            <nav>
                <a href="./panel.php">Volver</a>
            </nav>
        </header>
        <h3>Registrar producto</h3>
        <?php
        if (isset($_GET['err'])) {
            $err = $_GET['err'];
            
            if ($err = 0) {
                echo '<div class="nota">El producto ha sido registrado!</div>';
            }
        }
        ?>
        <form action="./../data/registrar_producto.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="nombre">Nombre/Titulo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </fieldset>
            <fieldset>
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" min="0" required>
            </fieldset>
            <fieldset>
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" cols="30" rows="10" placeholder="Escriba aquí" required></textarea>
            </fieldset>
            <fieldset>
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
            </fieldset>
            <fieldset>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" min="0" required>
            </fieldset>
            <fieldset>
                <label for="tipo-producto">Selecciona su categoría</label>
                <select name="tipo-producto" id="tipo-producto">
                    <option value="s-c" selected>Sin categoría</option>
                    <option value="libro">Libro</option>
                    <option value="juego">Juego</option>
                    <option value="papeleria">Papelería</option>
                    <option value="audioLibro">Audiolibro</option>
                    <option value="ebook">Ebook</option>
                </select>
            </fieldset>
            <fieldset id="info-libro" disabled>
                <legend>Información sobre el libro:</legend>
                <fieldset>
                    <label for="isbn">ISBN del libro</label>
                    <input type="text" id="isbn" name="isbn" required>
                </fieldset>
                <fieldset>
                    <label for="publicado">Año de publicacion</label>
                    <input type="number" name="publicado" id="publicado" min="0" required>
                </fieldset>
                <fieldset>
                    <label for="autor">Autor/Autores del libro:</label>
                    <select name="autor" id="autor">
                        <?php
                        $autores = obtenerAutores();

                        foreach ($autores as $key => $value) {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset>
                    <label for="editorial">Editorial del libro:</label>
                    <select name="editorial" id="editorial">
                        <?php
                        $editoriales = obtenerEditoriales();

                        foreach ($editoriales as $key => $value) {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset>
                    <label for="genero-literario">Género:</label>
                    <select name="genero-literario" id="genero-literario">
                        <option value="s-g" selected>Sin genero</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                        <option value="drama-misterio">Drama/Misterio</option>
                        <option value="comic-manga">Comic/manga</option>
                        <option value="accion-aventura">Accion/Aventura</option>
                        <option value="cf-fantasia">Ciencia Ficcion / Fantasía</option>
                    </select>
                </fieldset>
            </fieldset>
            <input type="submit" value="Registrar">
            <input type="reset" value="Limpiar entrada">
        </form>
    </section>

    <script>
        let campoFecha = document.querySelector("input#publicado");

        if (campoFecha != null) {
            campoFecha.max = (new Date()).getFullYear;
        }

        let info_libro = document.querySelector("#info-libro")
        info_libro.style.display = "none"

        let cb = document.querySelector("select#tipo-producto")
        cb.addEventListener('change', () => {
            if (cb.value == 'libro') {
                info_libro.style.display = "block"
                info_libro.disabled = false
            } else {
                info_libro.style.display = "none"
                info_libro.disabled = true
            }
        })
    </script>
    <footer>
        <p>leaf&copy;</p>
    </footer>
</body>

</html>