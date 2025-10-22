<?php
class MarcaView {

    public function mostrarMarcas($marcas) {

        require_once 'template/vista_marcas.phtml';
    }

    public function mostrarProdByMarca($productos, $marca) {

       require_once 'template/vista_prodByIDMarca.phtml';
    }

    public function mostrarMarcaFormEdicion($marca){
      require_once 'template/editar_marca.phtml';
    }
    public function mostrarError($mensaje){
      require_once 'template/error.phtml';
    }


}