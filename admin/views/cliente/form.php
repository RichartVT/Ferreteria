<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información del cliente' : 'Agregar nuevo cliente'; ?></h1>
    <form action="cliente.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_cliente=' . $datos['id_cliente'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo (isset($datos['nombre'])) ? $datos['nombre'] : '' ?>">
                        <label for="nombre">Nombre</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="primer_apellido" placeholder="Primer Apellido" name="primer_apellido" value="<?php echo (isset($datos['primer_apellido'])) ? $datos['primer_apellido'] : '' ?>">
                        <label for="primer_apellido">Primer Apellido</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="segundo_apellido" placeholder="Segundo Apellido" name="segundo_apellido" value="<?php echo (isset($datos['segundo_apellido'])) ? $datos['segundo_apellido'] : '' ?>">
                        <label for="segundo_apellido">Segundo Apellido</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input pattern="[A-Z]{4}[0-9]{6}[A-Z]{3}" required="requiered" type="text" class="form-control" id="rfc" placeholder="RFC" name="rfc" value="<?php echo (isset($datos['rfc'])) ? $datos['rfc'] : '' ?>">
                        <label for="rfc">RFC</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>