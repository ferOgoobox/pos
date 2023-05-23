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
            <form action="<?php echo base_url(); ?>/usuarios/actualizar" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">

                        <input value="<?php echo $usuario['id'] ?>" type="hidden" id="id" name="id">

                        <div class="col-12 col-sm-6">
                            <label for="">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario'] ?>" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'] ?>" required>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $usuario['password'] ?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Repite contraseña:</label>
                            <input type="password" class="form-control" id="repassword" name="repassword"  required>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Cajas:</label>
                            <select class="form-control" name="id_caja" id="id_caja" >
                                <option value="">Seleccionar caja</option>
                                <?php foreach ($cajas as $caja) { ?>
                                    <option value="<?php echo $caja['id']; ?>" <?php if($caja['id'] == $usuario['id_caja']){ echo 'selected'; } ?>>
                                        <?php echo $caja['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Roles:</label>
                            <select class="form-control" name="id_rol" id="id_rol" >
                                <option value="">Seleccionar rol</option>
                                <?php foreach ($roles as $rol) { ?>
                                    <option value="<?php echo $rol['id']; ?>" <?php if($rol['id'] == $usuario['id_rol']){ echo 'selected'; } ?>>
                                        <?php echo $rol['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->