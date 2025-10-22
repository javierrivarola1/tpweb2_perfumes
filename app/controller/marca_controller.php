<?php

require_once 'app/model/producto_model.php';
require_once 'app/view/marca_view.php';
require_once 'app/model/marca_model.php';


class MarcaController {
        private $marcaModel; //atributos del controlador
        private $view;
        private $productModel;

    function __construct() { //constructor para crear objetos de la clase controlador
        $this->marcaModel = new MarcaModel();
        $this->view = new MarcaView();
        $this->productModel = new ProductoModel();
    }

    
    
    public function getMarcas(){  //creo funcion para traer marcas del modelo y entregarselas a la vista
        $marcas = $this->marcaModel->getMarcas();
        $this->view->mostrarMarcas($marcas);
    }

   public function getProdByMarca($IDMarca) {
    if ($IDMarca) {
        $productos = $this->productModel->getProdByIDMarca($IDMarca);
        $marca = $this->marcaModel->getMarcaByID($IDMarca);

        if ($marca) {
            // Si la marca existe, mostramos la vista normal
            $this->view->mostrarProdByMarca($productos, $marca);
        } else {
            // Marca no encontrada
            $error = "La marca con ID {$IDMarca} no existe.";
            $this->view->mostrarError($error);
        }

    } else {
        // ID inválido
        $error = "Código de marca inválido.";
        $this->view->mostrarError($error);
    }
}
     /**
     * Crea un marca en la DB e informa a la vista en caso que se haya producido un error
     */
    public function agregarMarca() {
        
        
        $nombre = $_POST["nombre"];
        $origen = $_POST["origen"];
        $creador = $_POST["creador"];
        $anio = $_POST["anio"];

        if (empty($nombre) || empty($origen) || empty($creador) || empty($anio)) {
            $error = "Faltan completar campos.";
            $this->view->mostrarError($error);
            return;
        }
        // Se verifica si la marca ingresada ya existe
        $existe = $this->marcaModel->existeMarca($nombre,$origen, $creador, $anio);

        if ($existe) {
            $error = "La marca ya existe.";
            $this->view->mostrarError($error);
            return;
        }

        // Se inserta en la DB
        $id = $this->marcaModel->agregarMarca($nombre, $origen, $creador, $anio);
        
        // Se verifica si se insertó correctamente
        if ($id != 0) {
            header('Location: ' . BASE_URL . '/marcas');
        } else {
            $error = "Error al insertar la marca en la base de datos.";
            $this->view->mostrarError($error);
            return;
        }
    }

    /**
     * Elimina la marca con el ID dado 
    */
    public function eliminarMarca($idMarca) {

     if ($this->productModel->existeProducto($idMarca) > 0) {
        $this->view->mostrarError("No se puede eliminar la marca, tiene productos asociados. Eliminelos si quiere eliminar la marca");
        return;
     }
        
        $borrada = $this->marcaModel->eliminarMarca($idMarca);
        if ($borrada) {
            header('Location: ' . BASE_URL . '/marcas');
        } else {
            $error = "No se pudo eliminar la marca de la base de datos.";
            $this->view->mostrarError($error);
        }
    }
    /**
     * Modifica la marca con el ID dado
    */
    
    public function editarMarca($idMarca) {
    
    // Si el formulario no se envió, mostramos el form
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $marca = $this->marcaModel->getMarcaByID($idMarca);
        $this->view->mostrarMarcaFormEdicion($marca);
        return;
    } 

    // Capturamos datos del POST
    $nombre = $_POST["nombre"];
    $origen = $_POST["origen"];
    $creador = $_POST["creador"];
    $anio = $_POST["anio"];
    $id = $_POST["id"];
   

    if (empty($nombre) || empty($origen) || empty($creador) || empty($anio) || empty($id)) {
        $this->view->mostrarError("Faltan completar campos.");
        return;
    }

    // Llamamos al modelo para actualizar
    $actualizado = $this->marcaModel->editarMarca($nombre, $origen, $creador, $anio, $id);

    if ($actualizado) {
        header('Location: ' . BASE_URL . '/marcas');
        
    } else {
        $this->view->mostrarError("No se pudo actualizar la marca.");
    }
}

    function mostrarError($mensaje) {
        $this->view->mostrarError($mensaje);
    }
}


