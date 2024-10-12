<?php


$sql_clientes = "SELECT *  FROM tbl_clientes  WHERE id_cliente = '$id_cliente'";
$query_clientes = $pdo->prepare($sql_clientes);
$query_clientes->execute();

$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
foreach ( $ventas_datos as $ventas_dato ) {

    
    $id_cliente = $ventas_dato['id_cliente'];
}