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
            <form action="<?php echo base_url(); ?>/usuarios/actualizar_password" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-6">
                            <label for="">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario'] ?>" disabled>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Confirma contraseña:</label>
                            <input type="password" class="form-control" id="repassword" name="repassword"  required>
                        </div>
                    </div>
                </div>
               
                <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Actualizar</button>

                <hr>
                <?php if(isset($mensaje)) { ?>
                    <div class="alert alert-success">
                        <?php echo $mensaje;  ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->