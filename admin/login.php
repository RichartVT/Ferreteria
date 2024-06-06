<?php
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
require_once __DIR__ . '/views/headerSinMenu.php';
switch ($action) {
    case "logout":
        $app->logout();
        $type = "success";
        $message = '<i class="fa-solid fa-circle-check"></i> Sesión cerrada correctamente';
        $app->alert($type, $message);
        break;
    case "login":
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $login = $app->login($correo, $password);
        if ($login) {
            header('Location: index.php');
        } else {
            $type = "danger";
            $message = '<i class="fa-solid fa-circle-xmark"></i> Usuario o contraseña incorrectos';
            $app->alert($type, $message);
        }
        break;
    case 'forgot':
        include __DIR__ . '/views/login/forgot.php';
        break;
    case 'reset':
        $correo = $_POST['correo'];
        $reset = $app->reset($correo);
        if ($reset) {
            $app->alert('success', '<i class="fa-solid fa-circle-check"></i> Correo enviado correctamente');
        } else {
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> Correo no encontrado');
        }
        break;
    case 'RECOVERY':
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            if ($app->recovery($token)) {
                if (isset($_POST['password'])) {
                    $password = $_POST['password'];
                    if ($app->recovery($token, $password)) {
                        $type = "success";
                        $message = '<i class="fa-solid fa-circle-check"></i> Contraseña actualizada correctamente';
                        $app->alert($type, $message);
                        include __DIR__ . '/views/login/index.php';
                        die();
                    } else {
                        $type = "danger";
                        $message = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar la contraseña';
                        $app->alert($type, $message);
                        die();
                    }
                }
                include __DIR__ . '/views/login/recovery.php';
                die();
            }
            $app->alert('danger', '<i class="fa-solid fa-circle-xmark"></i> Token no valido');
            include 'views/login/index.php';
        }
        break;
    default:
        include __DIR__ . '/views/login/index.php';
}
