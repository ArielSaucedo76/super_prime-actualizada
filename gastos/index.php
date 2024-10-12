<<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/gastos/listado_de_gastos.php');

$suma_total = 0;
foreach ($gastos_datos as $gastos_dato) {
    $suma_total += $gastos_dato['monto'];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de gastos
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Gastos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Descripcion</center></th>
                                    <th><center>Monto</center></th>
                                    <th><center>Usuario</center></th>
                                    <th><center>Fecha</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador = 0;
                                foreach ($gastos_datos as $gastos_dato){
                                 
                                    $nro_gasto = $gastos_dato['nro_gasto']; ?>
                                    <tr>
                                        <td><center><?php echo $contador = $contador + 1;?></center></td>
                                        <td><?php echo $gastos_dato['descripcion'];?></td>
                                        <td><center><?php echo $gastos_dato['monto'];?></center></td>
                                        <td><center><?php echo $gastos_dato['usuario'];?></center></td>
                                        <td><center><?php echo $gastos_dato['fyh_creacion'];?></center></td>

                                        <td><center>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-update<?php echo $id_proveedor;?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>
                                                    <!-- modal para actualizar proveedor -->
                                                    <div class="modal fade" id="modal-update<?php echo $id_gasto;?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #116f4a;color: white">
                                                                    <h4 class="modal-title">Actualización del gasto</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Descripción <b>*</b></label>
                                                                                <input type="text" id="descripciion<?php echo $id_gasto;?>" value="<?php echo $descripcion;?>" class="form-control">
                                                                                <small style="color: red;display: none" id="lbl_descripcion<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Monto <b>*</b></label>
                                                                                <input type="number" id="monto<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['monto'];?>" class="form-control">
                                                                                <small style="color: red;display: none" id="lbl_monto<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Usuario</label>
                                                                                <input type="text" id="usuario<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['usuario'];?>" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">Fecha <b>*</b></label>
                                                                                <input type="date" id="fyh_creacion<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['fyh_creacion'];?>" class="form-control">
                                                                                <small style="color: red;display: none" id="lbl_fyh_creacion<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    

                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-success" id="btn_update<?php echo $id_gasto;?>"></button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <script>
                                                        $('#btn_update<?php echo $id_gasto;?>').click(function () {

                                                            var id_gasto = '<?php echo $id_gasto;?>';
                                                            var descripcion = $('#descripcion<?php echo $id_gasto;?>').val();
                                                            var monto = $('#monto<?php echo $id_gasto;?>').val();
                                                            var usuario = $('#usuario<?php echo $id_gasto;?>').val();
                                                            var fyh_creacion = $('#fyh_creacion<?php echo $id_gasto;?>').val();
                                                           

                                                            if(nro_gasto == ""){
                                                                $('#descripcion<?php echo $id_gasto;?>').focus();
                                                                $('#lbl_descripcion<?php echo $id_gasto;?>').css('display','block');
                                                            }else if(celular == ""){
                                                                $('#monto<?php echo $id_gasto;?>').focus();
                                                                $('#lbl_monto<?php echo $id_gasto;?>').css('display','block');
                                                            }else if(empresa == ""){
                                                                $('#usuario<?php echo $id_gasto;?>').focus();
                                                                $('#lbl_usuario<?php echo $id_gasto;?>').css('display','block');
                                                            }else if(direccion == ""){
                                                                $('#fyh_creacion<?php echo $id_gasto;?>').focus();
                                                                $('#lbl_fyh_creacion<?php echo $id_gasto;?>').css('display','block');
                                                            }
                                                            else {
                                                                var url = "../app/controllers/gastos/update.php";
                                                                $.get(url,{id_gasto:id_gasto,descripcion:descripcion,monto:monto,usuario:usuario,fyh_creacion:fyh_creacion},function (datos) {
                                                                    $('#respuesta').html(datos);
                                                                });
                                                            }

                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_gasto;?>"></div>
                                                </div>



                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_gasto?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <!-- modal para borrar proveedore -->
                                                <div class="modal fade" id="modal-delete<?php echo $id_gasto;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #ca0a0b;color: white">
                                                                <h4 class="modal-title">¿Esta seguro de eliminar el gasto?</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Descripción <b>*</b></label>
                                                                            <input type="text" id="descripcion<?php echo $id_gasto;?>" value="<?php echo $descripcion;?>" class="form-control" disabled>
                                                                            <small style="color: red;display: none" id="lbl_descripcion<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Monto <b>*</b></label>
                                                                            <input type="number" id="monto<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['monto'];?>" class="form-control" disabled>
                                                                            <small style="color: red;display: none" id="lbl_monto<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                            

                                                                <div class="row">
                                                                   
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Usuario <b>*</b></label>
                                                                            <input type="text" id="usuario<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['usuario'];?>" class="form-control" disabled>
                                                                            <small style="color: red;display: none" id="lbl_usuario<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                   
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Fecha<b>*</b></label>
                                                                            <input type="date" id="fyh_creacion<?php echo $id_gasto;?>" value="<?php echo $gastos_dato['fyh_creacion'];?>" class="form-control" disabled>
                                                                            <small style="color: red;display: none" id="lbl_fyh_creacion<?php echo $id_gasto;?>">* Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                              

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_gasto;?>">Eliminar</button>
                                                            </div>
                                                            <div id="respuesta_delete<?php echo $id_gasto;?>"></div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                                <script>
                                                    $('#btn_delete<?php echo $id_gasto;?>').click(function () {

                                                        var id_proveedor = '<?php echo $id_proveedor;?>';

                                                            var url2 = "../app/controllers/gastos/delete.php";
                                                            $.get(url2,{id_gasto:id_gasto},function (datos) {
                                                                $('#respuesta_delete<?php echo $id_gasto;?>').html(datos);
                                                            });


                                                    });
                                                </script>

                                            </div>

                                                </center></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total:</strong></td>
                                        <td><input type="text" id="total_gastos" name="total_gastos" value="<?php echo number_format($suma_total, 2); ?>" readonly class="form-control">
                                        <a href="?total_gastos=<?php echo urlencode(number_format($suma_total, 2)); ?>" class="btn btn-primary btn-sm">Enviar total</a></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Gastos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Gastos",
                "infoFiltered": "(Filtrado de _MAX_ total Gastos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Gastos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>





<!-- modal para registrar proveedores -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6;color: white">
                <h4 class="modal-title">Creación de un nuevo gasto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Descripción <b>*</b></label>
                            <input type="text" id="descripcion" class="form-control">
                            <small style="color: red;display: none" id="lbl_descripcion">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Monto <b>*</b></label>
                            <input type="number" id="monto" class="form-control">
                            <small style="color: red;display: none" id="lbl_monto">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Usuario <b>*</b></label>
                            <input type="text" id="usuario" class="form-control">
                            <small style="color: red;display: none" id="lbl_usuario">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fyh_creacion" class="form-control">
                            <small style="color: red;display: none" id="lbl_fyh_creacion">* Este campo es requerido</small>
                        </div>
                    </div>
 
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar gasto</button>
            </div>
            <div id="respuesta"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function () {
        // alert("guardar");

        var descripcion = $('#descripcion').val();
        var monto = $('#monto').val();
        var usuario = $('#usuario').val();
        var fyh_creacion = $('#fyh_creacion').val();
       ;


        if(descripcion == ""){
            $('#descripcion').focus();
            $('#lbl_descrpciion').css('display','block');
        }else if(monto == ""){
            $('#monto').focus();
            $('#lbl_monto').css('display','block');
        }else if(usuario == ""){
            $('#usuario').focus();
            $('#lbl_usuario').css('display','block');
        }else if(fyh_creacion == ""){
            $('#fyh_creacion').focus();
            $('#lbl_fyh_creacion').css('display','block');
        }
        else {
            var url = "../app/controllers/gastos/create.php";
            $.get(url,{descripcion:descripcion,monto:monto,usuario:usuario,fyh_creacion:fyh_creacion},function (datos) {
                $('#respuesta').html(datos);
            });
        }


    });
</script>

<style>
    #total_gastos {
        font-weight: bold;
        text-align: right;
        background-color: #f8f9fa;
    }
</style>

<script>
function actualizarTotal() {
    var total = 0;
    $('#example1 tbody tr').each(function() {
        var monto = parseFloat($(this).find('td:eq(2)').text()) || 0;
        total += monto;
    });
    $('#total_gastos').val(total.toFixed(2));
}

// Llama a esta función después de cada operación de edición o eliminación
// Por ejemplo, en tus funciones de actualización y eliminación:
// actualizarTotal();
</script>