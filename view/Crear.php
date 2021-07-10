<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Ingresar Libro </title>
    </head>
    <body>
        <center><br><br>
            <h2>Ingreso de libros</h2>
                <form action="../controller/Controller.php">
            <input type="hidden" value="guardar" name="opcion">
            Codigo:<input type="number" name="codigo" required="true"><br><br>
            Titulo:<input type="text" name="titulo" required="true"><br><br>
            Año:<input type="text" name="anio" required="true"><br><br>
            Autor:<input type="text" name="autor" required="true"><br><br>
            Paginas:<input type="number" name="paginas" required="true"><br><br>
            <input type="submit" value="Crear">
        </form>
</center>
    </body>
</html>
