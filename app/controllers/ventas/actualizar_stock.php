<?php

include ('../../config.php');


$id_producto = $_GET['id_producto'];
$stock_calculado = $_GET['stock_calculado'];





$sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock  WHERE id_producto=:id_producto");

$sentencia->bindParam('id_producto',$id_producto);
$sentencia->bindParam('stock',$stock_calculado);


if($sentencia->execute()){


}else{


}






