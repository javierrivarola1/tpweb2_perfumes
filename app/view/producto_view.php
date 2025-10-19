<?php 

class ProductoView {


    function mostrarProductos($productos, $marcas) {

        require_once 'template/home.phtml';

    }

    function mostrarProducto ($producto, $marcas) {
        require_once 'template/detalle.phtml';
    }

    function mostrarError($mensaje) {
        require_once 'template/error.phtml';
    }
}