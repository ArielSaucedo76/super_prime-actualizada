<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


// Modificar la obtención de fechas
$filtrar_por_fecha = isset($_GET['filtrar_por_fecha']) ? true : false;
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

?>
<style>
    .rendimiento {
            width: 100%; /* Asegura que el input tome todo el ancho disponible */
            height: 100px; /* Ajusta la altura si es necesario */
            background-color: white; /* Color de fondo negro */
            color: black; /* Color del texto blanco */
            font-size: 30px; /* Tamaño de la fuente mayor */
            border: none; /* Quitar el borde por defecto */
            border: 2px solid blue;
            padding: 10px; /* Añadir espacio interior */
            box-sizing: border-box; /* Incluir el padding en el tamaño total */
            border-radius: 5px; /* Bordes redondeados opcionales */
            text-align: right; /* Centrar el texto */
        }

</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Movimientos de la caja</h1>
                </div>
             </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ventas registradas</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <div class="col-sm-12">
                                <form method="GET" class="float-sm-right">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                                
                                            <span class="input-group-text">
                                                <input type="checkbox" id="filtrar_por_fecha" name="filtrar_por_fecha" <?php echo $filtrar_por_fecha ? 'checked' : ''; ?>>
                                            </span>
                                        </div>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" <?php echo !$filtrar_por_fecha ? 'disabled' : ''; ?>>
                                        <input type="date" class="form-control" id="Fecha_fin" name="fecha_fin" value="<?php echo $fecha_fin; ?>" <?php echo !$filtrar_por_fecha ? 'disabled' : ''; ?>>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <input type="text" id="searchInput" placeholder="Filtrar..." onkeyup="filtrarTabla()">
                                
                                <hr>
                                <table id="tablaVentas" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th><center>Nro de venta</center></th>
                                            <th><center>Fecha de venta</center></th>
                                            <th><center>Producto</center></th>
                                            <th><center>Cantidad</center></th>
                                            <th><center>Precio de venta</center></th>
                                            <th><center>Precio de compra</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         $sql_ventas = "SELECT v.nro_venta, v.fyh_creacion, c.*, p.nombre as nombre_producto, p.descripcion, p.precio_venta, p.precio_compra, p.stock
                                         FROM tbl_ventas v
                                         INNER JOIN tb_carrito c ON v.nro_venta = c.nro_venta
                                         INNER JOIN tb_almacen p ON c.id_producto = p.id_producto";

                             // Filtrado por fecha, si se aplica
                                    if ($filtrar_por_fecha && !empty($fecha_inicio) && !empty($fecha_fin)) {
                                        $sql_ventas .= " WHERE v.fyh_creacion BETWEEN :fecha_inicio AND :fecha_fin";
                                    }

                                    // Ordenar por fecha de creación y número de venta
                                    $sql_ventas .= " ORDER BY v.fyh_creacion DESC, v.nro_venta ASC";

                                    // Preparar la consulta
                                    $query_ventas = $pdo->prepare($sql_ventas);

                                    // Enlazar parámetros de fecha si es necesario
                                    if ($filtrar_por_fecha && !empty($fecha_inicio) && !empty($fecha_fin)) {
                                        $query_ventas->bindParam(':fecha_inicio', $fecha_inicio);
                                        $query_ventas->bindParam(':fecha_fin', $fecha_fin);
                                    }

                                    // Ejecutar la consulta
                                    $query_ventas->execute();
                                    $ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);
                                        // Iterar sobre los resultados de ventas
                                        foreach ($ventas_datos as $venta) {
                                        ?>
                                        <tr>
                                            <td><center><?php echo $venta['nro_venta']; ?></center></td>
                                            <td><center><?php echo date('d/m/Y', strtotime($venta['fyh_creacion'])); ?></center></td>
                                            <td><?php echo $venta['nombre_producto']; ?></td>
                                            <td><center><?php echo $venta['cantidad']; ?></center></td>
                                            <td class="venta"><center><?php echo number_format($venta['precio_venta'], 2); ?></center></td>
                                            <td class="compra"><center><?php echo number_format($venta['precio_compra'], 2); ?></center></td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(<?php echo $venta['id_carrito']; ?>, <?php echo $venta['id_producto']; ?>, <?php echo $venta['cantidad']; ?>)">
                                                    <i class="fa fa-trash"></i></button>
                                                </center>
                                            </td>
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
                <div class="col-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">    
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="total_ventas">Total de la venta</label>
                                    <input type="text" class="form-control rendimiento" id="total_ventas" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="total_gastos">Total de los costo</label>
                                    <input type="text" class="form-control rendimiento" id="total_gastos" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rendimiento">Rendimientos</label>
                                    <input type="text" class="form-control rendimiento" id="rendimiento" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>
<script>
    // Filtrar tabla por cualquier columna
function filtrarTabla() {
    
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaVentas");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
    calcularGanancia();
}

// Activar y desactivar el filtrado por fechas
document.getElementById('filtrar_por_fecha').addEventListener('change', function() {
    var fechaInputs = document.querySelectorAll('input[type="date"]');
    fechaInputs.forEach(function(input) {
        input.disabled = !this.checked;
    }, this);
});

// Eliminar producto de la venta
function eliminarProducto(idCarrito, idProducto, cantidad) {
    if (confirm('¿Está seguro de que desea eliminar este producto de la venta?')) {
        $.ajax({
            url: '../app/controllers/ventas/eliminar_producto_venta.php',
            type: 'POST',
            data: {
                id_carrito: idCarrito,
                id_producto: idProducto,
                cantidad: cantidad
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Producto eliminado correctamente y stock actualizado.');
                    location.reload();
                } else {
                    alert('Error al eliminar el producto.');
                }
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }
        });
    }
}

function calcularGanancia() {
    console.log("Función calcularGanancia iniciada");
    let totalVenta = 0;
    let totalCompra = 0;
    let filasVisibles = document.querySelectorAll('#tablaVentas tbody tr:not(.d-none):not([style*="display: none"])');

    filasVisibles.forEach(function(fila) {
        let venta = parseFloat(fila.querySelector('.venta').innerText.replace(/[^0-9.-]+/g,""));
        let compra = parseFloat(fila.querySelector('.compra').innerText.replace(/[^0-9.-]+/g,""));

        totalVenta += venta;
        totalCompra += compra;
    });

    let ganancia = totalVenta - totalCompra;

    document.getElementById('total_ventas').value = totalVenta.toFixed(2);
    document.getElementById('total_gastos').value = totalCompra.toFixed(2);
    document.getElementById('rendimiento').value = ganancia.toFixed(2);
}

// Agregar este código para ejecutar la función al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    calcularGanancia();
});
</script>