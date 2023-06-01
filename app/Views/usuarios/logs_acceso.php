<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>IP</th>
                            <th>Evento</th>
                            <th>Detalles</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td><?php echo $dato['rol'] ?></td>
                                <td><?php echo $dato['ip'] ?></td>
                                <td><?php echo $dato['evento'] ?></td>
                                <td><?php echo $dato['detalles'] ?></td>
                                <td><?php echo $dato['fecha_alta'] ?></td>
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
