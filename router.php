<?php
// Requiere las librerias
require_once 'libs/respuesta.php'; // Requiere la clase Respuesta

// Requiere los middlewares
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';

// Requiere los controladores
require_once 'app/controller/producto_controller.php';
require_once 'app/controller/usuario_controller.php';
require_once 'app/controller/marca_controller.php';

define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
$res = new Respuesta(); // Crea una nueva instancia de Respuesta

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);


// Tabla de rutas

/* Ruta----------------------Controlador----------------------Metodo----------------------Descripcion------------------------------------------------------------

  # Productos
  /home                     ProductoController                  getProductos()              Obtiene y muestra todos los productos
  /detalle/:id             ProductoController                  getProducto()               Muestra el detalle de un producto específico
  /eliminarProducto/:id    ProductoController                  eliminarProducto()          Elimina un producto específico (requiere auth)
  /agregarProducto         ProductoController                  agregarProducto()           Agrega un nuevo producto (POST, requiere auth)
  /modificarProducto/:id   ProductoController                  modificarProducto()         Modifica un producto existente (POST, requiere auth)

  # Usuarios
  /login                    UsuarioController                 mostrarLogin()              Muestra el formulario de login
  /loguearse               UsuarioController                 login()                     Procesa el login del usuario (POST)
  /registro                UsuarioController                 mostrarRegistro()           Muestra el formulario de registro
  /registrarse             UsuarioController                 registrarse()               Procesa el registro de usuario (POST)
  /logout                  UsuarioController                 logout()                    Cierra la sesión del usuario

*/
  



//Administrador de rutas

switch ($params[0]) {

    case 'home': 
        sessionAuthMiddleware($res);
        $controller = new ProductoController();
        $controller->getProductos();
        break;

    case 'detalle': 
        sessionAuthMiddleware($res);
        if(isset ($params[1]) && $params[1]!= "")     {//revisa como parametro el ID del producto para traerlo.
            $controller = new ProductoController();
            $controller->getProducto($params[1]);
        } else {
            $controller = new ProductoController();
            $controller->mostrarError("No se ha especificado un producto válido, para mostrar el detalle.");
        }
        break;

    case 'eliminarProducto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if (isset($params[1])&& $params[1]!= "") { // revisa como parametro el ID del producto para traerlo.
            $controller = new ProductoController();
            $controller->eliminarProducto($params[1]);
        } else {
            $controller = new ProductoController();
            $controller->mostrarError("No se ha especificado un producto válido, para eliminar el mismo.");
        }
        break;
    

    case 'agregarProducto': // Ruta para agregar un producto
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new ProductoController();
            $controller->agregarProducto();
        } else {
            $controller = new ProductoController();
            $controller->mostrarError("Método no permitido. Debe usar POST para agregar un producto.");
        }
        break; 

    case 'modificarProducto': // Ruta para modificar un producto
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        
        if(isset($params[1]) && $params[1]!= "") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // revisa como parametro el ID del producto para traerlo.
                $controller = new ProductoController();
                $controller->modificarProducto($params[1]);
                break;
            }else {
                $controller = new ProductoController();
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
       
    
    case 'marcas': //creo la url marcas
        sessionAuthMiddleware($res);
        $marcaController = new MarcaController(); //instancio el controlador
        $marcaController->getMarcas(); //le pido al controlador que ejectute la funcion getMarcs()
        break;

    case 'marca':
        sessionAuthMiddleware($res);
        $marcaController = new MarcaController();
        $marcaController->getProdByMarca($params[1]); 
        break;
    
    default:
        $controller = new ProductoController();
        $controller->mostrarError("Pagina no encontrada. Error 404");
        break;
}