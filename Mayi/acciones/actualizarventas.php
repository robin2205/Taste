<?php
require 'conexion.php';
$id=$_POST['idventa'];
$fecha=$_POST['fecha'];
$sql2=mysqli_query($conexion,"SELECT IdRegistro,Fecha FROM registro_pagos WHERE Fecha=(SELECT MAX(Fecha) FROM registro_pagos WHERE IdVenta=".$id.") AND IdVenta=".$id);
if($n_registro=mysqli_fetch_assoc($sql2)){
  $numero=$n_registro['IdRegistro'];}
$sql=mysqli_query($conexion,"UPDATE registro_pagos SET Fecha='".$fecha."' WHERE IdRegistro=".$numero);
if($sql<0){?>
  <script>
    alert('La información no fue Registrada Correctamente.')
    location.href="../menu.php?seleccion=ventas";
  </script>
<?php }
else{?>
  <script>
    alert('La información fue registrada con Éxito.')
    location.href="../menu.php?seleccion=ventas";
  </script>
<?php }?>
