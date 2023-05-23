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
            <form action="<?php echo base_url(); ?>/productos/insertar" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo set_value('codigo')?>" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre')?>" required>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Unidad:</label>
                            <select class="form-control" name="id_unidad" id="id_unidad" required>
                                <option value="">Seleccionar unidad</option>
                                <?php foreach($unidades as $unidad) { ?>
                                    <option value="<?php echo $unidad['id']; ?>" <?php echo set_select('id_unidad', $unidad['id']); ?>>
                                    <?php echo $unidad['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Categoría:</label>
                            <select class="form-control" name="id_categoria" id="id_categoria" required>
                                <option value="">Seleccionar categoría</option>
                                <?php foreach($categorias as $categoria) { ?>
                                    <option value="<?php echo $categoria['id'] ?>" <?php echo set_select('id_categoria', $categoria['id']); ?>>
                                    <?php echo $categoria['nombre'] ?></option>
                                 <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Precio de venta:</label>
                            <input type="text" class="form-control" id="precio_venta" name="precio_venta" value="<?php echo set_value('precio_venta')?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Precio de compra:</label>
                            <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo set_value('precio_compra')?>" required>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Stock mínimo:</label>
                            <input type="text" class="form-control" id="stock_minimo" name="stock_minimo" value="<?php echo set_value('stock_minimo')?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Es inventariable:</label>
                            <select class="form-control" name="inventariable" id="inventariable">
                                 <option value="1" <?php echo set_select('inventariable', '1'); ?>>Si</option>
                                 <option value="0" <?php echo set_select('inventariable', '0'); ?>>No</option>
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