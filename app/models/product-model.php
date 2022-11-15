<?php

class ProductModel
{
    private $db;

    public function __construct()
    {
        //en el constructor me conecto a la base de datos
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_motos;charset=utf8', 'root', '');
    }

    //Devuelve la lista de productos completa.
    public function getAll($orderBy, $order, $limit, $page)
    {
        $offset = $page * $limit - $limit;
        $query = "SELECT * FROM producto  ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        $querydb = $this->db->prepare($query);
        $querydb->execute();
        $productos = $querydb->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $productos;
    }

    public function getAllByColumn($orderBy, $order, $limit, $page, $column, $filtervalue)
    {
        $offset = $page * $limit - $limit;
        $params = []; //creo el array
        $query = "SELECT * FROM producto WHERE  $column = ? ORDER BY $orderBy $order LIMIT $limit OFFSET $offset";
        array_push($params, $filtervalue);
        $querydb = $this->db->prepare($query);
        $querydb->execute($params);
        $productos = $querydb->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $productos;
    }




    //Devuelve un producto.
    public function get($id)
    {
        $query = $this->db->prepare(" SELECT a. *, b. * FROM  producto a INNER JOIN especificacion b
        ON a.id_especificacion = b.id_especificacion WHERE a.id_producto  = ? ");
        $query->execute([$id]);
        // 3. obtengo los resultados
        $producto = $query->fetch(PDO::FETCH_OBJ); // devuelve el producto
        return $producto;
    }



    //Inserta un producto en la tabla productos de la base de datos.
    public function insert($precio, $color, $stock, $id_especificacion)
    {
        $query = $this->db->prepare("INSERT INTO producto (precio, color, stock, id_especificacion) VALUES (?, ?, ?, ?)");
        $query->execute([$precio, $color, $stock, $id_especificacion]);
        return $this->db->lastInsertId();
    }
    /**
     * Edita un producto en la tabla productos de la base de datos.
     */
    public function update($id_producto, $precio, $color, $stock, $id_especificacion)
    {
        $query = $this->db->prepare("UPDATE producto SET precio = ?, color = ?, stock = ?, id_especificacion = ?
        WHERE id_producto = ?");
        try {
            $producto = $query->execute([$precio, $color, $stock, $id_especificacion, $id_producto]);
            return $producto;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    //Elimina un producto dado su id
    function delete($id)
    {
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        try {
            $query->execute([$id]);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
}
