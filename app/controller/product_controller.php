<?php

require_once 'app/model/product_model.php';
require_once 'app/view/product_view.php';
class ProductController {

    private $model;
    private $view;

    function __construct() {

        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    function getProductos()  {
        //traer todos los productos de la base de datos
        $arrayProductos = $this -> model -> getProductos(); //Cambiamos array porr arrayProductos
        //enviamos el array a la vista
        $this -> view -> mostrarProductos($arrayProductos);    
    
    }

    function getProducto($id) {
        $producto = $this -> model -> get($id);// Trajimos un producto especifico de la base de datos.
        //enviamos el producto a la vista
        $this -> view -> mostrarProducto($producto);
    }

}