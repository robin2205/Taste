<?php
session_start();
require 'conexion.php';
$id=$_POST['idArticulo'];
$referencia=$_POST['referencia'];
$costo=$_POST['costo'];
$prp=$_POST['prp'];
$utilidad=$_POST['utilidad'];
$pvp=$_POST['pvp'];
$costo=number_format($costo,2,'.','');
$prp=number_format($prp,2,'.','');
$pvp=number_format($pvp,2,'.','');
/*AQUÍ CAPTURO EL ARCHIVO DE LA FOTO*/
$archivo=$_FILES['foto']['tmp_name'];
/*VALIDAMOS SI LA FOTO FUE CAMBIADA O NO*/
if(empty($archivo)){
  $sql=mysqli_query($conexion,"UPDATE articulos SET Referencia='".$referencia."',Costo=".$costo.",PrecioRealPesos=".$prp.",Utilidad=".$utilidad.",PVP=".$pvp."WHERE IdArticulo=".$id,0);
  if($sql<0){?>
    <script>
      alert('La información no fue actualizada Correctamente.')
      location.href="../menu.php?seleccion=articulos";
    </script>
  <?php }
  else{?>
    <script>
      alert('La información fue actualizada con Éxito.')
      location.href="../menu.php?seleccion=articulos";
    </script>
  <?php }}
else{
  $sql2=mysqli_query($conexion,"SELECT Foto FROM articulos WHERE IdArticulo=".$id);
  if($fila=mysqli_fetch_assoc($sql2)){
    $fotoanterior=$fila['Foto'];}
  unlink($fotoanterior);
  $ruta="../fotos";
  $nombreArchivo=$_FILES['foto']['name'];
  move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
  $ruta=$ruta."/".$nombreArchivo;
  $sql=mysqli_query($conexion,"UPDATE articulos SET Referencia='".$referencia."',Costo=".$costo.",PrecioRealPesos=".$prp.",Utilidad=".$utilidad.",PVP=".$pvp.",Foto='".$ruta."'WHERE IdArticulo=".$id);
  if($sql<0){?>
    <script>
      alert('La información no fue actualizada Correctamente.')
      location.href="../menu.php?seleccion=articulos";
    </script>
  <?php }
  else{?>
    <script>
      alert('La información fue actualizada con Éxito.')
      location.href="../menu.php?seleccion=articulos";
    </script>
  <?php }}?>
