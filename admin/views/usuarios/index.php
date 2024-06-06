<div class="container">
    <h1>Usuarios</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="ususarios.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th scope="row"><?php echo $dato['id_usuario']; ?></th>
                        <td><?php echo $dato['correo']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="usuarios.php?action=UPDATE&id_usuario=<?php echo $dato['id_usuario']; ?>" class="btn btn-primary">Actualizar</a>
                                <a href="usuarios.php?action=DELETE&id_usuario=<?php echo $dato['id_usuario']; ?>" class="btn btn-danger">Eliminar</a>
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
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron " . $app->getCount() . " usuarios" : "Se encontró " . $app->getCount() . " usuario" ?></p>
        </div>
    </div>
</div>