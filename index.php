<?php
include ('app/config.php');
include ('layout/sesion.php');

include ('layout/parte1.php');
include ('app/controllers/usuarios/listado_de_usuarios.php');
include ('app/controllers/roles/listado_de_roles.php');
include ('app/controllers/categorias/listado_de_categoria.php');
include ('app/controllers/almacen/listado_de_productos.php');
include ('app/controllers/proveedores/listado_de_proveedores.php');
include ('app/controllers/compras/listado_de_compras.php');
include ('app/controllers/ventas/listado_de_ventas.php');
include ('app/controllers/clientes/listado_de_clientes.php');
?>
<style>
    .icon-gray {
        color: gray;
    }
    .icon {
        opacity: 0.5; /* Ajusta el valor de opacidad como prefieras */
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al SISTEMA de VENTAS - <?php echo $rol_sesion; ?> </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            Contenido del sistema
            <br><br>

            <div class="row">


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $contador_de_usuarios = 0;
                            foreach ($usuarios_datos as $usuarios_dato){
                                $contador_de_usuarios = $contador_de_usuarios + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_usuarios;?></h3>
                            <p>Usuarios Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/usuarios/create.php">
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/usuarios" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_de_roles = 0;
                            foreach ($roles_datos as $roles_dato){
                                $contador_de_roles = $contador_de_roles + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_roles;?></h3>
                            <p>Roles Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/roles/create.php">
                            <div class="icon">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/roles" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $contador_de_categorias = 0;
                            foreach ($categorias_datos as $categorias_dato){
                                $contador_de_categorias = $contador_de_categorias + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_categorias;?></h3>
                            <p>Categorías Registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/categorias">
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/categorias" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_de_productos = 0;
                            foreach ($productos_datos as $productos_dato){
                                $contador_de_productos = $contador_de_productos + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_productos;?></h3>
                            <p>Productos Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/almacen/create.php">
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/almacen" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>






                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <?php
                            $contador_de_proveedores = 0;
                            foreach ($proveedores_datos as $proveedores_dato){
                                $contador_de_proveedores = $contador_de_proveedores + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_proveedores;?></h3>
                            <p>Proveedores Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/proveedores">
                            <div class="icon">
                                <i class="fas fa-truck"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/proveedores" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $contador_de_compras = 0;
                            foreach ($compras_datos as $compras_dato){
                                $contador_de_compras = $contador_de_compras + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_compras;?></h3>
                            <p>Compras Registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/compras">
                            <div class="icon">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/compras" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box" style="background-color: #d291bc !important; color: white !important;">
                        <div class="inner">
                            <?php
                            $contador_de_ventas = 0;
                            foreach ($compras_datos as $compras_dato){
                                $contador_de_ventas = $contador_de_ventas + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_ventas;?></h3>
                            <p>Ventas Registradas</p>
                        </div>
                        <a href="<?php echo $URL;?>/ventas">
                            <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/ventas" class="small-box-footer">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange " style="color: white !important;">
                        <div class="inner">
                            <?php
                            $contador_de_clientes = 0;
                            foreach ($clientes_datos as $clientes_dato) {
                                $contador_de_clientes++;
                            }
                            ?>
                            <h3><?php echo $contador_de_clientes; ?></h3>
                            <p>Clientes Registrados</p>
                        </div>
                        <a href="#" class="icon" data-toggle="modal" data-target="#modal-agregar_clientes">
                            <i class="fas fa-user-plus icon-gray"></i>
                        </a>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-buscar_clientes" style="color: white !important;">
                            Más detalles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                




            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal-buscar_clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6; color: white;">
                <h4 class="modal-title">Busqueda del cliente</h4>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_clientes">
                    <i class="fa fa-users"></i> Agregar cliente
                </button>
               <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="table table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th><center>Nro</center></th>
                                <th><center>Nombre del cliente</center></th>
                                <th><center>CUIL</center></th>
                                <th><center>Celular</center></th>
                                <th><center>Correo</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador_de_clientes = 0;
                            foreach ($clientes_datos as $clientes_dato) {
                                $id_cliente = $clientes_dato['id_cliente'];
                                $contador_de_clientes++;
                            ?>
                                <tr>
                                    <td><center><?php echo $contador_de_clientes; ?></center></td>
                                    
                                    <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                    <td><center><?php echo $clientes_dato['cuil_cliente']; ?></center></td>
                                    <td><center><?php echo $clientes_dato['celular_cliente']; ?></center></td>
                                    <td><center><?php echo $clientes_dato['email_cliente']; ?></center></td>
                                </tr>
                                <script>
                                    $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function() {
                                        $('#nombre_cliente').val('<?php echo $clientes_dato['nombre_cliente']; ?>');
                                        $('#id_cliente').val('<?php echo $clientes_dato['id_cliente']; ?>');
                                        $('#cuil_cliente').val('<?php echo $clientes_dato['cuil_cliente']; ?>');
                                        $('#celular_cliente').val('<?php echo $clientes_dato['celular_cliente']; ?>');
                                        $('#email_cliente').val('<?php echo $clientes_dato['email_cliente']; ?>');
                                        $('#modal-buscar_clientes').modal('toggle');
                                    });
                                </script>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



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





<?php include ('layout/parte2.php'); ?>







