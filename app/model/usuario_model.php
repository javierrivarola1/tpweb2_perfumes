<?php   

class usuarioModel extends Autodeploy{

   function agregar ($usuario, $contraseniaHash) {

        $query = $this->db->prepare("INSERT INTO usuarios (usuario, contrasenia) VALUES (?, ?)");
        $query->execute([$usuario, $contraseniaHash ]);
        $id = $this->db->lastInsertId();// Obtengo  el ID del último producto insertado.

        return $id;
   } // Aquí irían los métodos relacionados con la gestión de usuarios

   function getUserByUsername($username) {

        $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?"); //prepara a consulta para la base de datos
        $query->execute([$username]); //ejecuta la consulta con el parametro username.
        return $query->fetch(PDO::FETCH_OBJ); //devuelve el objeto usuario si lo encuentra o false si no

   }

    function getUserById($id) {
    
          $query = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?"); //prepara a consulta para la base de datos
          $query->execute([ (int)$id ]); //ejecuta la consulta con el parametro id.
          return $query->fetch(PDO::FETCH_OBJ); //devuelve el objeto usuario si lo encuentra o false si no
    
    }
}

