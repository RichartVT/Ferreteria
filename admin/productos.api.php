<?php
header("Content-Type: application/json; charset=utf-8");

include __DIR__ . "/productos.class.php";
$id_producto = isset($_GET["id_producto"]) ? $_GET["id_producto"] : null;
$action = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

class ProductosAPI extends Productos
{
    public function read()
    {
        $datos = $this->getAll();
        $datos = json_encode($datos);
        print $datos;
    }

    public function readOne($id_producto)
    {
        $datos = $this->getOne($id_producto);
        if (isset($datos['id_producto'])) {
            $datos = json_encode($datos);
            print $datos;
        } else {
            $datos['mensaje'] = "No se ha encontrado el producto especificado";
            $datos = json_encode($datos);
            print $datos;
        }
    }

    public function deleteOne($id_producto)
    {
        $filas = $this->delete($id_producto);
        if ($filas) {
            $datos['mensaje'] = "Producto eliminado correctamente";
        } else {
            $datos['mensaje'] = "No se pudo eliminar el producto";
        }
        $datos = json_encode($datos);
        print $datos;
    }

    public function create($datos)
    {
        if ($this->insert($datos)) {
            $datos['mensaje'] = "Producto añadido correctamente";
            $datos = json_encode($datos);
            print $datos;
        } else {
            $datos['mensaje'] = "Ocurrió un problema";
            $datos = json_encode($datos);
            print $datos;
        }
    }

    public function modify($id_producto, $datos)
    {
        if ($this->update($id_producto, $datos)) {
            $datos['mensaje'] = "Producto modificado correctamente";
            $datos = json_encode($datos);
            print $datos;
        } else {
            $datos['mensaje'] = "Ocurrió un problema";
            $datos = json_encode($datos);
            print $datos;
        }
    }
}

$app = new ProductosAPI();
switch ($action) {
    case "POST":
        $datos = array();
        $datos['producto'] = $_POST['producto'];
        $datos['precio'] = $_POST['precio'];
        $datos['id_marca'] = $_POST['id_marca'];
        if (isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];
            $app->modify($id_producto, $datos);
        } else {
            $app->create($datos);
        }
        break;
    case "DELETE":
        if (isset($_GET['id_producto'])) {
            $app->deleteOne($id_producto);
        }
        break;
    case "GET":
    default:
        if (isset($_GET['id_producto'])) {
            $app->readOne($id_producto);
        } else {
            $app->read();
        }
        break;
}