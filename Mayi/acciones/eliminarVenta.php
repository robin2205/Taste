<?php
require 'conexion.php';
$idventa=$_POST['idventa'];
$pvp=$_POST['pvp'];
$idcliente=$_POST['idcliente'];
$sql=mysqli_query($conexion,"SELECT Deuda FROM clientes WHERE IdCliente=".$idcliente);
if($fila=mysqli_fetch_array($sql)){
  $newdeuda=$fila['Deuda'];}
$sql5=mysqli_query($conexion,"SELECT SUM(Pago) AS suma FROM registro_pagos WHERE IdCliente=".$idcliente);
if($fila2=mysqli_fetch_array($sql5)){
  $pagos=$fila2['suma'];}
$newdeuda=$newdeuda+$pagos;
$newdeuda=$newdeuda-$pvp-$pagos;
//Actualizamos el campo Deuda en la tabla Clientes
$sql2=mysqli_query($conexion,"UPDATE clientes SET Deuda=".$newdeuda." WHERE IdCliente=".$idcliente);
//Eliminamos el IdVenta de la tabla Ventas
$sql3=mysqli_query($conexion,"DELETE FROM ventas WHERE IdVenta=".$idventa);
//Eliminamos el IdVenta en la tabla Registro_pagos
$sql4=mysqli_query($conexion,"DELETE FROM registro_pagos WHERE IdVenta=".$idventa);
if($sql4<0){?>
  <script>
    alert('La información no fue eliminada del Sistema.')
    location.href="../menu.php?seleccion=ventas";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue eliminada de la Base de Datos.')
    location.href="../menu.php?seleccion=ventas";
  </script>
<?php }?>
