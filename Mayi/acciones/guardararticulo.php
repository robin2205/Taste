<?php
session_start();
require 'conexion.php';
function filtro($var){
  $filtrado=str_replace("'","&#39;",$var);
  return $filtrado;}
$idpedido=$_POST['pedido'];
$idpedido=filtro($idpedido);
$referencia=$_POST['referencia'];
$categoria=$_POST['categoria'];
$categoria=filtro($categoria);
$costo=$_POST['costo'];
$prp=$_POST['precioreal'];
$utilidad=$_POST['utilidad'];
$pvp=$_POST['pvp'];
$costo=number_format($costo,2,'.','');
$prp=number_format($prp,2,'.','');
$pvp=number_format($pvp,2,'.','');
/*AQUÍ CAPTURO EL ARCHIVO DE LA FOTO*/
$ruta="../fotos";
$archivo=$_FILES['foto']['tmp_name'];
$nombreArchivo=$_FILES['foto']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;
$sql=mysqli_query($conexion,"INSERT INTO articulos(IdPedido,Referencia,IdCategoria,Costo,PrecioRealPesos,Utilidad,PVP,Foto)
VALUES('$idpedido','$referencia','$categoria','$costo','$prp','$utilidad','$pvp','$ruta')");
if($sql<0){?>
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
