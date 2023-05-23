<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo ?></h1>

    <div>
        <p>
            <a class="btn btn-info" href="<?php echo base_url() ?>/categorias/nuevo">Agregar</a>
            <a class="btn btn-warning" href="<?php echo base_url() ?>/categorias/eliminados">Eliminados</a>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td><?php echo $dato['id'] ?></td>
                                <td><?php echo $dato['nombre'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo base_url() ?>/categorias/editar/<?php echo $dato['id'] ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="<?php echo base_url() ?>/categorias/eliminar/<?php echo $dato['id'] ?>">
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