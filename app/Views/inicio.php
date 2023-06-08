<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (isset($mensaje)) { ?>
        <div class="alert alert-success" id="mensaje">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <?php echo $total; ?> Total de productos
                </div>
                <a href="<?php echo base_url() ?>productos" class="card-footer text-white bg-primary">Ver detalles</a>
            </div>
        </div>

        <div class="col-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    $<?php echo $totalVentas['total']; ?> Ventas del día
                </div>
                <a href="<?php echo base_url() ?>ventas" class="card-footer text-white bg-success">Ver detalles</a>
            </div>
        </div>

        <div class="col-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <?php echo $stockMinimo; ?> Productos con stock mínimo
                </div>
                <a href="<?php echo base_url() ?>productos/mostrarMinimos" class="card-footer text-white bg-danger">Ver detalles</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="col-4">
        <a href="<?php echo base_url() ?>inicio/excel" class="btn btn-primary">Generar Excel</a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Ventas por días que hace un cajero -->
<!-- Cajero que esta vendiendo más -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            datasets: [{
                label: 'Ventas por día',
                data: [30, 25, 13, 35, 15, 20, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(143, 240, 190, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(143, 240, 190, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    setTimeout(function() {
        document.getElementById('mensaje').style.display = 'none';
    }, 3000);
</script>