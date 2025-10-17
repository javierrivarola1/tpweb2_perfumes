<?php
require_once './controllers/marca.controller.php'; //permite utilizar el controlador



// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// accion por defecto si no se envia ninguna
$action = 'home'; //
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);



switch ($params[0]) { //esta linea siempre se escribe asi para rutear
    case 'home':
        require_once "templates/header.phtml";
        break;
    case 'marcas': //creo la url marcas
        $marcaController = new MarcaController(); //instancio el controlador
        $marcaController->getMarcas(); //le pido al controlador que ejectute la funcion getMarcs()
        break;
    case 'prodByMarca':
        $marcaController = new MarcaController();
        $marcaController->getProdByMarca($params[1]); 
        break;

    
}
