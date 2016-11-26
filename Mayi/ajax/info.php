<?php
require '../acciones/conexion.php';
$idpedido=$_POST['id'];
if($idpedido!=""){
  $sql=mysqli_query($conexion,"SELECT * FROM pedidos WHERE IdPedido=".$idpedido,0);
  while($fila=mysqli_fetch_array($sql)){
  echo '<div class="form-group col-xs-12 col-md-6">
          <label class="hidden-xs control-label">Incremento</label>
          <div class="input-group" id="incremento">
            <span class="input-group-addon" id="addon"><i class="fa fa-plus" aria-hidden="true"></i></span>
            <input class="form-control" type="text" id="incremento" name="incremento" value="'.$fila['Incremento'].'" readonly>
          </div>
        </div>
        <div class="form-group col-xs-12 col-md-6">
          <label class="hidden-xs control-label">Dolar</label>
          <div class="input-group" id="dolar">
            <span class="input-group-addon" id="addon"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
            <input class="form-control" type="text" id="dolar" name="dolar" value="'.$fila['Dolar'].'" readonly>
          </div>
        </div>';}}
?>
