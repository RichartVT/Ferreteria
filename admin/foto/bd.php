<?php
$contraseña = "";
$usuario = "root";
$nombre_base_de_datos = "ferreteria";
try {
    $base_de_datos = new PDO('mysql:port=3306;host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
    $base_de_datos->query("set names utf8;");
    $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    echo "Conexión exitosa";
} catch (Exception $e) {
    echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
