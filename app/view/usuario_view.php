<?php

class UsuarioView {

   function mostrarRegistro() {

    require_once 'template/registro.phtml';

   }// Aquí irían los métodos relacionados con la gestión de usuarios

   function mostrarLogin() {

    require_once 'template/login.phtml'; //Aquí irían los métodos relacionados con la gestión de usuarios

   }
   function mostrarError($mensaje) {
      require_once 'template/error.phtml';
   }

}