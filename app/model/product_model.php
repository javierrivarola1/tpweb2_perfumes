<?php 

class ProductModel { 
    
    function getProductAll () { 

    $db = new PDO('mysql:host=localhost;dbname=db_perfumeria;charset=utf8', 'root', '');

    $query = $db->prepare( "select * from producto"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
    $query->execute();

    $arrayProduct = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProduct;
} 

    function getProductId($id) //Metodo para traer detalle de ítem: Se debe poder navegar y visualizar cada ítem particularmente 

    { 
          $db = new PDO('mysql:host=localhost;dbname=db_perfumeria;charset=utf8', 'root', '');

        $query = $db->prepare( "select * from producto WHERE id = ?"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
        $query->execute($id);

        $arrayProduct = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProduct;

     }




}