<div class="container">
    <h1>Privilegios</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="privilegios.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Privilegio</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th scope="row"><?php echo $dato['id_privilegio']; ?></th>
                        <td><?php echo $dato['privilegio']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="privilegios.php?action=UPDATE&id_privilegio=<?php echo $dato['id_privilegio']; ?>" class="btn btn-primary">Actualizar</a>
                                <a href="privilegios.php?action=DELETE&id_privilegio=<?php echo $dato['id_privilegio']; ?>" class="btn btn-danger">Eliminar</a>
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
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron ".$app->getCount()." privilegios" : "Se encontró ".$app->getCount()." privilegio"?></p>
        </div>
    </div>
</div>