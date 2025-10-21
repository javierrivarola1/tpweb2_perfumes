<?php

require_once 'app/model/producto_model.php';
require_once 'app/view/marca_view.php';
require_once 'app/model/marca_model.php';

/* 
require_once ".\model\model.php";
require_once "C:/xampp/htdocs/tpweb2_perfumes/parte2/views/marca.view.php"; */

class MarcaController {
        private $marcaModel; //atributos del controlador
        private $view;
        private $productModel;

    function __construct() { //constructor para crear objetos de la clase controlador
        $this->marcaModel = new MarcaModel();
        $this->view = new MarcaView();
        $this->productModel = new ProductoModel();
    }

    
    
    public function getMarcas(){  //creo funcion para traer marcas del modelo y entregarselas a la vista
        $marcas = $this->marcaModel->getMarcas();
        $this->view->mostrarMarcas($marcas);
    }

   public function getProdByMarca($IDMarca) {
    if ($IDMarca) {
        $productos = $this->productModel->getProdByIDMarca($IDMarca);
        $marca = $this->marcaModel->getMarcaByID($IDMarca);

        if ($marca) {
            // Si la marca existe, mostramos la vista normal
            $this->view->mostrarProdByMarca($productos, $marca);
        } else {
            // Marca no encontrada
            $error = "La marca con ID {$IDMarca} no existe.";
            $this->view->mostrarError($error);
        }

    } else {
        // ID inválido
        $error = "Código de marca inválido.";
        $this->view->mostrarError($error);
    }
}

    
}
