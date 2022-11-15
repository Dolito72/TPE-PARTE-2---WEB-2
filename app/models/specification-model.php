<?php

class SpecificationModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_motos;charset=utf8', 'root', '');
    }




    // me traigo el modelo de mi tabla especificacion
    public function getModeloById($id)
    {
        $query = $this->db->prepare("SELECT modelo FROM especificacion WHERE id_especificacion = ?");
        $query->execute([$id]);
        // 3. obtengo los resultados
        $respuesta = $query->fetch(PDO::FETCH_OBJ);
        return $respuesta->modelo;
    }
}
