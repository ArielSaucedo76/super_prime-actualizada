<?php


$sql_gastos = "SELECT * FROM tb_gastos ";
$query_gastos = $pdo->prepare($sql_gastos);
$query_gastos->execute();
$gastos_datos = $query_gastos->fetchAll(PDO::FETCH_ASSOC);