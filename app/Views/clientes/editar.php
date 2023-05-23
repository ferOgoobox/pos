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
            <form action="<?php echo base_url(); ?>/clientes/actualizar" method="post" autocomplete="off">
                <?php csrf_field(); ?>

                <input type="hidden" class="form-control" value="<?php echo $cliente['id']; ?>" id="id" name="id">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" value="<?php echo $cliente['nombre']; ?>" id="nombre" name="nombre" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Dirección:</label>
                            <input type="text" class="form-control" value="<?php echo $cliente['direccion']; ?>" id="direccion" name="direccion" required>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Telefono:</label>
                            <input type="text" class="form-control" value="<?php echo $cliente['telefono']; ?>" id="telefono" name="telefono" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Correo:</label>
                            <input type="text" class="form-control" value="<?php echo $cliente['correo']; ?>" id="correo" name="correo" required>
                        </div>

                    </div>
                </div>
                
                <a href="<?php echo base_url(); ?>/clientes" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->