<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo ?></h1>
    <?php if(isset($validation)) { ?>
        <div class="alert alert-danger">
            <?php echo $validation->listErrors();  ?>
        </div>
    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo base_url(); ?>/productos/actualizar" method="post" autocomplete="off">
                <?php csrf_field(); ?>

                <input type="hidden" class="form-control" value="<?php echo $producto['id']; ?>" id="id" name="id">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Código:</label>
                            <input type="text" class="form-control" value="<?php echo $producto['codigo']; ?>" id="codigo" name="codigo" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" value="<?php echo $producto['nombre']; ?>" id="nombre" name="nombre" required>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Unidad:</label>
                            <select class="form-control" name="id_unidad" id="id_unidad" >
                                <option value="">Seleccionar unidad</option>
                                <?php foreach ($unidades as $unidad) { ?>
                                    <option value="<?php echo $unidad['id']; ?>" <?php if($unidad['id'] == $producto['id_unidad']){ echo 'selected'; } ?>>
                                        <?php echo $unidad['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Categoría:</label>
                            <select class="form-control" name="id_categoria" id="id_categoria" >
                                <option value="">Seleccionar categoría</option>
                                <?php foreach ($categorias as $categoria) { ?>
                                    <option value="<?php echo $categoria['id'] ?>" <?php if($categoria['id'] == $producto['id_categoria']){ echo 'selected';} ?>required>
                                        <?php echo $categoria['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Precio de venta:</label>
                            <input type="text" class="form-control" value="<?php echo $producto['precio_venta']; ?>" id="precio_venta" name="precio_venta" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Precio de compra:</label>
                            <input type="text" class="form-control" value="<?php echo $producto['precio_compra']; ?>" id="precio_compra" name="precio_compra" required>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Stock mínimo:</label>
                            <input type="text" class="form-control" value="<?php echo $producto['stock_minimo']; ?>" id="stock_minimo" name="stock_minimo" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Es inventariable:</label>
                            <select class="form-control" name="inventariable" id="inventariable">
                                <option value="1" <?php if($producto['inventariable'] == '1'){ echo 'selected';} ?>>Si</option>
                                <option value="0" <?php if($producto['inventariable'] == '0'){ echo 'selected'; }?>>No</option>
                            </select>
                        </div>

                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->