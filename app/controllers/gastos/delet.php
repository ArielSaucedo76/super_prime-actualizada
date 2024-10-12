<?php

include ('../../config.php');

$id_gasto = $_GET['id_gasto'];

$sentencia = $pdo->prepare("DELETE FROM tb_gasto WHERE id_gasto=:id_gasto ");

$sentencia->bindParam('id_gasto',$id_gasto);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino el gasto de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/gastos";
    </script>
    <?php
}
