<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de la tienda' : 'Agregar nueva tienda'; ?></h1>
    <form action="tiendas.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_tienda=' . $datos['id_tienda'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-wrench"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="tienda" placeholder="Tienda" name="tienda" value="<?php echo (isset($datos['tienda'])) ? $datos['tienda'] : '' ?>">
                        <label for="tienda">Tienda</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></i></span>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="latitud" placeholder="Latitud" name="latitud" value="<?php echo (isset($datos['latitud'])) ? $datos['latitud'] : '' ?>">
                        <label for="latitud">Latitud</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></i></span>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="longitud" placeholder="Longitud" name="longitud" value="<?php echo (isset($datos['longitud'])) ? $datos['longitud'] : '' ?>">
                        <label for="longitud">Longitud</label>
                    </div>
                </div>
                <?php if ($action == 'UPDATE') : ?>
                    <label for="">Imágen actual</label>
                    <div class="mb-3">
                        <img src="../uploads/tiendas/<?php echo $datos['fotografia']; ?>" style="width: 250px; height: 250px;">
                    </div>
                <?php endif; ?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fotografia"><i class="fa-solid fa-images"></i></label>
                    <input accept="image/*" type="file" class="form-control" id="fotografia" placeholder="Fotografia" name="fotografia" value="<?php echo (isset($datos['fotografia'])) ? $datos['fotografia'] : '' ?>">
                </div>
                <label for="">Mapa actual</label>
                <div class="mb-3">
                    <iframe class="iframe" src="https://maps.google.com/?ll=<?php echo $datos['latitud']; ?>,<?php echo $datos['longitud']; ?>&z=14&t=m&output=embed" height="600" width="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>