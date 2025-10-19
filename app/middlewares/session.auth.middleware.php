<?php
function sessionAuthMiddleware($res)
{
    session_start();
    if (isset($_SESSION['id_user'])) {// si existe la sesion
        $res->user = new stdClass();// crea un objeto vacio
        $res->user->id = $_SESSION['id_user'];//al objeto vacion le otorgamos el id del arrgelo $_SESSION
        $res->user->username = $_SESSION['username'];//al objeto vacio le otorgamos el username del arrgelo $_SESSION
        return;
    }
}
    // lee la sesión y guarda el us si existe
    // ya no tiene nada que ver con mandarme al login: solo chequea que hay un us, divido el comportamiento en dos , este middlewere lo unico que hace es setear al res->user si existe session, seteamos el usaurio si es que existe, osea leemos la cookie y hacemos ese trabajo . solo pregunta si sos alguien anonimo o no 
        
    // Las funciones verifyAuthMiddleware y sessionAuthMiddleware son parte de un sistema de autenticación en PHP que utiliza sesiones para controlar el acceso de los usuarios.
    
    // Propósito conjunto:sessionAuthMiddleware se encarga de leer la sesión del us cuando ya está autenticado y almacenar la información de la sesión en $res->user. verifyAuthMiddleware: Protege las rutas que requieren autenticación, redirigiendo a la página de login si no hay un us autenticado. En resumen, estos middlewares trabajan juntos para manejar el control de acceso: uno para gestionar las sesiones, y otro para verificar si el us está autenticado.

    
    
    // inicializa la sesión y verifica si el usuario ya ha iniciado sesión. 
    // Llama a `session_start()` para iniciar la sesión en PHP.
    //Verificación de la sesión: Revisa si existe el valor id_user en la variable global $_SESSION, lo que indica que el usuario ha iniciado sesión correctamente.
    // Si $_SESSION['id_user'] existe: Crea un nuevo objeto en $res->user, asigna a $res->user->id el valor de $_SESSION['id_user'] (el ID del usuario logueado). Asigna a $res->user->username el nombre de usuario almacenado en $_SESSION['username']. De esta forma, almacena la información del us autenticado en $res->user, que puede ser utilizada por otras partes del código.
    // Si $_SESSION['id_user'] no existe, no hace nada.
