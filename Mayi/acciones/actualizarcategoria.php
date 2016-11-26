<?php
session_start();
include 'conexion.php';
$idcate=$_POST['idCategoria'];
$descripcion=$_POST['descripcion'];
$sql=mysqli_query($conexion,"UPDATE categorias SET Descripcion='".$descripcion."' WHERE IdCategoria=".$idcate,0);
if($sql<0){?>
  <script>
    alert('La información no fue actualizada Correctamente.')
    location.href="../menu.php?seleccion=categorias";
  </script>
  <?php }
  else{?>
  <script>
    alert('La información fue actualizada con Éxito.')
    location.href="../menu.php?seleccion=categorias";
  </script>
<?php }?>
