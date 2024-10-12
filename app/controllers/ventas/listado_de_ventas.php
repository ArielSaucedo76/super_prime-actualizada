<?php


$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente FROM tbl_ventas as ve INNER JOIN tbl_clientes as cli on cli.id_cliente = ve.id_cliente";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);