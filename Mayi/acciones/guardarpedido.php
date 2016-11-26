<?php
require 'conexion.php';
$valor=$_POST['valor'];
$envio=$_POST['envio'];
$dolar=$_POST['dolar'];
$preciopesos=(($valor*$dolar)+$envio);
$incremento=(1-(($valor*$dolar)/$preciopesos));
$valor=number_format($valor,2,'.','');
$envio=number_format($envio,2,'.','');
$dolar=number_format($dolar,2,'.','');
$porcentaje=number_format($incremento,2,'.','');
$sql=mysqli_query($conexion,"INSERT INTO pedidos(Valor,ValorEnvio,Dolar,Incremento) VALUES('$valor','$envio','$dolar','$porcentaje')",0);
if($sql<0){?>
  <script>
    alert('La información no fue Registrada Correctamente.')
    location.href="../menu.php?seleccion=pedidos";
  </script>
<?php }
else{?>
  <script>
    alert('La información fue registrada con Éxito.')
    location.href="../menu.php?seleccion=pedidos";
  </script>
<?php }?>
