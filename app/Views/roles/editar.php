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
            <form action="<?php echo base_url(); ?>/roles/actualizar" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <input value="<?php echo $datos['id'] ?>" type="hidden" id="id" name="id">

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input value="<?php echo $datos['nombre'] ?>" type="text" class="form-control" id="nombre" name="nombre"  autofocus required>
                        </div>

                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->