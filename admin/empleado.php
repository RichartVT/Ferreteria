<?php
include __DIR__ . '/empleado.class.php';
$app = new Empleado();
include __DIR__ . '/views/header.php';
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_empleado = (isset($_GET['id_empleado'])) ? $_GET['id_empleado'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_empleado)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Empleado eliminado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar el cliente';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/empleado/index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_empleado);
        if (isset($datos['id_empleado'])) {
            include __DIR__ . '/views/empleado/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el empleado especificada';
            $datos = $app->getAll();
            include __DIR__ . '/views/alert.php';
            include __DIR__ . '/views/empleado/index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '/views/empleado/form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        // echo "<pre>";
        // print_r($datos);
        // echo "</pre>";
        // die;
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> empleado registrado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el empleado';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/empleado/index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        // echo "<pre>";
        // print_r($datos);
        // echo "</pre>";
        // die;
        if ($app->update($id_empleado, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> empleado actualizado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar el empleado';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/empleado/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/empleado/index.php';
        break;
}
include __DIR__ . '/views/footer.php';
