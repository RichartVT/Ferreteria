<?php
include __DIR__ . '/usuarios.class.php';
include __DIR__ . '/views/header.php';
$app = new Usuario();
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_usuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case 'INSERT':
        break;
    case 'UPDATE':
        break;
    default:
        break;
}