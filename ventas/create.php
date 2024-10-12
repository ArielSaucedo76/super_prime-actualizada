<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controllers/ventas/listado_de_ventas.php');
include ('../app/controllers/almacen/listado_de_productos.php');
include ('../app/controllers/clientes/listado_de_clientes.php');



?>
  <style>
            .card-body {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .monto-pagar {
            width: 100%; /* Asegura que el input tome todo el ancho disponible */
            height: 100px; /* Ajusta la altura si es necesario */
            background-color: black; /* Color de fondo negro */
            color: white; /* Color del texto blanco */
            font-size: 50px; /* Tamaño de la fuente mayor */
            border: none; /* Quitar el borde por defecto */
            padding: 10px; /* Añadir espacio interior */
            box-sizing: border-box; /* Incluir el padding en el tamaño total */
            border-radius: 5px; /* Bordes redondeados opcionales */
            text-align: center; /* Centrar el texto */
            opacity: 1;
        }
        .monto-pagar:disabled {
            background-color: black; /* Mantiene el fondo negro cuando está deshabilitado */
            color: white; /* Mantiene el texto blanco cuando está deshabilitado */
            opacity: 1; /* Asegura que no se aplique transparencia */
        }

        .total-pagado {
            width: 100%; /* Asegura que el input tome todo el ancho disponible */
            height: 100px; /* Ajusta la altura si es necesario */
            background-color: white; /* Color de fondo negro */
            color: black; /* Color del texto blanco */
            font-size: 30px; /* Tamaño de la fuente mayor */
            border: none; /* Quitar el borde por defecto */
            border: 2px solid black;
            padding: 10px; /* Añadir espacio interior */
            box-sizing: border-box; /* Incluir el padding en el tamaño total */
            border-radius: 5px; /* Bordes redondeados opcionales */
            text-align: center; /* Centrar el texto */
        }

        .cambio {
            width: 100%; /* Asegura que el input tome todo el ancho disponible */
            height: 100px; /* Ajusta la altura si es necesario */
            background-color: white; /* Color de fondo negro */
            color: black; /* Color del texto blanco */
            font-size: 30px; /* Tamaño de la fuente mayor */
            border: none; /* Quitar el borde por defecto */
            border: 2px solid black;
            padding: 10px; /* Añadir espacio interior */
            box-sizing: border-box; /* Incluir el padding en el tamaño total */
            border-radius: 5px; /* Bordes redondeados opcionales */
            text-align: center; /* Centrar el texto */
        }

        .cambio:disabled {
            background-color: white; /* Mantiene el fondo negro cuando está deshabilitado */
            color: black; /* Mantiene el texto blanco cuando está deshabilitado */
            opacity: 1; /* Asegura que no se aplique transparencia */
        }

        input[type="text"] {
            text-align: right; /* Alinear el texto a la derecha */
        }

        .form-control::placeholder {
            text-align: left;
            padding-left: 10px; /* Ajusta según el espacio de relleno deseado */
        }

        #filtroGlobal {
            width: 300px;
            margin-left: 10px;
        }
    </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
                    <div class="col-md-12">
                       <div class="card card-outline card-success">
                           <div class="card-header">
                               <h3 class="card-title">
                                   <i class="fa fa-user-check"></i> Datos del cliente
                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_clientes">
                                       <i class="fa fa-search"></i> Buscar cliente
                                   </button>
                               </h3>
                               <div class="card-tools">
                                   <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                       <i class="fas fa-minus"></i>
                                   </button>
                               </div>
                           </div>
                           <div class="card-body">
                               <!-- Modal para buscar clientes -->
                               <div class="modal fade" id="modal-buscar_clientes">
                                   <div class="modal-dialog modal-lg">
                                       <div class="modal-content">
                                           <div class="modal-header" style="background-color: #1d36b6;color: white">
                                               <h4 class="modal-title">Búsqueda del cliente</h4>
                                               <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_clientes">
                                                   <i class="fa fa-users"></i> Agregar cliente
                                               </button>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <div class="table-responsive">
                                                   <table id="example2" class="table table-bordered table-striped table-sm">
                                                       <thead>
                                                           <tr>
                                                               <th><center>Nro</center></th>
                                                               <th><center>Seleccionar</center></th>
                                                               <th><center>Nombre del cliente</center></th>
                                                               <th><center>CUIL</center></th>
                                                               <th><center>Celular</center></th>
                                                               <th><center>Correo</center></th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                           <?php
                                                           $contador_de_clientes = 0;
                                                           foreach ($clientes_datos as $clientes_dato){
                                                               $id_cliente = $clientes_dato['id_cliente'];
                                                               $contador_de_clientes++;
                                                           ?>
                                                           <tr>
                                                               <td><center><?php echo $contador_de_clientes; ?></center></td>
                                                               <td>
                                                                   <center>
                                                                       <button id="btn_pasar_cliente<?php echo $id_cliente; ?>" class="btn btn-info">Seleccionar</button>
                                                                       <script>
                                                                           $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function () {
                                                                               $('#nombre_cliente').val('<?php echo $clientes_dato['nombre_cliente']; ?>');
                                                                               $('#id_cliente').val('<?php echo $clientes_dato['id_cliente']; ?>');
                                                                               $('#cuil_cliente').val('<?php echo $clientes_dato['cuil_cliente']; ?>');
                                                                               $('#celular_cliente').val('<?php echo $clientes_dato['celular_cliente']; ?>');
                                                                               $('#email_cliente').val('<?php echo $clientes_dato['email_cliente']; ?>');
                                                                               $('#modal-buscar_clientes').modal('toggle');
                                                                           });
                                                                       </script>
                                                                   </center>
                                                               </td>
                                                               <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                               <td><center><?php echo $clientes_dato['cuil_cliente']; ?></center></td>
                                                               <td><center><?php echo $clientes_dato['celular_cliente']; ?></center></td>
                                                               <td><center><?php echo $clientes_dato['email_cliente']; ?></center></td>
                                                           </tr>
                                                           <?php
                                                           }
                                                           ?>
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <!-- Formulario de datos del cliente -->
                               <div class="row">
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <input type="text" id="id_cliente" hidden>
                                           <input type="text" class="form-control" placeholder="Nombre del cliente" id="nombre_cliente">
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <input type="text" placeholder="CUIL del cliente" class="form-control" id="cuil_cliente">
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <input type="text" placeholder="Celular del cliente" class="form-control" id="celular_cliente">
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <input type="text" placeholder="Correo del cliente" class="form-control" id="email_cliente">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
                   
                   <div class="col-md-9">
                   <div class="row">
                   <div class="col-md-12">
                           <div class="card card-outline card-success">
                               <div class="card-header">
                                <?php
                                $contador_de_ventas = 0;
                                foreach ($ventas_datos as $ventas_dato) {
                                    $contador_de_ventas = $contador_de_ventas + 1;
                                }
                                ?>
                                   <h3 class="card-title"><i class="fa fa-shopping-bag"> </i>  Venta Nro  
                                   <input type ="text"  style="text-align:center" value="<?php echo $contador_de_ventas +1;?>" disabled></h3>
                                   <div class="card-tools">
                                       
                                   </div>

                               </div>

                                <div class="card-body">
                                    <b>Carrito  </b><button type="button" class="btn btn-primary" data-toggle="modal"
                                               data-target="#modal-buscar_producto" >
                                           <i class="fa fa-search"></i>
                                           Buscar producto
                                       </button>
                                      
                                       <!-- modal para visualizar datos de los proveedor -->
                                       <div class="modal fade" id="modal-buscar_producto">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">
                                                   <div class="modal-header" style="background-color: #1d36b6;color: white">
                                                       <h4 class="modal-title">Busqueda del producto</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <div class="table table-responsive">
                                                           <table id="example1" class="table table-bordered table-striped table-sm">
                                                               <thead>
                                                               <tr>
                                                                   <th><center>Nro</center></th>
                                                                   <th><center>Selecionar</center></th>
                                                                   <th><center>Código</center></th>
                                                                   <th><center>Categoría</center></th>
                                                                   <th><center>Imagen</center></th>
                                                                   <th><center>Nombre</center></th>
                                                                   <th><center>Descripción</center></th>
                                                                   <th><center>Stock</center></th>
                                                                   <th><center>Precio compra</center></th>
                                                                   <th><center>Precio venta</center></th>
                                                                   <th><center>Fecha compra</center></th>
                                                                   <th><center>Usuario</center></th>
                                                               </tr>
                                                               </thead>
                                                               <tbody>
                                                               <?php
                                                               $contador = 0;
                                                               foreach ($productos_datos as $productos_dato){
                                                                   $id_producto = $productos_dato['id_producto']; ?>
                                                                   <tr>
                                                                       <td><?php echo $contador = $contador + 1; ?></td>
                                                                       <td>
                                                                           <button class="btn btn-info" id="btn_selecionar<?php echo $id_producto;?>">
                                                                               Selecionar
                                                                           </button>
                                                                           <script>
                                                                               $('#btn_selecionar<?php echo $id_producto;?>').click(function () {


                                                                                   var id_producto = "<?php echo $id_producto;?>";
                                                                                   $('#id_producto').val(id_producto);
                                                                                   var producto = "<?php echo $productos_dato['nombre'];?>";
                                                                                   $('#producto').val(producto);
                                                                                   var descripcion = "<?php echo $productos_dato['descripcion'];?>";
                                                                                   $('#descripcion').val(descripcion);
                                                                                   var precio_venta = "<?php echo $productos_dato['precio_venta'];?>";
                                                                                   $('#precio_venta').val(precio_venta);
                                                                                   $('#cantidad').focus();

                                                                                 

                                                                                  // $('#modal-buscar_producto').modal('toggle');

                                                                               });
                                                                           </script>
                                                                       </td>
                                                                       <td><?php echo $productos_dato['codigo'];?></td>
                                                                       <td><?php echo $productos_dato['categoria'];?></td>
                                                                       <td>
                                                                           <img src="<?php echo $URL."/almacen/img_productos/".$productos_dato['imagen'];?>" width="50px" alt="asdf">
                                                                       </td>
                                                                       <td><?php echo $productos_dato['nombre'];?></td>
                                                                       <td><?php echo $productos_dato['descripcion'];?></td>
                                                                       <td><?php echo $productos_dato['stock'];?></td>                                                                       
                                                                       <td><?php echo $productos_dato['precio_compra'];?></td>
                                                                       <td><?php echo $productos_dato['precio_venta'];?></td>
                                                                       <td><?php echo $productos_dato['fecha_ingreso'];?></td>
                                                                       <td><?php echo $productos_dato['email'];?></td>
                                                                   </tr>
                                                                   <?php
                                                               }
                                                               ?>
                                                               </tbody>
                                                               </tfoot>
                                                           </table>
                                                           <div class="row">
                                                           <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <input type="text" id="id_producto" hidden>
                                                                    <label for="">Productos</label>
                                                                    <input type="text" id="producto" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                           <div class="col-md-5">
                                                            <div class="form-group">
                                                                    <label for="">Descripción</label>
                                                                    <input type="text" id="descripcion" class="form-control" disabled>
                                                                </div>
                                                           </div>
                                                           <div class="col-md-2">
                                                            <div class="form-group">
                                                                    <label for="">Cantidad</label>
                                                                    <input type="text" id="cantidad" class="form-control">

                                                                </div>
                                                           </div>
                                                            
                                                           <div class="col-md-2">
                                                            <div class="form-group">
                                                                    <label for="">Precio unitario</label>
                                                                    <input type="text" id="precio_venta" class="form-control" disabled>

                                                            </div>

                                                           </div>
                                                            
                                                           </div>
                                                           <button style="float: right" id="btn_registrar_carrito" class="btn btn-primary">Guardar</button>
                                                           <div id="respuesta_carrito"></div>
                                                           <script>
                                                            $('#btn_registrar_carrito').click(function () {
                                                                var nro_venta = '<?php echo $contador_de_ventas + 1; ?>';
                                                                var id_producto =$('#id_producto').val();
                                                                var cantidad =$('#cantidad').val();

                                                                if(id_producto == ""){
                                                                    alert ("Debe llenar los campos");

                                                                }else if (cantidad == ""){
                                                                    alert ("Debe llenar los campos");

                                                                }else{
                                                                    var url = "../app/controllers/ventas/registrar_carrito.php";
                                                                    $.get(url,{nro_venta:nro_venta,id_producto:id_producto,cantidad:cantidad},function (datos) {
                                                                        $('#respuesta_carrito').html(datos);
                                                                    });
                                                                }

                                                                

                                                            });

                                                           </script>
                                                           <br><br>
                                                      
                                                       </div>
                                                   </div>
                                               </div>
                                               
                                               <!-- /.modal-content -->
                                           </div>
                                           
                                           <!-- /.modal-dialog -->
                                       </div>



                                       <br><br>
                                       <div class="table-responsive">
                                        <table id="miTabla" class="table table-bordered table-sm table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; background-color: #e7e7e7;">Nro</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Productos</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Descripción</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Cantidad</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Precio unitario</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Precio subtotal</th>
                                                <th style="text-align: center; background-color: #e7e7e7;">Acción</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <?php
                                                $nro_venta = $contador_de_ventas + 1;
                                                $contador_de_carrito = 0; 
                                                $cantidad_total = 0;
                                                $precio_total =0;
                                                $sql_carrito = "SELECT * ,pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta  as precio_venta, pro.stock as stock, pro.id_producto as id_producto FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC " ;
                                                $query_carrito = $pdo->prepare($sql_carrito);
                                                $query_carrito->execute();
                                                $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($carrito_datos as $carrito_dato){
                                                $contador_de_carrito = $contador_de_carrito + 1; 
                                                $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                                $id_carrito = $carrito_dato['id_carrito'];
                                                ?>
                                                 
                                                <tr>
                                                    <td>
                                                        <center><?php echo $contador_de_carrito; ?></center>
                                                        <input type="text" value="<?php echo $carrito_dato['id_producto']; ?>" id="id_producto<?php echo $contador_de_carrito; ?>" hidden>
                                                    </td>
                                                    <td><?php echo $carrito_dato['nombre_producto']; ?></td>
                                                    <td><?php echo $carrito_dato['descripcion']; ?></td>
                                                    <td>
                                                        <center><span id="cantidad_carrito<?php echo $contador_de_carrito; ?>"><?php echo $carrito_dato['cantidad']; ?></span></center>
                                                        <input type="" value="<?php echo $carrito_dato['stock']; ?>" id="stock_de_inventario<?php echo $contador_de_carrito;?>" hidden>
                                                    </td>

                                                    <td><center><?php echo $carrito_dato['precio_venta']; ?></center></td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            $cantidad = floatval($carrito_dato['cantidad']);
                                                            $precio_venta = floatval($carrito_dato['precio_venta']);
                                                            echo $subtotal = $cantidad * $precio_venta;
                                                            $precio_total = $precio_total + $subtotal;
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <form action="../app/controllers/ventas/borrar_carrito.php" method="$_GET">
                                                                <input type="text" name="id_carrito" value="<?php echo $id_carrito;?>" hidden>
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php
                                                }

                                                
                                                
                                                ?>
                                              
                                                <tr>
                                                    <th colspan="3" style="background-color: #e7e7e7; text-align: right">Total</th>
                                                    <th><center><?php echo $cantidad_total ;?></center></th>
                                                    <th><center></center></th>
                                                    <th style="background-color: darkgoldenrod;"><center><?php echo $precio_total ;?></center></th>
                                                </tr>
                                            </tbody>


                                        </table>

                                       </div>
                                    
                                                                              
                                                                         
                                </div>
                                     
                            </div>
                                                          
                                 
                    </div>

                    </div>

                </div>
                <div class="col-md-3">

                           <div class="card card-outline card-success">
                               <div class="card-header">
                                   <h3 class="card-title"><i class="fa fa-shopping-basket"> </i> Registrar Venta  
                                   
                                   <div class="card-tools">
                                       
                                   </div>

                               </div>

                                <div class="card-body">
                                <div class="form-group">
                                    <label for="total_a_pagar">Monto a pagar</label>
                                    <input type="text" class="form-control monto-pagar" id="total_a_pagar" value="<?php echo $precio_total; ?>" disabled>
                                </div>
                                
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="total_pagado">Total pagado</label>
                                                <input type="text" class="form-control total-pagado" id="total_pagado">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cambio">Cambio</label>
                                                <input type="text" class="form-control cambio" id="cambio" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#total_pagado').keyup(function () {
                                            var total_a_pagar = $('#total_a_pagar').val();
                                            var total_pagado = $('#total_pagado').val();
                                            var cambio = parseFloat(total_pagado) - parseFloat(total_a_pagar);
                                            $('#cambio').val(cambio);
                                        });
                                    </script>
                                    <hr>
                                    <div class="form-group">
                                            <button id="btn_guardar_venta" class="btn btn-primary btn-block">Guardar venta</button>
                                            <div id="respuesta_registro_venta"></div>
                                            <script>
                                                $('#btn_guardar_venta').click( function () {
                                                    var nro_venta = '<?php echo $contador_de_ventas +1 ;?>';
                                                    var id_cliente =$('#id_cliente').val();
                                                    var total_a_pagar =$('#total_a_pagar').val();
                                                    if(id_cliente == ""){
                                                        alert('Debe ingresar los datos del cliente')
                                                    

                                                    }else{
                                                        //guardar_venta();
                                                        actualizar_stock();
                                                        guardar_venta();
                                                        
                                                   
                                                  }
                                                  

                                                  function actualizar_stock () {
                                                    var i = 1;
                                                    var n = '<?php echo $contador_de_carrito; ?>';
                                                        
                                                        for ( i = 1; i <= n; i++) {
                                                            
                                                            var a = '#stock_de_inventario' + 1;
                                                            var stock_de_inventario = $(a).val();

                                                            var b = '#cantidad_carrito' + 1 ;
                                                            var cantidad_carrito = $(b).html();

                                                            var c = '#id_producto' + 1 ;
                                                            var id_producto = $(c).val();

                                                            var stock_calculado = parseFloat(stock_de_inventario - cantidad_carrito);

                                                            var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                                            $.get(url2,{id_producto:id_producto,stock_calculado:stock_calculado},function (datos) {
                                                                 
                                                    });
                                                        }

                                                   }

                                                  function guardar_venta (){
                                                    var url = "../app/controllers/ventas/registro_de_ventas.php";
                                                        $.get(url,{nro_venta:nro_venta,id_cliente:id_cliente,total_a_pagar:total_a_pagar},function (datos) {
                                                             $('#respuesta_registro_venta').html(datos);
                                                    });


                                                  }
                                                
                                                                                               

 
                                                });
                                                
                                            </script>

                                    </div>
                         
                                </div>
 
                                     
                            </div>
                           
                                   <hr>

                                    
                </div>
    
    <!-- /.content-header -->


    <!-- Main content -->

        

    </div>
    
 
            <!-- /.row -->
</div><!-- /.container-fluid -->


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>



<script>
    $(function () {
        var table = $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
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
            // Desactivar la búsqueda predeterminada de DataTables
            "searching": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Función para filtrar la tabla
        function filtrarTabla() {
            table.search(this.value).draw();
            calcularGanancia();
        }

        // Aplicar el filtro cuando se escribe en el cuadro de texto
        $('#filtroGlobal').on('keyup', filtrarTabla);

        // Agregar estos eventos
        table.on('search.dt draw.dt', function() {
            calcularGanancia();
        });

        // Ejecutar el cálculo inicial
        calcularGanancia();
    });

    function calcularGanancia() {
        let compras = $('#example1').DataTable().column('.compra:visible').data();
        let ventas = $('#example1').DataTable().column('.venta:visible').data();
        let totalCompra = 0;
        let totalVenta = 0;

        compras.each(function(valor) {
            totalCompra += parseFloat(valor.replace(/[^0-9.-]+/g,""));
        });

        ventas.each(function(valor) {
            totalVenta += parseFloat(valor.replace(/[^0-9.-]+/g,""));
        });

        let ganancia = totalVenta - totalCompra;

        $('#rendimiento').val(ganancia.toFixed(2));
        $('#total_ventas').val(totalVenta.toFixed(2));
        $('#total_gastos').val(totalCompra.toFixed(2));
    }
</script>
<!-- modal para agregar clientes -->
<div class="modal fade" id="modal-agregar_clientes">
                                            <div class="modal-dialog modal-sm">
                                               <div class="modal-content">
                                                   <div class="modal-header" style="background-color: #b6900c;color: white">
                                                       <h4 class="modal-title">Nuevo cliente </h4>
                                                       <div style="width: 10px"></div>
                                                       
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                        <form action="../app/controllers/clientes/create.php" method="post" >
                                                            <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                <input name="nombre_cliente" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">cuil</label>
                                                                <input name="cuil_cliente" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Celular</label>
                                                                <input name="celular_cliente" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Correo</label>
                                                                <input name="email_cliente" type="email" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <button name="btn_guardar_cliente" type="submit" class="btn btn-warning btn-block">Guardar cliente</button>
                                                            </div>

                                                        </form>
                                                   </div>
                                               </div>
                                               
                                               <!-- /.modal-content -->
                                           </div>
                                           
                                           <!-- /.modal-dialog -->
                                       </div>