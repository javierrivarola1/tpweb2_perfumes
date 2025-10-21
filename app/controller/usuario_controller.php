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


    public function mostrarRegistro() {
        return $this -> view -> mostrarRegistro(); //Mostrar el formulario de Registro
    }
    public function mostrarLogin() {
        return $this -> view -> mostrarLogin();// mostrar el formulario de login
    }

    public function registrarse() {
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $contraseniaHash = password_hash($contrasenia, PASSWORD_DEFAULT); //hasheo la contraseña que ingreso el us
        var_dump($usuario);
        var_dump($contrasenia);
        var_dump($contraseniaHash);
        // Verificar que el usuario está en la base de datos
        $usuarioDB = $this->model->getUserByUsername($usuario); 
        
        if (!$usuarioDB) {
            var_dump('llego hasta aca1');
            // Guardar el usuario en la base de datos
            $userID = $this->model->agregar($usuario, $contraseniaHash); //guarada el id del ultimo usuario agregado 
            var_dump($userID);
            if ($userID) { //si se pudo registrar trae el objeto usuario buscandolo por id 
                var_dump('llego hasta aca2');
                $user = $this->model->getUserById($userID);
                
                // Guardo en la sesión el ID del usuario y otros datos de el
                session_start();
                $_SESSION['id_user'] = $userID;
                $_SESSION['username'] = $user->usuario;
                $_SESSION['LAST_ACTIVITY'] = time();// tiempo de la ultima actividad

                
                // header('Location: ' . BASE_URL); // redirige al home
                exit();
            }else{
                // return $this->view->mostrarError('No fue posible registrase');
            } 
            
        }   else {
            // return $this->view->mostrarError('Ese usuario ya existe. No puede registrarse con ese nombre de usuario');
        }
      
    }

    public function login() {
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];

        // Verificar que el usuario está en la base de datos
        $user = $this->model->getUserByUsername($usuario);

        if ($user && password_verify($contrasenia, $user->contrasenia)) {
            // Guardo en la sesión el ID del usuario y otros datos de el
            session_start();
            $_SESSION['id_user'] = $user->id;
            $_SESSION['username'] = $user->usuario;
            $_SESSION['LAST_ACTIVITY'] = time();// tiempo de la ultima actividad

            header('Location: ' . BASE_URL); // redirige al home
            // exit();
        } else {
            return $this->view->mostrarError('Usuario o contraseña incorrectos');
        }
    }

    public function logout() {
        session_start();
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
        header('Location: ' . BASE_URL ); // Redirige al login después de cerrar sesión
        exit();
    }

    function mostrarError($mensaje) {
        $this->view->mostrarError($mensaje);
    }
}

