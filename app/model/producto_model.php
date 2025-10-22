<?php

require_once 'autodeploy.php';

class ProductoModel extends Autodeploy
{

    function getProductos()
    {
        $query = $this->db->prepare("select * from producto"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
        $query->execute();
        $arrayProducto = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayProducto;
    }

    function get($id) //Metodo para traer detalle de ítem: Se debe poder navegar y visualizar cada ítem particularmente 
    {
        $query = $this->db->prepare("select * from producto WHERE id = ?"); //Metodo para traer productos (Listado de ítems: Se debe poder visualizar todos los ítems cargados)
        $query->execute([$id]);

        $arrayProducto = $query->fetch(PDO::FETCH_OBJ);

        return $arrayProducto;
    }

    function eliminar($id) // Metodo para eliminar un ítem
    {
        $query = $this->db->prepare("DELETE FROM producto WHERE id = ?"); 
        $query->execute([$id]);
    }

    function agregar($nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion) // Metodo para agregar un ítem
    {
        $query = $this->db->prepare("INSERT INTO producto (nombre, descripcion, marca, sexo, stock, precio, presentacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion]);
        $id = $this->db->lastInsertId();// Obtengo el ID del último producto insertado.

        return $id;
    }
    
    function modificar($id, $nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion)
    {
        $query = $this->db->prepare("UPDATE producto SET nombre = ?, descripcion = ?, marca = ?, sexo = ?, stock = ?, precio = ?, presentacion = ? WHERE id = ?");
        $query->execute([$nombre, $descripcion, $marca, $sexo, $stock, $precio, $presentacion, $id]);

        // devolver número de filas afectadas (o true/false si prefieres)
        return $query->rowCount();// el rowCount devuelve la cantidad de filas afectadas por la consulta.
    }
     public function getProdByIDMarca ($idMarca) {
        $sql = 'SELECT * FROM producto WHERE marca = ?';//en lugar del parametro escribo ? para evitar inyeccion sql y 
                                                                                // evitar hackeos
        $query = $this->db->prepare($sql); 
        $query->execute([$idMarca]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ); //trae todos los productos devuelto por la consulta y los guarda en un arreglo de objetos

        return $productos; //retorno el arreglo productos al controlador
    }
      /**
     * Verifica si existe el producto dado su ID. Esto es útil para respetar las
     * restricciones de la clave foránea
     */
    public function existeProducto($idMarca) {
        // Consulta SQL para verificar si el id de la marca existe en la tabla de productos
        $sql = "SELECT COUNT(*) FROM producto WHERE marca = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$idMarca]);

        // Se obtiene el resultado de la consulta
        $count = $query->fetchColumn();

        // Si count es mayor que 0, significa que el id existe
        return $count > 0;
    }
}