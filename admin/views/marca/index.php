<div class="container">
    <h1>Marcas</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="marca.php?action=CREATE" class="btn btn-success">Nuevo</a>
                <a href="reportes.php?action=marcas" class="btn btn-warning">Generar reporte</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Fotografia</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id_marca']; ?></th>
                            <td><?php echo $dato['marca']; ?></td>
                            <td><?php echo $dato['fotografia']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="marca.php?action=UPDATE&id_marca=<?php echo $dato['id_marca']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="marca.php?action=DELETE&id_marca=<?php echo $dato['id_marca']; ?>" class="btn btn-danger">Eliminar</a>
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
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron ".$app->getCount()." marcas" : "Se encontró ".$app->getCount()." marca"?></p>
        </div>
    </div>
</div>