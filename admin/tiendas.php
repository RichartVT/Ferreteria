<?php
require_once __DIR__ . '/tiendas.class.php';
$app = new Tienda();
include __DIR__ . '/views/header.php';
// $app->checkRol('Administrador', true);
$app->checkPrivilegio('Tienda', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_tienda = (isset($_GET['id_tienda'])) ? $_GET['id_tienda'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_tienda)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Tienda eliminada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar la tienda';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/tienda/index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_tienda);
        if (isset($datos['id_tienda'])) {
            include __DIR__ . '/views/tienda/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado la tienda especificada';
            $datos = $app->getAll();
            include __DIR__ . '/views/alert.php';
            include __DIR__ . '/views/tienda/index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '/views/tienda/form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        // $datos['fotografia'] = $_FILES['fotografia']['name'];
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Tienda registgrada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar la tienda';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/tienda/index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_tienda, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Tienda actualizada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar la tienda';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/tienda/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/tienda/index.php';
        break;
}
include __DIR__ . '/views/footer.php';
