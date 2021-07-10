<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Biblioteca</title>
    </head>
    <body>
        <center>
        <h2>CRUD Biblioteca</h2>
            <table>
            <tr><td>
                        <form action="controller/Controller.php">
                         <input type="hidden" value="listar_asc" name="opcion">
                         <input type="submit" value="Consultar listado ascendente (Año)">
                        </form>
                </td>
                <td>
                        <form action="controller/Controller.php">
                         <input type="hidden" value="listar_desc" name="opcion">
                         <input type="submit" value="Consultar listado ascendente (Titulo)">
                        </form>
                </td>
                <td>
                    <form action="controller/Controller.php">
                        <input type="hidden" value="crear" name="opcion">
                        <input type="submit" value="Ingresar libro">
                    </form>
                </td>

            </tr><br><br>
        </table><br>
        <table border="1">
            <tr>
                <th>CODIGO</th>
                <th>TITULO</th>
                <th>ANIO</th>
                <th>AUTOR</th>
                <th>PAGINAS</th>
                <th>ELIMINAR</th>
                <th>ACTUALIZAR</th>
            </tr>
            <?php
            session_start();
            include './model/Biblioteca.php';
            //verificamos si existe en sesion el listado de productos:
            if (isset($_SESSION['listado'])) {
                $listado = unserialize($_SESSION['listado']);
                foreach ($listado as $libro) {
                    echo "<tr>";
                    echo "<td>" . $libro->getCodigo() . "</td>";
                    echo "<td>" . $libro->getTitulo() . "</td>";
                    echo "<td>" . $libro->getAnio() . "</td>";
                    echo "<td>" . $libro->getAutor() . "</td>";
                    echo "<td>" . $libro->getPaginas() . "</td>";
                    //opciones para invocar al controlador indicando la opcion eliminar o cargar
                    //y la fila que selecciono el usuario (con el codigo del producto):
                    echo "<td><a href='controller/Controller.php?opcion=eliminar&codigo=" . $libro->getCodigo() . "'>eliminar</a></td>";
                    echo "<td><a href='controller/Controller.php?opcion=cargar&codigo=" . $libro->getCodigo() . "'>actualizar</a></td>";
                    echo "</tr>";
                }
            } else{
                echo "No se han cargado datos.";
            }
//   // method independ
//        if(isset($_SESSION['valorTotal'])){
//            echo "<tr>";
//            echo "<td colspan='3' >VALOR TOTAL DE PRODUCTOS: </td><td>".$_SESSION['valorTotal']."</td>";
//            }
        ?></tr>
        </table>
        <?php  
//        if (isset($_SESSION['mensaje'])) {
//            echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje'] . "</font><br>";
//        }
        ?>

        <br><table>
            <td>
                <form action="controller/Controller.php">
                 <input type="hidden" value="listar_nombre" name="opcion">
                 <input type="text" name="nombre" required="true">
                 <input type="submit" value="Buscar Titulo">
                </form>
            </td>
            <td>
                <form action="controller/Controller.php">
                 <input type="hidden" value="listar_autor" name="opcion">
                 <input type="text" name="autor" required="true">
                 <input type="submit" value="Buscar autor">
                </form>
            </td>
        </table>
    </center>
    </body>
</html>
