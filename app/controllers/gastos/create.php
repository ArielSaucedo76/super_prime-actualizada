<?php

include ('../../config.php');


$descripcion = $_GET['descripcion'];
$monto = $_GET['monto'];
$usuario = $_GET['usuario'];
$fechaHora = date('Y-m-d H:i:s'); // Agregamos esta línea para definir $fechaHora


$sentencia = $pdo->prepare("INSERT INTO tb_gastos
       (descripcion, monto, usuario, fyh_creacion) 
VALUES (:descripcion, :monto, :usuario, :fyh_creacion)");


$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':monto', $monto);
$sentencia->bindParam(':usuario', $usuario);
$sentencia->bindParam(':fyh_creacion', $fechaHora);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se registró el gasto de la manera correcta";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}
