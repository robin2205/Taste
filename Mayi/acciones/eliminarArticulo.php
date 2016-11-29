<?php
require 'conexion.php';
$id=$_POST['idArticulo'];
$sql2=mysqli_query($conexion,"SELECT Foto FROM articulos WHERE IdArticulo=".$id);
if($fila=mysqli_fetch_assoc($sql2)){
  $foto=$fila['Foto'];}
unlink($foto);
$sql4=mysqli_query($conexion,"SELECT IdVenta FROM ventas WHERE IdArticulo=".$id);
while($fila2=mysqli_fetch_array($sql4)){
  $sql3=mysqli_query($conexion,"DELETE FROM registro_pagos WHERE IdVenta=".$fila2['IdVenta']);}
$sql=mysqli_query($conexion,"DELETE FROM articulos WHERE IdArticulo=".$id);
if($sql<0){?>
  <script>
    alert('La información no fue eliminada del Sistema.')
    location.href="../menu.php?seleccion=articulos";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue eliminada de la Base de Datos.')
    location.href="../menu.php?seleccion=articulos";
  </script>
<?php }?>
