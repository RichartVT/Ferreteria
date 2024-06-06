<?php
$content = "
<style>
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        color: #9d0000;
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    img {
        display: block;
        margin: 0 auto;
    }
</style>
<div style='text-align: center'>
    <img src='../uploads/productos/default.png' style='width: 100px; height: 100px;' alt='Productos'>
    <h1>Listado de productos</h1>
    <table align='center'>
        <thead>
            <tr>
                <th width='50'>ID</th>
                <th width='150'>Marca</th>
                <th width='150'>Producto</th>
                <th width='150'>Precio</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $dato) {
    $content .= "
            <tr>
                <td>{$dato['id_producto']}</td>
                <td>{$dato['marca']}</td>
                <td>{$dato['producto']}</td>
                <td>$ {$dato['precio']}</td>
            </tr>";
}
$content .= "
        </tbody>
    </table>
</div>
";
?>
