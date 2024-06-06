<?php
include __DIR__ . '/privilegios.class.php';
include __DIR__ . '/views/header.php';
$app = new Privilegio();
$app->checkRol("Administrador", true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;
$datos = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_privilegio)) {
            $app->alert('success', 'Privilegio eliminado correctamente');
        } else {
            $app->alert('danger', 'No se pudo eliminar el privilegio');
        }
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/privilegios/index.php';
        break;
}