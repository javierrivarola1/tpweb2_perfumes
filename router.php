<?php


require_once 'app/controller/product_controller.php';
require_once 'app/controller/usuario_controller.php';




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

    case 'detalle': 
        if(isset ($params[1]))     {//revisa como parametro el ID del producto para traerlo.
            $controller = new ProductController();
            $controller->getProducto($params[1]);
        } 
        break;

    case 'eliminarProducto':
        if (isset($params[1])) { // revisa como parametro el ID del producto para traerlo.
            $controller = new ProductController();
            $controller->eliminarProducto($params[1]);
        }
        break;

    case 'agregarProducto': // Ruta para agregar un producto
        $controller = new ProductController();
        $controller->agregarProducto();
        break;

    case 'login':
        $controller = new UsuarioController();
        $controller->mostrarLogin();
        break; // Ruta para mostrar el formulario de login

    case 'registro':
        $controller = new UsuarioController();  
        $controller->mostrarRegistro();
        break; // Ruta para mostrar el formulario de registro
        
    case 'registrarse':

        $controller = new UsuarioController();
        $controller->registrarse();
        break; // Ruta para procesar el registro de un nuevo usuario
       
    default:
        $controller = new ErrorVista();
        $controller->showError("Pagina no encontrada", "home", "/", 404);
        break;
}