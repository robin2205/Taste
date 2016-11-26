<?php
session_start();
require 'conexion.php';
$idcliente=$_POST['idcliente'];
$nombre=$_POST['nombre'];
$sql=mysqli_query($conexion,"UPDATE clientes SET NombreCliente='".$nombre."' WHERE IdCliente=".$idcliente,0);
if($sql<0){?>
  <script>
    alert('La información no fue actualizada Correctamente.')
    location.href="../menu.php?seleccion=clientes";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue actualizada con Éxito.')
    location.href="../menu.php?seleccion=clientes";
  </script>
<?php }?>
