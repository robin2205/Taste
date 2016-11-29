<?php
require 'conexion.php';
$id=$_POST['idcliente'];
$sql2=mysqli_query($conexion,"SELECT IdVenta FROM ventas WHERE IdCliente=".$id);
while($fila2=mysqli_fetch_array($sql2)){
  $sql3=mysqli_query($conexion,"DELETE FROM registro_pagos WHERE IdVenta=".$fila2['IdVenta']);}
$sql4=mysqli_query($conexion,"SELECT * FROM ventas WHERE IdCliente=".$id);
while($fila3=mysqli_fetch_array($sql4)){
  $sql5=mysqli_query($conexion,"DELETE FROM ventas WHERE IdVenta=".$fila3['IdVenta']);}
$sql=mysqli_query($conexion,"DELETE FROM clientes WHERE IdCliente=".$id);
if($sql<0){?>
  <script>
    alert('La información no fue eliminada del Sistema.')
    location.href="../menu.php?seleccion=clientes";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue eliminada de la Base de Datos.')
    location.href="../menu.php?seleccion=clientes";
  </script>
<?php }?>
