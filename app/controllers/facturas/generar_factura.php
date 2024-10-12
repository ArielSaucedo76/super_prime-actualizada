<?php
require('../../../fpdf186/fpdf.php'); // Ajusta el path según la ubicación de fpdf.php
require('../../../phpqrcode/phpqrcode/qrlib.php');

$id_venta_get = $_GET['id_venta'];

// Ajusta las rutas de inclusión según la estructura de directorios
include ('../../../app/config.php');
include ('../../../layout/sesion.php');
include ('../../controllers/ventas/cargar_venta.php');
include ('../../controllers/clientes/cargar_cliente.php');

// Asegúrate de que las variables $ventas_datos y $clientes_datos están definidas y cargadas correctamente
if (!isset($ventas_datos) || empty($ventas_datos)) {
    die('No se encontraron datos de la venta.');
}

$nro_venta = $ventas_datos[0]['nro_venta']; // Asumiendo que $ventas_datos es un array con datos de la venta
if (!isset($clientes_datos) || empty($clientes_datos)) {
    die('No se encontraron datos del cliente.');
}

// Clase extendida de FPDF con Footer para número de página
class PDF extends FPDF {
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear una nueva instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(90, 10, 'PrimeMarket', 0, 0, 'C');
$pdf->Cell(10, 10, 'B', 1, 0, 'C');
$pdf->Cell(80, 10, 'Factura', 0, 1, 'C');
$pdf->Ln(10);

// Información del Cliente y del Vendedor
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(95, 10, 'Fecha de Emision: ' . date('d-m-Y'), 0, 0, 'L'); // Asegúrate de tener la fecha definida
$pdf->Cell(95, 10, 'Punto de venta: 0001     Compr. Nro: ' . $nro_venta, 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);

// Encabezados de las columnas
$pdf->SetFillColor(211, 211, 211);
$pdf->Cell(95, 10, 'Razon Social', 1, 0, 'L', true);
$pdf->Cell(95, 10, 'Datos del Cliente', 1, 1, 'L', true);
$pdf->SetFont('Arial', '', 10);

// Datos del Cliente y Vendedor
foreach ($clientes_datos as $clientes_dato) {
    $pdf->Cell(95, 10, 'Nombre: SUPER PRIME', 0, 0, 'L');
    $pdf->Cell(95, 10, 'APELLIDO Y NOMBRE/RAZON SOCIAL: ' . $clientes_dato['nombre_cliente'], 0, 1, 'L');
    
    $pdf->Cell(95, 10, 'CUIT: 12-234567-89', 0, 0, 'L');
    $pdf->Cell(95, 10, 'CUIL: ' . $clientes_dato['cuil_cliente'], 0, 1, 'L');
    
    $pdf->Cell(95, 10, 'Ingresos Brutos: 123456', 0, 0, 'L');
    $pdf->Cell(95, 10, 'Celular: ' . $clientes_dato['celular_cliente'], 0, 1, 'L');
    
    $pdf->Cell(95, 10, 'Fecha de inicio de actividades: 07/07/2024', 0, 0, 'L');
    $pdf->Cell(95, 10, 'Email: ' . $clientes_dato['email_cliente'], 0, 1, 'L');
}

$pdf->Ln(4);

// Información de la Venta
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Detalle de la Venta', 0, 1, 'L');

// Definir el color de relleno (RGB)
$pdf->SetFillColor(211, 211, 211); // Color gris claro

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'Nro', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Descripcion', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'P. Unitario', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Subtotal', 1, 1, 'C', true);
$pdf->SetFont('Arial', '', 10);

$contador_de_carrito = 0;
$cantidad_total = 0;
$precio_total = 0;
$sql_carrito = "SELECT *, pro.nombre AS nombre_producto, pro.descripcion AS descripcion, pro.precio_venta AS precio_venta, pro.stock AS stock, pro.id_producto AS id_producto FROM tb_carrito AS carr INNER JOIN tb_almacen AS pro ON carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC";
$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->execute();
$carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

foreach ($carrito_datos as $carrito_dato) {
    $contador_de_carrito++;
    $cantidad_total += $carrito_dato['cantidad'];
    $cantidad = floatval($carrito_dato['cantidad']);
    $precio_venta = floatval($carrito_dato['precio_venta']);
    $subtotal = $cantidad * $precio_venta;
    $precio_total += $subtotal;

    $pdf->Cell(10, 10, $contador_de_carrito, 0, 0, 'C');
    $pdf->Cell(30, 10, $carrito_dato['nombre_producto'], 0, 0, 'L');
    $pdf->Cell(70, 10, $carrito_dato['descripcion'], 0, 0, 'L');
    $pdf->Cell(20, 10, $carrito_dato['cantidad'], 0, 0, 'C');
    $pdf->Cell(30, 10, number_format($carrito_dato['precio_venta'], 2), 0, 0, 'R');
    $pdf->Cell(30, 10, number_format($subtotal, 2), 0, 1, 'R');
}

// Total
// Definir el tamaño del borde para el cuadro completo
$cellWidth = 150;
$totalWidth = 190;

// Posición inicial
$x = $pdf->GetX();
$y = $pdf->GetY();

// Dibujar el borde externo del cuadro
$pdf->Rect($x, $y, $totalWidth, 30); // 30 es la altura del cuadro

// Subtotal
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($cellWidth, 10, 'Subtotal: $', 0, 0, 'R');
$pdf->Cell(0, 10, number_format($precio_total, 2), 0, 1, 'R');

// Espacio para impuestos
$pdf->Cell($cellWidth, 10, 'Impuestos: $', 0, 0, 'R');
$pdf->Cell(60, 10, '000', 0, 1, 'R'); // Relleno

// Total
$pdf->Cell($cellWidth, 10, 'Total: $', 0, 0, 'R');
$pdf->Cell(0, 10, number_format($precio_total, 2), 0, 1, 'R');

// Generar el código QR
$qr_data = 'Factura Nro: ' . $nro_venta . "\nCliente: " . $clientes_dato['nombre_cliente'] . "\nTotal: $" . number_format($precio_total, 2);
$qr_file = 'qr_' . $nro_venta . '.png';
QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 4);

$pdf->Ln(4);
// Añadir el código QR al PDF
$pdf->Image($qr_file, 10, $pdf->GetY(), 50, 50); // Ajusta las coordenadas y el tamaño según sea necesario

// Salvar el PDF
$pdf->Output('I', 'Factura_' . $nro_venta . '.pdf');

// Eliminar el archivo QR después de generar el PDF
unlink($qr_file);

?>
