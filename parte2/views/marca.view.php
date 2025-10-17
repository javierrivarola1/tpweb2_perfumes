<?php
class MarcaView {

      public function mostrarMarcas($marcas) {

        require_once './templates/vista_marcas.phtml';
    }

    public function mostrarProdByMarca($productos, $marca) {

       require_once './templates/vista_prodByIDMarca.phtml';
    }


}