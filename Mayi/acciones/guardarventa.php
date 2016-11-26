<?php
require 'conexion.php';
function filtro($var){
  $filtrado=str_replace("'","&#39;",$var);
  return $filtrado;}
$idarticulo=$_POST['articulo'];
$idcliente=$_POST['cliente'];
$idcliente=filtro($idcliente);
$sql=mysqli_query($conexion,"SELECT * FROM clientes WHERE IdCliente=".$idcliente);
while($fila=mysqli_fetch_array($sql)){
  $deuda=$fila['Deuda'];
  $saldo=$fila['SaldoaFavor'];}
$pvp=$_POST['pvp'];
$fecha=$_POST['fecha'];
$pago=$_POST['pago'];
if($deuda==""){
  $deuda=0;}
if($saldo==""){
  $saldo=0;}
if($pago==""){
  $pago=0;
  $deuda=$deuda+$pvp-$pago;}
else{
  if($pago>$pvp){
    $deuda=$deuda+$pvp-$pago;
    if($deuda<0){
      $saldo=$saldo+($deuda*-1);
      $deuda=0;}
    else{
      $saldo=0;}}
  else{
    $deuda=$deuda+$pvp-$pago;}}
$saldo=number_format($saldo,2,'.','');
$pago=number_format($pago,2,'.','');
$sql2=mysqli_query($conexion,"INSERT INTO ventas(IdCliente,IdArticulo) VALUES('$idcliente','$idarticulo')");
$sql3=mysqli_query($conexion,"UPDATE clientes SET Deuda='.$deuda.',SaldoaFavor='.$saldo.'WHERE IdCliente=".$idcliente);
$sql4=mysqli_query($conexion,"SELECT MAX(IdVenta) AS IdVenta FROM ventas");
if($fila=mysqli_fetch_row($sql4)){
  $idventa=trim($fila[0]);
  $sql5=mysqli_query($conexion,"INSERT INTO registro_pagos(IdVenta,IdCliente,Pago,Fecha)
  VALUES('$idventa','$idcliente','$pago','$fecha')");}
if($sql2<0){?>
  <script>
    alert('La información no fue Registrada Correctamente.')
    location.href="../menu.php?seleccion=articulos";
  </script>
<?php }
else{?>
  <script>
    alert('La información fue registrada con Éxito.')
    location.href="../menu.php?seleccion=articulos";
  </script>
<?php }?>
