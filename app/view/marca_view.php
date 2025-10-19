<?php
class MarcaView {

      public function mostrarMarcas($marcas) {

        require_once 'template/vista_marcas.phtml';
    }

    public function mostrarProdByMarca($productos, $marca) {

       require_once 'template/vista_prodByIDMarca.phtml';
    }


}