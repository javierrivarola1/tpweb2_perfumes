<?php 

require_once 'autodeploy.php';

class ProductModel extends Autodeploy { 
    
    function getProductAll () { 

    $query = $this->db->prepare( "select * from producto"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
    $query->execute();

    $arrayProduct = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProduct;
} 

    function getProductId($id) //Metodo para traer detalle de ítem: Se debe poder navegar y visualizar cada ítem particularmente 

    {        
        $query = $this->db->prepare( "select * from producto WHERE id = ?"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
        $query->execute($id);

        $arrayProduct = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProduct;

     }




}