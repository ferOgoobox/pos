<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo base_url(); ?>/compras/guarda" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" autofocus placeholder="Escribe el código y enter...">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Nombre del producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Cantidad:</label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="">Precio de compra:</label>
                            <input type="text" class="form-control" id="precio_compra" name="precio_compra">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal:</label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for=""><br>&nbsp;</label>
                            <button type="button" class="btn btn-primary" id="agregar_producto" name="agregar_producto">Agregar producto</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table id="tablaProductos" class="table table-hover table-striped table-sm table-resposive tablaProductos" width="100%">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th width="1%"></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">
                        <label for="" style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.0" style="font-weight: bold; font-size: 30px; text-align: center;">
                        <button type="button" id="completa_compra" class="btn btn-success">Completar compra</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function(){

    });

    function buscarProducto(e, tagCodigo, codigo){
        var enterKey = 13;
        if(codigo != ''){
            if(e.which == enterKey){
                $.ajax({
                    url: '<?php echo base_url() ?>/productos/buscarPorCodigo' + codigo,
                    dataType: 'json',
                    success: function(resultado){
                        if(resultado == 0){
                            $(tagCodigo).val('');
                        }else{
                            
                        }
                    }
                })
            }
        }
    }
</script>