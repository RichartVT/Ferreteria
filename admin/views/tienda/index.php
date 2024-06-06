<div class="container">
    <h1>Tiendas</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="tiendas.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tienda</th>
                        <th scope="col">Latitud</th>
                        <th scope="col">Longitud</th>
                        <th scope="col">Fotografia</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id_tienda']; ?></th>
                            <td><?php echo $dato['tienda']; ?></td>
                            <td><?php echo $dato['latitud']; ?></td>
                            <td><?php echo $dato['longitud']; ?></td>
                            <td><?php echo $dato['fotografia']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="tiendas.php?action=UPDATE&id_tienda=<?php echo $dato['id_tienda']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="tiendas.php?action=DELETE&id_tienda=<?php echo $dato['id_tienda']; ?>" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron " . $app->getCount() . " tiendas" : "Se encontró " . $app->getCount() . " tienda" ?></p>
        </div>
    </div>
</div>