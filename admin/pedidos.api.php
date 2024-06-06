<?php
header('Content-Type: application/json; charset=utf-8');
include __DIR__ . '/pedidos.class.php';
$id_venta = (isset($_GET['id_venta'])) ? $_GET['id_venta'] : null;
$action = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : null;

class Api extends Pedidos
{
    public function read()
    {
        $datos = $this->getAll();
        $datos = json_encode($datos);
        print($datos);
    }

    public function readOne($id_venta)
    {
        $datos = $this->getOne($id_venta);
        if (isset($datos['id_venta'])) {
            $datos = json_encode($datos);
            print($datos);
        } else {
            $datos['mensaje'] = "No se ha encontrado el pedido especificado";
            $datos = json_encode($datos);
            print($datos);
        }
    }

    public function deleteOne($id_venta)
    {
        $filas = $this->delete($id_venta);
        if ($filas) {
            $datos['mensaje'] = "El pedido se ha eliminado";
        } else {
            $datos['mensaje'] = "No se pudo eliminar el pedido";
        }
        $datos = json_encode($datos);
        print($datos);
    }

    public function create()
    {
        $pedido = json_decode(file_get_contents("php://input"), true);
        if ($this->insertAPI($pedido)) {
            $datos['mensaje'] = "Pedido creado correctamente";
            $datos = json_encode($datos);
            print($datos);
        } else {
            $datos['mensaje'] = "No se pudo crear el pedido";
            $datos = json_encode($datos);
            print($datos);
        }
    }
}

$app = new Api();
switch ($action) {
    case 'POST':
        $app->create();
        break;
    case 'DELETE':
        if (isset($_GET['id_venta'])) {
            $app->deleteOne($id_venta);
        }
        break;
    case 'GET':
    default:
        if (isset($_GET['id_venta'])) {
            $app->readOne($id_venta);
        } else {
            $app->read();
        }
        break;
}
?>