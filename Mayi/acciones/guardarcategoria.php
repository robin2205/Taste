<?php
require 'conexion.php';
$categoria=$_POST['categoria'];
$sql=mysqli_query($conexion,"INSERT INTO categorias(Descripcion) VALUES('$categoria')",0);
if($sql<0){?>
  <script>
    alert('La información no fue Registrada Correctamente.')
    location.href="../menu.php?seleccion=categorias";
  </script>
<?php }
else{?>
  <script>
    alert('La información fue registrada con Éxito.')
    location.href="../menu.php?seleccion=categorias";
  </script>
<?php }?>
