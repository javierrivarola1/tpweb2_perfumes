<?php
// Requiere las librerias
require_once 'libs/respuesta.php'; // Requiere la clase Respuesta

// Requiere los middlewares
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';

// Requiere los controladores
require_once 'app/controller/product_controller.php';
require_once 'app/controller/usuario_controller.php';

define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
$res = new Respuesta(); // Crea una nueva instancia de Respuesta

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
        sessionAuthMiddleware($res);
        $controller = new ProductController();
        $controller->getProductos();
        break;

    case 'detalle': 
        sessionAuthMiddleware($res);
        if(isset ($params[1]) && $params[1]!= "")     {//revisa como parametro el ID del producto para traerlo.
            $controller = new ProductController();
            $controller->getProducto($params[1]);
        } else {
            $controller = new ProductController();
            $controller->mostrarError("No se ha especificado un producto válido, para mostrar el detalle.");
        }
        break;

    case 'eliminarProducto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if (isset($params[1])&& $params[1]!= "") { // revisa como parametro el ID del producto para traerlo.
            $controller = new ProductController();
            $controller->eliminarProducto($params[1]);
        } else {
            $controller = new ProductController();
            $controller->mostrarError("No se ha especificado un producto válido, para eliminar el mismo.");
        }
        break;
    

    case 'agregarProducto': // Ruta para agregar un producto
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new ProductController();
            $controller->agregarProducto();
        } else {
            $controller = new ProductController();
            $controller->mostrarError("Método no permitido. Debe usar POST para agregar un producto.");
        }
        break; 

    case 'modificarProducto': // Ruta para modificar un producto
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if(isset($params[1]) && $params[1]!= "") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // revisa como parametro el ID del producto para traerlo.
                $controller = new ProductController();
                $controller->modificarProducto($params[1]);
                break;
            }else {
                $controller = new ProductController();
                $controller->mostrarError("Método no permitido. Debe usar POST para agregar un producto.");
            }
        } 
        break; 

    case 'login': //ES LA VISTA DE LOGIN
        $controller = new UsuarioController();
        $controller->mostrarLogin();
        break; // Ruta para mostrar el formulario de login
    case 'loguearse':
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new UsuarioController();
            $controller->login();
        } else {
            $controller = new UsuarioController();
            $controller->mostrarError("Método no permitido. Debe usar POST para iniciar sesión.");
        }
        break; // Ruta para procesar el login de un usuario

    case 'registro': // ES LA VISTA DE REGISTRO
        $controller = new UsuarioController();  
        $controller->mostrarRegistro();
        break; // Ruta para mostrar el formulario de registro
        
    case 'registrarse':
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new UsuarioController();
            $controller->registrarse();
        } else {
            $controller = new UsuarioController();
            $controller->mostrarError("Método no permitido. Debe usar POST para registrar el usuario.");
        }
        break; // Ruta para procesar el registro de un nuevo usuario

    case 'logout':
        $controller = new UsuarioController();
        $controller->logout();
        break; // Ruta para cerrar sesión
       
    default:
        $controller = new ErrorVista();
        $controller->showError("Pagina no encontrada", "home", "/", 404);
        break;
}