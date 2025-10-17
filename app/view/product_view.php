<?php 

class ProductView {


    function mostrarProductos($productos) {

        require_once 'template/home.phtml';

    }

    function mostrarProducto ($producto) {
        require_once 'template/detalle.phtml';
    }

}