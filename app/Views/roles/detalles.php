<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo ?></h1>

  <form action="<?php echo base_url() . 'roles/guardaPermisos' ?>" id="form_permisos" name="form_permisos" method="POST">

    <input type="hidden" name="id_rol" value="<?php echo $id_rol ?>">

    <!-- <?php
          // foreach ($permisos as $permiso) {
          //   echo '<input type="checkbox" 
          //             value="' . $permiso['id'] . '" name="permisos[]" /> <label>' . $permiso['nombre'] . '</label>';
          //   echo '<br/>';
          // }
          ?> -->

    <?php foreach ($permisos as $permiso) { ?>
      <input type="checkbox" value="<?php echo $permiso['id'] ?>" name="permisos[]" <?php if (isset($asignado[$permiso['id']])) {
                                                                                      echo 'checked';
                                                                                    } ?> />
      <label><?php echo $permiso['nombre'] ?></label><br>
    <?php } ?>

    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>


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