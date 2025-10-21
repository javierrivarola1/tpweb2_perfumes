<?php

require_once 'autodeploy.php';
class MarcaModel extends Autodeploy{

    function getMarcas()
    {
        $query = $this->db->prepare("select * from marca"); //Metodo para traer marca (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
        $query->execute();
        $arrayMarcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayMarcas;
    }

    function getMarcaById($id)
    {
        $query = $this->db->prepare("select * from marca where id = ?"); //Metodo para traer una marca por su ID
        $query->execute([$id]);
        $marca = $query->fetch(PDO::FETCH_OBJ);

        return $marca;
    }

    
   
}