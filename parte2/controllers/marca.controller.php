<?php

require_once ".\model\model.php";
require_once "C:/xampp/htdocs/tpweb2_perfumes/parte2/views/marca.view.php";

class MarcaController {
        private $model; //atributos del controlador
        private $view;

    function __construct() { //constructor para crear objetos de la clase controlador
        $this->model = new Model();
        $this->view = new MarcaView();
    }

    
    
    public function getMarcas(){  //creo funcion para traer marcas del modelo y entregarseslas a la vista
        $marcas = $this->model->getAllMarcas();
        $this->view->mostrarMarcas($marcas);
    }

    public function getProdByMarca ($IDMarca){ //creo funcion para traer productos de determinado ID de marca y llevarlos a la vista
        $productos = $this->model->getProdByIDMarca($IDMarca);
        $marca = $this->model->getMarcaByID($IDMarca);
        $this->view->mostrarProdByMarca($productos, $marca);
    }
    
}
