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
                            <th>Fecha apertura</th>
                            <th>Fecha cierre</th>
                            <th>Monto inicial</th>
                            <th>Monto final</th>
                            <th>Total ventas</th>
                            <th>Estatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td><?php echo $dato['id'] ?></td>
                                <td><?php echo $dato['fecha_inicio'] ?></td>
                                <td><?php echo $dato['fecha_fin'] ?></td>
                                <td><?php echo $dato['monto_inicial'] ?></td>
                                <td><?php echo $dato['monto_final'] ?></td>
                                <td><?php echo $dato['total_ventas'] ?></td>
                                <?php if ($dato['estatus'] == 1) { ?>
                                    <td>Abierta</td>
                                    <td><a href="" data-href="<?php echo base_url() . 'cajas/cerrar/' . $dato['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" class="btn btn-danger">
                                            <i class="fas fa-lock"></i></a>
                                    </td>
                                <?php } else { ?>
                                    <td>Cerrada</td>
                                    <td><a href="" data-href="<?php echo base_url() . 'cajas/eliminar/' . $dato['id']; ?>" data-toggle="modal" data-target="#add-new" data-placement="top" title="Eliminar registro" class="btn btn-success">
                                            <i class="fas fa-print"></i></a>
                                    </td>
                                <?php } ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Desea cerrar la caja?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>