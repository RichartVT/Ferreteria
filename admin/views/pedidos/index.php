<div class="container">
    <h1>Pedidos</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No. Pedido</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $pedido) : ?>
                <tr>
                    <td><?php echo $pedido['id_venta']; ?></td>
                    <td><?php echo $pedido['nombre'] . " " . $pedido['primer_apellido'] . " " . $pedido['segundo_apellido']; ?></td>
                    <td><?php echo $pedido['fecha']; ?></td>
                    <td><?php echo $pedido['cantidad'];?></td>
                    <td>$ <?php echo $pedido['monto'];?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="#" class="btn btn-primary">Actualizar</a>
                            <a href="#" class="btn btn-warning">Imprimir</a>
                            <a href="orders.php?action=DELETE&id_venta=<?php echo $pedido['id_venta']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>