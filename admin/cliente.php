<?php
include __DIR__ . '/cliente.class.php';
$app = new Cliente();
include __DIR__ . '/views/header.php';
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_cliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_cliente)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Cliente eliminado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar el cliente';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/cliente/index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_cliente);
        if (isset($datos['id_cliente'])) {
            include __DIR__ . '/views/cliente/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el cliente especificada';
            $datos = $app->getAll();
            include __DIR__ . '/views/alert.php';
            include __DIR__ . '/views/cliente/index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '/views/cliente/form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Cliente registrado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el cliente';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/cliente/index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_cliente, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Cliente actualizado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar el cliente';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/cliente/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/cliente/index.php';
        break;
}
include __DIR__ . '/views/footer.php';
