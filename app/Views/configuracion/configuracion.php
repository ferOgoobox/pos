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
            <form action="<?php echo base_url(); ?>configuracion/actualizar" method="post" enctype="multipart/form-data" autocomplete="off">
            <?php csrf_field(); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre de la tienda:</label>
                            <input type="text" class="form-control" id="tienda_nombre" name="tienda_nombre" 
                            value="<?php echo $nombre['valor'] ?>" autofocus required>
                        </div> 

                        <div class="col-12 col-sm-6">
                            <label for="">RFC:</label>
                            <input type="text" class="form-control" id="tienda_rfc" name="tienda_rfc"  value="<?php echo $rfc['valor'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Telefono de la tienda:</label>
                            <input type="text" class="form-control" id="tienda_telefono" name="tienda_telefono"  value="<?php echo $telefono['valor'] ?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Correo de la tienda:</label>
                            <input type="text" class="form-control" id="tienda_email" name="tienda_email"  value="<?php echo $email['valor'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Dirección de la tienda:</label>
                            <textarea class="form-control" name="tienda_direccion" id="tienda_direccion" required><?php echo $direccion['valor'] ?></textarea>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Leyenda del ticket:</label>
                            <textarea class="form-control" id="tienda_leyenda" name="tienda_leyenda" required><?php echo $leyenda['valor'] ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Logotipo:</label><br>
                            <img src="<?php echo base_url() . '/images/logotipo.png' ?>" alt="" class="img-responsive" width="200">
                            <input type="file" name="tienda_logo" id="tienda_logo" accept="image/png">
                            <p class="text-danger">*Cargar imagen en formato PNG de 150x150 pixeles</p>
                        </div>
                    </div>
                </div>


                <a href="<?php echo base_url(); ?>/unidades" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
        <a class="btn btn-danger btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>