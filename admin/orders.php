<?php
include __DIR__ . '/pedidos.class.php';
include __DIR__ . '/views/header.php';
$app = new Pedidos();
$app->checkRol("Administrador", true);
$id_venta = (isset($_GET['id_venta'])) ? $_GET['id_venta'] : null;
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case "DELETE":
        if ($app->delete($id_venta)) {
            $app->alert('success', 'Pedido eliminado correctamente');
            $datos = $app->getAll();
            include __DIR__ . '/views/pedidos/index.php';
        }
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/pedidos/index.php';
        break;
}
include __DIR__ . '/views/footer.php';