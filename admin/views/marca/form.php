<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de la marca' : 'Agregar nueva marca'; ?></h1>
    <form action="marca.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_marca=' . $datos['id_marca'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="marca" placeholder="Marca" name="marca" value="<?php echo (isset($datos['marca'])) ? $datos['marca'] : '' ?>">
                        <label for="marca">Marca</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fotografia"><i class="fa-solid fa-images"></i></label>
                    <input accept="image/*" type="file" class="form-control" id="fotografia" placeholder="Fotografia" name="fotografia" value="<?php echo (isset($datos['fotografia'])) ? $datos['fotografia'] : '' ?>">
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>