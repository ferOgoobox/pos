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
            <form action="<?php echo base_url(); ?>/cajas/nuevo_arqueo" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Número de caja:</label>
                            <input type="text" class="form-control" id="numero_caja" name="numero_caja" value="<?php echo $caja['id'] ?>" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $session->nombre ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Monto inicial:</label>
                            <input type="text" class="form-control" id="monto_inicial" name="monto_inicial" value="" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Folio inicial:</label>
                            <input type="text" class="form-control" id="folio" name="folio" value="<?php echo $caja['folio'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Hora:</label>
                            <input type="text" class="form-control" id="hora" name="hora" value="<?php echo date('H:i:s') ?>" required>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/cajas" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->