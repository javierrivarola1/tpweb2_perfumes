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

    function eliminarProducto($id) { // Eliminar un producto de la base de datos
        $this -> model -> eliminar($id);
        
        //traer todos los productos de la base de datos
        $arrayProductos = $this -> model -> getProductos(); //Cambiamos array porr arrayProductos
        //enviamos el array a la vista
        $this -> view -> mostrarProductos($arrayProductos);   
    }

    function agregarProducto() { // Agregar un producto a la base de datos
        //1. Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];   
        $marca = 1;
        $sexo = $_POST['sexo'];
        $stock = isset($_POST['stock']) ? 1 : 0; // Si el checkbox está marcado, stock es 1, si no, es 0.
        $precio = $_POST['precio'];
        $presentacion = $_POST['presentacion']; 

        //aca abria que buscar el id de la marca y luego pasasrlo al modelo
        // $marcaId = $this -> model -> getMarcaId($marca);
         
        //2. Llamar al modelo para que agregue el producto
        $id = $this -> model -> agregar($nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion);
        //3. Verificar si se agregó correctamente y redirigir o mostrar mensaje de error
        if (!$id) {
            echo "Error al agregar el producto.";
            return;
        } else{
            $this->getProducto($id);  // Mostrar el detalle del producto recién agregado.
        }
    }

    
}