<?php
$content = "
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        margin: 20px auto;
        max-width: 800px;
    }
    h1 {
        color: red;
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
<div class='container'>
    <img src='../uploads/tiendas/default.png' style='width: 100px; height: 100px;' alt='Marcas'>
    <h1>Listado de marcas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Total de productos</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $dato) {
    $content .= "
            <tr>
                <td>{$dato['id_marca']}</td>
                <td>{$dato['marca']}</td>
                <td>" . ($dato['productos'] == 1 ? $dato['productos'] . ' producto' : $dato['productos'] . ' productos') . "</td>
            </tr>";
}
$content .= "
        </tbody>
    </table>
</div>
";
?>
