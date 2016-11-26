<?php
require 'conexion.php';
$id=$_POST['idcliente'];
$deuda=$_POST['deuda'];
$saldo=$_POST['saldo'];
$pago=$_POST['pago'];
$fecha=$_POST['fecha'];
$opcion=$_POST['opcion'];
$nuevodeuda=0;
if($deuda!=0){
  if($saldo>=0 AND $opcion=="Si"){
    $nuevodeuda=$deuda-$pago;
    if($saldo<=$nuevodeuda){
      $nuevodeuda=$nuevodeuda-$saldo;
      $pago=$pago+$saldo;
      $saldo=0;}
    else{
        $saldo=$saldo-$nuevodeuda;
        $pago=$deuda;
        $nuevodeuda=0;}
    if($nuevodeuda<0){
      $saldo=$saldo+(($nuevodeuda)-($nuevodeuda)*2);
      $nuevodeuda=0;}}
  else{
    if($saldo>=0 AND $opcion=="No"){
      if($pago>$deuda){
        $ope=$pago-$deuda;
        $pago=$deuda;
        $saldo=$saldo+$ope;}
      $nuevodeuda=$deuda-$pago;
      if($nuevodeuda<0){
        $saldo=$saldo+(($nuevodeuda)-($nuevodeuda)*2);
        $nuevodeuda=0;}}}
  $sql=mysqli_query($conexion,"UPDATE clientes SET Deuda='$nuevodeuda',SaldoaFavor='$saldo' WHERE IdCliente=$id");
  $sql2=mysqli_query($conexion,"INSERT INTO registro_pagos(IdCliente,Pago,Fecha) VALUES('$id','$pago','$fecha')");
  if($sql<0){?>
    <script>
      alert('La información no pudo ser Actualizada Correctamente.')
      location.href="../menu.php?seleccion=clientes";
    </script>
  <?php }
  else{?>
    <script>
      alert('La información fue Actualizada con Éxito.')
      location.href="../menu.php?seleccion=clientes";
    </script>
<?php }}
else{?>
<script>
  alert('La deuda ya está pagada. Esta información no se puede Actualizar.')
  location.href="../menu.php?seleccion=clientes";
</script>
<?php }?>
