<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información del producto' : 'Agregar nuevo producto'; ?></h1>
    <form action="productos.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_producto=' . $datos['id_producto'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-wrench"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="producto" placeholder="Producto" name="producto" value="<?php echo (isset($datos['producto'])) ? $datos['producto'] : '' ?>">
                        <label for="producto">Producto</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></i></span>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="precio" placeholder="Precio" name="precio" value="<?php echo (isset($datos['precio'])) ? $datos['precio'] : '' ?>">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <select name="id_marca" id="selectIdMarca" class="form-select">
                            <?php foreach ($marcas as $marca) :
                                $selected = ($marca['id_marca'] == $datos['id_marca']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $marca['id_marca']; ?>" <?php echo $selected; ?>><?php echo $marca['marca']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="selectIdMarca">Marca</label>
                    </div>
                </div>
                <?php if ($action == 'UPDATE') : ?>
                    <label for="">Imágen actual</label>
                    <div class="mb-3">
                        <img src="../uploads/productos/<?php echo $datos['fotografia']; ?>" style="width: 250px; height: 250px;">
                    </div>
                <?php endif; ?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fotografia"><i class="fa-solid fa-images"></i></label>
                    <input accept="image/*" type="file" class="form-control" id="fotografia" placeholder="Fotografia" name="fotografia" value="<?php echo (isset($datos['fotografia'])) ? $datos['fotografia'] : '' ?>">
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>