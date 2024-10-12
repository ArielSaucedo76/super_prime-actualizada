<?php

include ('../../config.php');

$id_gasto = $_GET['id_gasto'];
$nro_gasto = $_GET['nro_gasto'];
$descripcion = $_GET['descripcion'];
$usuario = $_GET['usuario'];
$monto = $_GET['monto'];


$sentencia = $pdo->prepare("UPDATE tb_gastos
    SET nro_gasto=:nro_gasto,
        descripcion=:descripcion,
        usuario=:usuario,
        monto=:monto,
       
        fyh_creacion=:fyh_creacion 
    WHERE id_gasto = :id_gasto ");

$sentencia->bindParam('nro_gasto',$nro_gasto);
$sentencia->bindParam('descripcion',$descripcion);
$sentencia->bindParam('usuario',$usuario);
$sentencia->bindParam('monto',$monto);
$sentencia->bindParam('fyh_creacion',$fyh_creacion);
$sentencia->bindParam('id_gasto',$id_gasto);


if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se alctualizo el gasto de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}