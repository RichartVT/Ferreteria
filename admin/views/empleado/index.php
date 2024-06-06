<div class="container">
    <h1>Empleados</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="empleado.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">RFC</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <td style="vertical-align: middle;"><?php echo $dato['id_empleado']; ?></td>
                            <td style="vertical-align: middle;"><img src="<?php echo (isset($dato['fotografia'])) ? $dato['fotografia'] : '../uploads/empleados/default.png'; ?>" alt="foto" style="width: 80px; height: 80px;"></td>
                            <td style="vertical-align: middle;"><?php echo $dato['nombre']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $dato['primer_apellido']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $dato['segundo_apellido']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $dato['rfc']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $dato['curp']; ?></td>
                            <td style="vertical-align: middle;">
                                <div class="btn-group" role="group">
                                    <a href="empleado.php?action=UPDATE&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="empleado.php?action=DELETE&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-danger">Eliminar</a>
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
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron " . $app->getCount() . " empleados" : "Se encontró " . $app->getCount() . " empleado" ?></p>
        </div>
    </div>
</div>