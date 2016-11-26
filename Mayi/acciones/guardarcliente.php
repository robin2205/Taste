<?php
require 'conexion.php';
$cliente=$_POST['cliente'];
$sql=mysqli_query($conexion,"INSERT INTO clientes(NombreCliente) VALUES('$cliente')",0);
if($sql<0){?>
  <script>
    alert('La información no fue Registrada Correctamente.')
    location.href="../menu.php?seleccion=clientes";
  </script>
<?php }
else{?>
  <script>
    alert('La información fue registrada con Éxito.')
    location.href="../menu.php?seleccion=clientes";
  </script>
<?php }?>
