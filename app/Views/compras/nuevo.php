<?php
$id_compra = uniqid();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?php echo base_url(); ?>/compras/guarda" method="post" id="form_compra" name="form_compra" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="hidden" id="id_producto" name="id_producto">
                            <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra ?>">
                            <label for="">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" autofocus placeholder="Escribe el código y enter..." onkeyup="buscarProducto(event, this, this.value)">
                            <label for="codigo" id="resultado_error" style="color:red;"></label>
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
                            <input type="text" class="form-control" id="precio_compra" name="precio_compra" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal:</label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" readonly disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for=""><br>&nbsp;</label>
                            <button type="button" class="btn btn-primary" id="agregar_producto" name="agregar_producto" onclick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $id_compra; ?>')">Agregar producto</button>
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
    $(document).ready(function() {
        $("#completa_compra").click(function(){
            let nFila = $("#tablaProductos tr").length;
            if (nFila < 2) {
                
            }else{
                $("#form_compra").submit();
            }
        });
    });

    function buscarProducto(e, tagCodigo, codigo) {
        var enterKey = 13;
        if (codigo != '') {
            if (e.which == enterKey) {
                $.ajax({
                    url: '<?php echo base_url() ?>/productos/buscarPorCodigo/' + codigo,
                    dataType: 'json',
                    success: function(resultado) {
                        if (resultado == 0) {
                            $(tagCodigo).val('');
                        } else {
                            $(tagCodigo).removeClass('has-error');

                            $("#resultado_error").html(resultado.error);

                            if (resultado.existe) {
                                $("#id_producto").val(resultado.datos.id);
                                $("#nombre").val(resultado.datos.nombre);
                                $("#cantidad").val(1);
                                $("#precio_compra").val(resultado.datos.precio_compra);
                                $("#subtotal").val(resultado.datos.precio_compra);
                                $("#cantidad").focus();
                            } else {
                                $("#id_producto").val('');
                                $("#nombre").val('');
                                $("#cantidad").val('');
                                $("#precio_compra").val('');
                                $("#subtotal").val('');
                            }
                        }
                    }
                })
            }
        }
    }

    function agregarProducto(id_producto, cantidad, id_compra) {

        if (id_producto != null && id_producto != 0 && cantidad > 0) {
            $.ajax({
                url: '<?php echo base_url() ?>TemporalCompra/insertar/' + id_producto + '/' + cantidad + '/' + id_compra,
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        var resultado = JSON.parse(resultado);

                        if (resultado.error == '') {
                            $("#tablaProductos tbody").empty();
                            $("#tablaProductos tbody").append(resultado.datos);
                            $("#total").val(resultado.total);

                            $("#codigo").val('');
                            $("#id_producto").val('');
                            $("#nombre").val('');
                            $("#cantidad").val('');
                            $("#precio_compra").val('');
                            $("#subtotal").val('');
                            $("#codigo").focus();
                        }
                    }
                }
            })
        }
    }

    function eliminaProducto(id_producto, id_compra) {
        $.ajax({
            url: '<?php echo base_url() ?>TemporalCompra/eliminar/' + id_producto + '/' + id_compra,
            success: function(resultado) {
                if (resultado == 0) {
                    $(tagCodigo).val('');
                } else {
                    var resultado = JSON.parse(resultado);

                    $("#tablaProductos tbody").empty();
                    $("#tablaProductos tbody").append(resultado.datos);
                    $("#total").val(resultado.total);
                }
            }
        })
    }


    // Obtener referencias a los elementos del DOM
    var cantidadInput = document.getElementById('cantidad');
    var precioInput = document.getElementById('precio_compra');
    var subtotalInput = document.getElementById('subtotal');

    // Agregar un evento de escucha al cambio en el input de cantidad
    cantidadInput.addEventListener('change', function() {
        // Obtener los valores de cantidad y precio de compra
        var cantidad = parseInt(cantidadInput.value);
        var precio = parseFloat(precioInput.value);

        // Calcular el subtotal multiplicando cantidad por precio
        var subtotal = cantidad * precio;

        // Establecer el valor del input de subtotal
        subtotalInput.value = subtotal.toFixed(3); // Redondear el subtotal a 2 decimales
    });
</script>