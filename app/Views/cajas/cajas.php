<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo ?></h1>

    <div>
        <p>
            <a class="btn btn-info" href="<?php echo base_url() ?>cajas/nuevo_arqueo">Agregar</a>
            <a class="btn btn-warning" href="<?php echo base_url() ?>cajas/eliminados">Eliminados</a>
        </p>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Folio</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td><?php echo $dato['id'] ?></td>
                                <td><?php echo $dato['nombre'] ?></td>
                                <td><?php echo $dato['folio'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo base_url() ?>cajas/arqueo/<?php echo $dato['id'] ?>">
                                        <i class="fas fa-clipboard-list"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo base_url() ?>cajas/editar/<?php echo $dato['id'] ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" 
                                        href="#" 
                                        data-toggle="modal" 
                                        data-target="#modal-confirma" 
                                        data-placement="top"
                                        data-href="<?php echo base_url() ?>cajas/eliminar/<?php echo $dato['id'] ?>"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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