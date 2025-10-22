<?php

require_once 'autodeploy.php';
class MarcaModel extends Autodeploy{

    function getMarcas()
    {
        $sql = "SELECT * FROM marca";
        $query = $this->db->prepare($sql); //Metodo para traer marcas
        $query->execute();
        $arrayMarcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $arrayMarcas;
    }

    function getMarcaById($idMarca)
    {
        $sql = "SELECT * FROM marca WHERE id = ?";
        $query = $this->db->prepare($sql); //Metodo para traer una marca por su ID
        $query->execute([$idMarca]);
        $marca = $query->fetch(PDO::FETCH_OBJ);

        return $marca;
    }
     /**
     * Inserta una marca en la DB y, si no se produce ningún error, 
     * devuelve un número distinto de 0
     */
    public function agregarMarca($nombre, $origen, $creador, $anio) {
        $sql = 'INSERT INTO marca (nombre,origen,creador, año) VALUES (?, ?, ?, ?)';
        $query = $this->db->prepare($sql);
        $query->execute([$nombre, $origen, $creador, $anio]);
        return $this->db->lastInsertId();
    }

    /**
     * Elimina una marca dado su ID
     */
    public function eliminarMarca($idMarca) {
        $sql = 'DELETE FROM marca WHERE id = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$idMarca]);
        return $query->rowCount() > 0;
    }

    /**
     * Modifica una marca dado su ID
     */
    public function editarMarca($nombre, $origen, $creador, $anio, $idMarca) {
        $sql = 'UPDATE marca 
                SET nombre = ?, origen = ?, creador = ? , año = ?
                WHERE id = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$nombre, $origen, $creador, $anio, $idMarca]);
        $count = $query->rowCount();
        return $count > 0;
    }
    /**
     * Funcion para corroborar que ya existe una marca
     */
     public function existeMarca($nombre,$origen, $creador, $anio) {
        // Se cuenta la cantidad de registros cuyo nombre coincida el dado
        $sql = "SELECT COUNT(*) FROM marca WHERE nombre = ? AND origen = ? AND creador = ? AND año = ?"; 
        $query = $this->db->prepare($sql);
        $query->execute([$nombre,$origen, $creador, $anio]);

        // Se obtiene el resultado de la consulta
        $count = $query->fetchColumn();

        // Si count es mayor que 0, ya existe otra marca con esos datos.
        return $count > 0;
    }
   
}