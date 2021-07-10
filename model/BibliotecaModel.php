<?php
    include 'Database.php';
    include 'Biblioteca.php';
    
class BibliotecaModel {
    

     /* Obtiene todos los productos de la base de datos.
     * @return array
     */
    //only implementar metodos utiles
    public function getBiblioteca($orden){  //sirve pa consultar all productos no mas....si dice obtenga lista de productos con descuento  debo crear otro metodo
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        //check the sort asc or desc
        if($orden==true){//sort asc
                    $sql = "select * from libro order by anio";
        }else//sort desc
                    $sql = "select * from libro order by titulo";
        $resultado = $pdo->query($sql); //object type matriz porque represent tabla relacional 
        //transformamos los registros en objetos de tipo Producto:
        $listado = array();//creo array de objects called $listado
        foreach ($resultado as $res){//con $res accedo   cada fila...Transformacion de Registro a Object PHP
            $libro = new Biblioteca();
            $libro->setCodigo($res['codigo']);//$res['codigo']==>get data od each column
            $libro->setTitulo($res['titulo']);
            $libro->setAnio($res['anio']);
            $libro->setAutor($res['autor']);
            $libro->setPaginas($res['paginas']);
            array_push($listado, $libro);
        }
        Database::disconnect();//si no se desconecta se satura el bdd
        //retornamos el listado resultante:
        return $listado;
    }
    
    
    
    
       public function getLibro_PorNombre($nombre){  //sirve pa consultar all productos no mas....si dice obtenga lista de productos con descuento  debo crear otro metodo
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from libro where titulo=?";//busca un prod con name like.....
        // select * from Estudiante where Upper(nombre) like    '%MARCO%'
        $consulta = $pdo->prepare($sql);
          //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($nombre));//creo un array y le paso el  parameter 
        //Extraemos el registro especifico:
        $resultado = $consulta->fetchAll();  //execute la extraccion, return a object
        $listado=array();
        foreach ($resultado as $res){//con $res accedo   cada fila...Transformacion de Registro a Object PHP
            $libro = new Biblioteca();
                $libro->setCodigo($res['codigo']);//$res['codigo']==>get data od each column
                $libro->setTitulo($res['titulo']);
                $libro->setAnio($res['anio']);
                $libro->setAutor($res['autor']);
                $libro->setPaginas($res['paginas']);
            array_push($listado, $libro);
        }
        Database::disconnect();//si no se desconecta se satura el bdd
        //retornamos el listado resultante:
        return $listado;
    }
    
    
      public function getLibros_PorAutor($autor){  //sirve pa consultar all productos no mas....si dice obtenga lista de productos con descuento  debo crear otro metodo
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from libro where autor=?";//busca un prod con name like.....
        // select * from Estudiante where Upper(nombre) like    '%MARCO%'
        $consulta = $pdo->prepare($sql);
          //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($autor));//creo un array y le paso el  parameter 
        //Extraemos el registro especifico:
        $resultado = $consulta->fetchAll();  //execute la extraccion, return a object
        $listado=array();
        foreach ($resultado as $res){//con $res accedo   cada fila...Transformacion de Registro a Object PHP
            $libro = new Biblioteca();
                $libro->setCodigo($res['codigo']);//$res['codigo']==>get data od each column
                $libro->setTitulo($res['titulo']);
                $libro->setAnio($res['anio']);
                $libro->setAutor($res['autor']);
                $libro->setPaginas($res['paginas']);
            array_push($listado, $libro);
        }
        Database::disconnect();//si no se desconecta se satura el bdd
        //retornamos el listado resultante:
        return $listado;
    }
    
    
    /**
     * Obtiene un producto especifico.
     * @param type $codigo El codigo del producto a buscar.
     * @return \Producto
     */
    public function getLibro($codigo){//busca un producto en especifico y muestar information of it..mas no un array 
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from libro where codigo=?";//codigo=?
        $consulta = $pdo->prepare($sql);//check la sintaxis de sentencia sql 
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($codigo));//creo un array y le paso el  parameter 
        //Extraemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);//execute la extraccion, return a object
        //Transformamos el registro obtenido a objeto:
        $libro=new Biblioteca();
            $libro->setCodigo($res['codigo']);//$res['codigo']==>get data od each column
            $libro->setTitulo($res['titulo']);
            $libro->setAnio($res['anio']);
            $libro->setAutor($res['autor']);
            $libro->setPaginas($res['paginas']);
        Database::disconnect();
        return $libro;
    }
    
    
    
    /**
     * Crea un nuevo producto en la base de datos.
     * @param type $codigo
     * @param type $nombre
     * @param type $precio
     * @param type $cantidad
     */
    public function crearLibro($codigo, $titulo, $anio, $autor,$paginas){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Preparamos la sentencia con parametros:
        $sql="insert into libro (codigo,titulo,anio,autor,paginas) values(?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($codigo, $titulo, $anio, $autor,$paginas));
        }   catch (PDOException $e){
            Database::disconnect(); 
            throw new Exception ($e->getMessage());
        }
    }
    
    
    
    /**
     * Elimina un producto especifico de la bdd.
     * @param type $codigo
     */
    public function eliminarLibro($codigo){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from libro where codigo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codigo));
        Database::disconnect();
    }
    
    
    /**
     * Actualiza un producto existente.
     * @param type $codigo
     * @param type $nombre
     * @param type $precio
     * @param type $cantidad
     */
    public function actualizarLibro($codigo, $titulo, $anio, $autor,$paginas){
        //Preparamos la conexión a la bdd:
        $pdo=Database::connect();
        $sql="update libro set titulo=?, anio=?, autor=?, paginas=? where codigo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($titulo, $anio, $autor, $paginas, $codigo));
        Database::disconnect();
    }
}
