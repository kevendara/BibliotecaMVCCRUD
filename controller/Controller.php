<?php
/*-----------------------------------------------------------------------
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
*/

require_once '../model/BibliotecaModel.php';
session_start();
$libroModel = new BibliotecaModel();
$opcion = $_REQUEST['opcion'];
//clean whatever message previous
unset($_SESSION['mensaje']);

switch($opcion){
    case "listar_asc":
        //obtenemos la lista de productos:
        $listado = $libroModel->getBiblioteca(true);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos y guardamos en sesion:
//        $_SESSION['valorTotal']=$productoModel->getValorProductos();
        header('Location: ../index.php');
        break;
     case "listar_desc":
        //obtenemos la lista de productos:
        $listado = $libroModel->getBiblioteca(false);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos y guardamos en sesion:
//        $_SESSION['valorTotal']=$productoModel->getValorProductos();
        header('Location: ../index.php');
        break;
     case "listar_nombre":
        $nombre=$_REQUEST['nombre'];  //get from formulario
        //obtenemos la lista de productos:
        $listado = $libroModel->getLibro_PorNombre($nombre);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../index.php');
        break;
    case "listar_autor":
        $autor=$_REQUEST['autor'];  //get from formulario
        //obtenemos la lista de productos:
        $listado = $libroModel->getLibros_PorAutor($autor);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../index.php');
        break;
    case "crear":
        //navegamos a la pagina de creacion:
        header('Location: ../view/Crear.php');
        break;
    case "guardar":
        //obtenemos los valores ingresados por el usuario en el formulario:
        $codigo=$_REQUEST['codigo'];
        $titulo=$_REQUEST['titulo'];
        $anio=$_REQUEST['anio'];
        $autor=$_REQUEST['autor'];
        $paginas=$_REQUEST['paginas'];
        //creamos un nuevo producto:
        try{
               $libroModel->crearLibro($codigo, $titulo, $anio, $autor,$paginas);
            } catch (Exception $e){
                //colocamos mesaage of exception in session
                $_SESSION['mensaje']=$e->getMessage();
        }
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getBiblioteca();
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../index.php');
        break;
    case "eliminar":
        //obtenemos el codigo del producto a eliminar:
        $codigo=$_REQUEST['codigo'];
        //eliminamos el producto:
        $libroModel->eliminarLibro($codigo);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getBiblioteca();
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../index.php');
        break;
    case "cargar":
        //para permitirle actualizar un producto al usuario primero
        //obtenemos los datos completos de ese producto:
        $codigo=$_REQUEST['codigo'];
        $libro=$libroModel->getLibro($codigo);
        //guardamos en sesion el producto para posteriormente visualizarlo
        //en un formulario para permitirle al usuario editar los valores:
        $_SESSION['libro']=$libro;
        header('Location: ../view/Actualizar.php');
        break;
    case "actualizar":
        //obtenemos los datos modificados por el usuario:
        $codigo=$_REQUEST['codigo'];
        $titulo=$_REQUEST['titulo'];
        $anio=$_REQUEST['anio'];
        $autor=$_REQUEST['autor'];
        $paginas=$_REQUEST['paginas'];
        //actualizamos los datos del producto:
        $libroModel->actualizarLibro($codigo, $titulo, $anio, $autor,$paginas);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getBiblioteca();
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../index.php');
        break;
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
        
}


