<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar Libro</title>
    </head>
    <body>    
    <center>

                <?php
                    include '../model/Biblioteca.php';
                    //obtenemos los datos de sesion:
                    session_start();
                    $libro = $_SESSION['libro'];
                ?>
        <form action="../controller/Controller.php">
            <h2>Actualizacion de Libro</h2>
            <input type="hidden" value="actualizar" name="opcion">
            <!-- Utilizamos pequeños scripts PHP para obtener los valores del producto: -->
            <input type="hidden" value="<?php   echo $libro->getCodigo();   ?>" name="codigo"><br>
            Codigo:<b><?php   echo $libro->getCodigo();    ?></b><br><br>
            Titulo:<input type="text" name="titulo" value="<?php  echo $libro->getTitulo(); ?>" required="true"><br><br>
            Año:<input type="text" name="anio" value="<?php echo $libro->getAnio(); ?>"  required="true" min="1"><br><br>
            Autor:<input type="text" name="autor" value="<?php echo $libro->getAutor(); ?>"  required="true" min="1"><br><br>
            Paginas:<input type="number" name="paginas" value="<?php echo $libro->getPaginas(); ?>"  required="true" min="1"><br><br>
            <input type="submit" value="Actualizar">
        </form>
    </center>

    </body>
</html>
