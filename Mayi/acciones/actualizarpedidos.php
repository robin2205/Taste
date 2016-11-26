<?php
session_start();
require 'conexion.php';
$idpedido=$_POST['idpedido'];
$valor=$_POST['valor'];
$envio=$_POST['envio'];
$dolar=$_POST['dolar'];
$incremento=$_POST['incremento'];
$valor=number_format($valor,2,'.','');
$envio=number_format($envio,2,'.','');
$dolar=number_format($dolar,2,'.','');
$incremento=number_format($incremento,2,'.','');
$sql=mysqli_query($conexion,"UPDATE pedidos SET Valor=".$valor.",ValorEnvio=".$envio.",Dolar=".$dolar.",Incremento=".$incremento." WHERE IdPedido=".$idpedido,0);
if($sql<0){?>
  <script>
    alert('La información no fue actualizada Correctamente.')
    location.href="../menu.php?seleccion=pedidos";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue actualizada con Éxito.')
    location.href="../menu.php?seleccion=pedidos";
  </script>
<?php }?>
