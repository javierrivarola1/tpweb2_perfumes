<?php 

require_once 'app/model/usuario_model.php';
require_once 'app/view/usuario_view.php';


class UsuarioController {

    private $model;
    private $view;// Aquí irían los métodos relacionados con la gestión de usuarios


    function __construct() {

        $this->model = new UsuarioModel();
        $this->view = new UsuarioView();
    }


    function mostrarRegistro() {
        return $this -> view -> mostrarRegistro(); //Mostrar el formulario de Registro
    }
    function mostrarLogin() {
        return $this -> view -> mostrarLogin();// mostrar el formulario de login
    }

    function registrarse() {
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $contraseniaHash = password_hash($contrasenia, PASSWORD_DEFAULT); //hasheo la contraseña que ingreso el us

        // Verificar que el usuario está en la base de datos
       $usuarioDB = $this->model->getUserByUsername($usuario); 

        if (!$usuarioDB) {
           // Guardar el usuario en la base de datos
            $userID = $this->model->agregar($usuario, $contraseniaHash); //guarada el id del ultimo usuario agregado 

            if ($userID) { //si se pudo registrar trae el objeto usuario buscandolo por id 
                $user = $this->model->getUserById($userID);
                // Guardo en la sesión el ID del usuario y otros datos de el
                session_start();
                $_SESSION['id_'] = $userID;
                $_SESSION['usuario'] = $user->usuario;
                $_SESSION['LAST_ACTIVITY'] = time();// tiempo de la ultima actividad
                // Redirijo al home
                header('Location: ' . BASE_URL); //no se pone barra, lo pone el explode
                exit();
            }else{
                return $this->view->showRegister('No fue posible registrase');
            } 
            
        }   else {
            return $this->view->showRegister('Ese usuario ya existe. No puede registrarse con ese nombre de usuario');
        }
      
    }
}

