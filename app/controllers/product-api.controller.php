<?php
require_once './app/models/product-model.php';
require_once './app/models/specification-model.php';
require_once './app/views/api.view.php';

class ProductApiController
{
    private $model;
    private $view;
    private $modelSpecification;

    private $data;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->modelSpecification = new SpecificationModel();
        $this->view = new ApiView();
        //devuelve el body del request en forma cruda (en un string)
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        //aca paso de string a json
        return json_decode($this->data);
    }

    public function getProducts($params = null)
    {
        try {
            $orderBy = $_GET["orderBy"] ??  "id_especificacion";
            $order = $_GET["order"] ?? "asc";
            $page =  $_GET["page"] ?? 1;
            $limit = $_GET["limit"] ?? 25;
            $column = $_GET["column"] ?? null;
            $filtervalue = $_GET["filtervalue"] ?? null;
            $products = 0;
            $this->verifyParams($column, $filtervalue, $orderBy, $order, $limit, $page);
            if ($column != null && $filtervalue != null)
                $products = $this->model->getAllByColumn($orderBy, $order, $limit, $page, $column, $filtervalue);
            elseif ($column == null)
                $products = $this->model->getAll($orderBy, $order, $limit, $page);

            if (!empty($products)) {
                foreach ($products as $product) {
                    $product->modelo = $this->modelSpecification->getModeloById($product->id_especificacion);
                }
                return $this->view->response($products, 200);
            } else
                $this->view->response("No hay productos", 404);
        } catch (Exception $e) {
            return $this->view->response("Se encontró algo inesperado que impide completar la petición", 500);
        }
    }

    private function verifyParams($column, $filtervalue, $orderBy, $order, $limit, $page)
    {
        $columns = ["id_producto", "precio",  "color", "stock", "id_especificacion"];
        $orders = array("asc", "desc");
        $okParameters = 1;
        if ($column != null) {
            $okParameters++;
        }
        if ($filtervalue != null) {
            $okParameters++;
        }
        if (isset($_GET["orderBy"])) {
            $okParameters++;
        }

        if (isset($_GET["order"])) {
            $okParameters++;
        }
        if (isset($_GET["page"])) {
            $okParameters++;
        }
        if (isset($_GET["limit"])) {
            $okParameters++;
        }

      

        if ($column != null && !in_array(strtolower($column), $columns)) {
            $this->view->response("Ingresó de forma incorrecta el nombre de la columna", 400);
            die;
        }
      
        if ($column != null && $filtervalue == null || is_numeric($filtervalue)) {
            $this->view->response("Ingresó de forma incorrecta el valor de la columna", 400);
            die;
        }
        
        if ($orderBy != null && !in_array(strtolower($orderBy), $columns)) {
            $this->view->response("Ingresó de forma incorrecta el parámetro para ordenar", 400);
            die;
        }

        if ($order != null &&  !in_array(strtolower($order), $orders)) {
            return $this->view->response("Ingresó de forma incorrecta el parámetro orden", 400);
            die;
        }

        if ($page != null && (!is_numeric($page) || $page <= 0)) {
            $this->view->response("Ingresó de forma incorrecta la página", 400);
            die;
        }

        if ($limit != null && (!is_numeric($limit) || $limit <= 0)) {
            $this->view->response("Ingresó de forma incorrecta el límite", 400);
            die;
        }
        if (count($_GET) > $okParameters){
            $this->view->response("Uno o más parámetros son incorrectos", 400);
            die;
        }

    }

    public function getProduct($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $product = $this->model->get($id);
        // si no existe devuelvo 404
        if ($product)
            $this->view->response($product);
        else
            $this->view->response("El producto con el id $id no existe", 404);
    }

    public function deleteProduct($params = null)
    {
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response($product);
        } else
            $this->view->response("El producto con el id = $id no existe", 404);
    }

    public function insertProduct($params = null)
    {
        //obtengo el body del request (json)
        $product = $this->getData();
        if (empty($product->precio) || empty($product->color) || empty($product->stock) || empty($product->id_especificacion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->precio, $product->color, $product->stock, $product->id_especificacion);
            if ($id != 0) {
                $product = $this->model->get($id);
                $this->view->response($product, 201);
            } else {
                $this->view->response("El producto no se pudo insertar", 500);
            }
        }
    }

    public function updateProduct($params = null)
    {
        $id = $params[':ID'];
        $body = $this->getData();
        if (empty($body->precio) || empty($body->color) || empty($body->stock) || empty($body->id_especificacion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $product = $this->model->get($id);
            if ($product) {
                $this->model->update($id, $body->precio, $body->color, $body->stock, $body->id_especificacion);
                $this->view->response("El producto se modificó con éxito", 200);
            } else
                $this->view->response("El producto con el id $id no existe", 404);
        }
    }
}
