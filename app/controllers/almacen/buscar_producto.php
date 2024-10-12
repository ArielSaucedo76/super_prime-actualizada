<?php
include('../app/config.php');

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $query = "SELECT * FROM productos WHERE codigo = '$codigo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result);
        echo json_encode($producto);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
}
?>
