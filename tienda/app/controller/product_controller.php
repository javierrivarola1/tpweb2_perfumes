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

    function getProductsHome()  {
        
        $Array = $this -> model -> getProductAll(); 

            $this -> view -> showProduct($Array);    
    
    }

}