<?php 

class ProductModel { 
    
    function getProductAll () { 

    $db = new PDO('mysql:host=localhost;dbname=db_perfumeria;charset=utf8', 'root', '');

    $query = $db->prepare( "select * from producto"); //Metodo para traer productos
    $query->execute();

    $arrayProduct = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProduct;
} 


}