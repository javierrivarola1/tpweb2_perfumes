<?php
class Model  {
    private $db; //la clase modelo es la que accede a la base de datos

    function __construct() { //constructor para instanciar la base de datos
     $this->db = new PDO('mysql:host=localhost;dbname=db_perfumeria;charset=utf8', 'root', '');
    }

    public function getAllMarcas() { //funcion que agarra de la base de datos la lista de marcas
        $query = $this->db->prepare('SELECT * FROM marca'); //"requiere de esta base de datos que se prepare la seleccion de todos (*) los items from la tabla marca"
        $query->execute(); //que se ejecute el requerimiento
        $marcas = $query->fetchAll(PDO::FETCH_OBJ); //creo un arreglo de marcas que contiene 

        return $marcas;
    }

    public function getProdByIDMarca ($IDMarca) {
        $query = $this->db->prepare('SELECT * FROM producto WHERE marca = ?'); //en lugar del parametro escribo ? para evitar inyeccion sql y 
                                                                                // evitar hackeos
    
        $query->execute([$IDMarca]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ); //trae todos los productos devuelto por la consulta y los guarda en un arreglo de objetos

        return $productos; //retorno el arreglo productos al controlador
    }
    public function getMarcaByID($IDMarca){
          $query = $this->db->prepare('SELECT * FROM marca WHERE id = ?'); //puedo buscar desde la pestania SQL asi
          $query->execute([$IDMarca]);
          $marca =   $query->fetchAll(PDO::FETCH_OBJ);
          return $marca;  

    }



}

