<?php


require_once 'app/controller/product_controller.php';




define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);


// Tabla de rutas

/* Ruta----------------------Controlador----------------------Metodo----------------------Descripcion------------------------------------------------------------

  # Product

  

  /home                     product_controller                  getProductAll               Obtiene todos los productos

  /detail/:id               product_controller                  getProductId                Obtiene un producto seleccionado y lo muestra en la pagina 
  
  
  
  */


//Administrador de rutas

switch ($params[0]) {

    case 'home': 

        $controller = new ProductController();
        $controller->getProductos();
        break;

    case 'detail': 
        if(isset ($params[1]))     {//revisa como parametro el ID del producto para traerlo.
            $controller = new ProductController();
            $controller->getProducto($params[1]);
        } 
        break;
        

    default:
        $controller = new ErrorVista();
        $controller->showError("Pagina no encontrada", "home", "/", 404);
        break;
}