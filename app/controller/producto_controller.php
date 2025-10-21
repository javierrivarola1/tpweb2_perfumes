<?php

require_once 'app/model/producto_model.php';
require_once 'app/view/producto_view.php';
require_once 'app/model/marca_model.php';

class ProductoController {

    private $marcaModel;
    private $model;
    private $view;


    function __construct() {

        $this->marcaModel = new MarcaModel();
        $this->model = new ProductoModel();
        $this->view = new ProductoView();
    }

    function getProductos()  {
        //traer todos los productos de la base de datos
        $arrayProductos = $this -> model -> getProductos(); //Cambiamos array porr arrayProductos
        $arrayMarcas = $this -> marcaModel -> getMarcas();// Traemos todas las marcas de la base de datos
        //enviamos el array a la vista
        $this -> view -> mostrarProductos($arrayProductos, $arrayMarcas);    
    
    }

    function getProducto($id) { //traer un producto por su id

        if (empty($id) || is_null($id) || !isset ($id)) {
            return $this->view->mostrarError("El ID es obligatorio.");

        }else{

            $producto = $this -> model -> get($id); //busco el producto en la DB

            if (!$producto) {  //verificamos que el producto exista en la base de datos
                return $this->view->mostrarError("La producto no es válido.");
            }
            
            $arrayMarcas = $this -> marcaModel -> getMarcas();// Traemos todas las marcas de la base de datos para el editar producto en un futuro
            
            //enviamos el producto y las masrcas a la vista
            $this -> view -> mostrarProducto($producto, $arrayMarcas);


        }
    }

    function eliminarProducto($id) { 

        if (empty($id) || is_null($id) || !isset ($id)) {
            return $this->view->mostrarError("El ID es obligatorio.");
        }else{
            $producto = $this -> model -> get($id); //busco el producto en la DB
            

            if (!$producto) {  //verificamos que el producto exista en la base de datos
                return $this->view->mostrarError("La producto no es válido.");
            
            } else{
                //entra si el producto existe.
                $this->model->eliminar($id);         

                //REDIRIGIR A LA LISTA DE PRODUCTOS(home )
                header('Location: ' . BASE_URL);      
            }
        }
  
    }
    function agregarProducto() { // Agregar un producto a la base de datos

        $errores = [];

        //VALIDACIONES UNA POR CADA CAMPO- PODRIAN SER MUCHAS MAS COMPLEJAS
        if (!preg_match("/^[A-Za-z\s]+$/", $_POST['nombre']) || empty($_POST['nombre']) || is_null($_POST['nombre']) || !isset($_POST['nombre'])) {
            $errores[] = "El nombre es obligatorio.";
        }

        if (strlen($_POST['descripcion']) > 1000 || empty($_POST['descripcion']) || is_null($_POST['descripcion']) || !isset($_POST['descripcion'])) {
            $errores[] = "La descripción es obligatoria. Y no debe superar los 1000 caracteres.";
        }

        if ( $_POST['precio'] <=0 || empty($_POST['precio']) || is_null($_POST['precio']) || !isset($_POST['precio'])) {
            $errores[] = "El precio es obligatorio y debe ser mayor a 0.";
        }
        
        if(($_POST['stock']<0 && $_POST['stock']>1) || empty($_POST['stock']) || is_null($_POST['stock']) || !isset($_POST['stock'])) {
            $errores[] = "El stock es obligatorio y no puede ser negativo. Y debe ser entre 1 y 0";
        }
        if ($_POST['presentacion']>=20 || $_POST['presentacion'] == "" || is_null($_POST['presentacion']) || !isset($_POST['presentacion'])) {
            $errores[] = "La presentación es obligatoria.";
        }   
        
        //VALIDACIONES PARA MARCA
        //verificamos que llegue algo por parametro
        if (empty($_POST['marca']) || is_null($_POST['marca']) || !isset($_POST['marca'])) {
            $errores[] = "La marca es obligatoria.";
        }else{
            $marca = $this -> marcaModel -> getMarcaById($_POST['marca']);
            //verificamos que la marca exista en la base de datos
            if (!$marca) {  
                $errores[] = "La marca no es válida.";
            }
        }

        if  ($_POST['sexo'] == "" || is_null($_POST['sexo']) || !isset($_POST['sexo'])) {
            $errores[] = "El sexo es obligatorio.";
        }
          
        if (count($errores) > 0) {
            $mensajeError = implode(" ", $errores);
            return $this->view->mostrarError($mensajeError);  // Si hay errores, mostramos el mensaje y salimos de la función.
        } else {
            
            //1. Obtener los datos del formulario
            $nombre = $_POST['nombre']; 
            $descripcion = $_POST['descripcion'];
            $marca = $_POST['marca'];
            $sexo = $_POST['sexo'];
            $stock = isset($_POST['stock']) ? 1 : 0; // Si el checkbox está marcado, stock es 1, si no, es 0.
            $precio = $_POST['precio'];
            $presentacion = $_POST['presentacion']; 
            
            //2. Llamar al modelo para que agregue el producto
            $id = $this -> model -> agregar($nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion);
            //3. Verificar si se agregó correctamente y redirigir o mostrar mensaje de error
            if (!$id) {              
                return $this->view->mostrarError('Error al agregar el producto.');
            } else{
                $this->getProducto($id);  // Mostrar el detalle del producto recién agregado.
            }
        }   
    }

    function modificarProducto($id) { // Agregar un producto a la base de datos

        $errores = [];

        //VALIDACIONES UNA POR CADA CAMPO- PODRIAN SER MUCHAS MAS COMPLEJAS -- MODIFICAR PRODUCTOS.
        if (!preg_match("/^[A-Za-z\s]+$/", $_POST['ModificarNombre']) || empty($_POST['ModificarNombre']) || strlen($_POST['ModificarDescripcion']) > 500  || is_null($_POST['ModificarNombre']) || !isset($_POST['ModificarNombre'])) {
            $errores[] = "El nombre es obligatorio.";
        }

        if (strlen($_POST['ModificarDescripcion']) > 1000 || empty($_POST['ModificarDescripcion']) || is_null($_POST['ModificarDescripcion']) || !isset($_POST['ModificarDescripcion'])) {
            $errores[] = "La descripción es obligatoria. Y no debe superar los 1000 caracteres.";
        }

        if ( $_POST['ModificarPrecio']<=0 || empty($_POST['ModificarPrecio']) || is_null($_POST['ModificarPrecio']) || !isset($_POST['ModificarPrecio'])) {
            $errores[] = "El precio es obligatorio y debe ser mayor a 0.";
        }
        
        if(($_POST['ModificarStock']<0 && $_POST['ModificarStock']>1) || empty($_POST['ModificarStock']) || is_null($_POST['ModificarStock']) || !isset($_POST['ModificarStock'])) {
            $errores[] = "El stock es obligatorio y no puede ser negativo.";
        }
        
        if ($_POST['ModificarPresentacion'] == "" || is_null($_POST['ModificarPresentacion']) || !isset($_POST['ModificarPresentacion'])) {
            $errores[] = "La presentación es obligatoria.";
        }   
        //VALIDACIONES PARA MARCA
        //verificamos que llegue algo por parametro
        if (empty($_POST['ModificarMarca']) || is_null($_POST['ModificarMarca']) || !isset($_POST['ModificarMarca'])) {
            $errores[] = "La marca es obligatoria.";
        }else{
            $marca = $this -> marcaModel -> getMarcaById($_POST['ModificarMarca']);
            //verificamos que la marca exista en la base de datos
            if (!$marca) {  
                $errores[] = "La marca no es válida.";
            }
        }

        if  ($_POST['ModificarSexo'] == "" || is_null($_POST['ModificarSexo']) || !isset($_POST['ModificarSexo'])) {
            $errores[] = "El sexo es obligatorio.";
        }
          
        if (count($errores) > 0) {
            $mensajeError = implode(" ", $errores);
            return $this->view->mostrarError($mensajeError);  // Si hay errores, mostramos el mensaje y salimos de la función.
        } else {
            
            //1. Obtener los datos del formulario
            $nombre = $_POST['ModificarNombre']; 
            $descripcion = $_POST['ModificarDescripcion'];
            $marca = $_POST['ModificarMarca'];
            $sexo = $_POST['ModificarSexo'];
            $stock = isset($_POST['ModificarStock']) ? 1 : 0; // Si el checkbox está marcado, stock es 1, si no, es 0.
            $precio = $_POST['ModificarPrecio'];
            $presentacion = $_POST['ModificarPresentacion']; 
            
            //2. Llamar al modelo para que modificar el producto
                $filasModificadas = $this -> model -> modificar($id, $nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion);
            //3. Verificar si se modificar correctamente y redirigir o mostrar mensaje de error
            if (!$filasModificadas) {              
               return $this->view->mostrarError('Error al modificar el producto.'); 
            } else{ 
                $this->getProducto($id);  // Mostrar el detalle del producto recién agregado.
            } 
        }   
    }

    function mostrarError($mensaje) {
        $this->view->mostrarError($mensaje);
    }
    
}