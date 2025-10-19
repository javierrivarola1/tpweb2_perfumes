<?php
    function verifyAuthMiddleware($res) {
        // chequea si el us esta autorizado. los moiddlewewre son funciones quehace algo muy chiuito que se repite mucho, por ejemplo esta verifica si hay un us. enc ada funcion dodne hay que cheqear tenemos que autenticarlo. es un if que no tiene sentido meterlo en todos llos controlers en los que necesitamos verificar que se esta logeuado, entonces es una funcion que metemos en el oruter , en las rutas que sabemos que tienen qe ser seguras  
        // permite o no pasar al usaurio, este es el guardia que te dice si pasas o no,es el que hay que implementar entodos los lugares dodne que hacen modificacioes
        // no se ocupa de la sesion de la session nos ocupamos solo en el session , se fija si hay un us
        // si hay un us no hace nada, si no lo hay te manda al login . el middlewere sesion no tiene nada que ver con la rediccion al login
        if($_SESSION['username'] != null && isset($_SESSION['username']) && $_SESSION['username'] != '') {
            return;
        } else {
            header('Location: ' . BASE_URL . '/login');
            die();// para que no siga ejecutando el codigo
        }
    }

//verifica si el us está autenticado,recibe como parámetro un objeto $res.
//Verifica la autenticación: Comprueba si $res tiene una propiedad `user`, que indica que el us está autenticado.
//Si el us está autenticado (es decir, existe la propiedad $res->user)retorna (permitiendo la ejecución del resto del código).
//Si el us no está autenticado, redirige a la página de showLogin
// Este middleware se usa  para proteger rutas que solo deben estar disponibles para us autenticados.