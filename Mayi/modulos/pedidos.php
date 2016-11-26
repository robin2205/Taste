<?php
include 'acciones/conexion.php';?>
<div class="contenidopedido col-md-12">
  <h1 class="page-header" id="h1">Pedidos</h1>
  <p id="parrafo">Aquí puede visualizar los Pedidos que se han realizado.</p>
  <a href="menu.php?seleccion=nuevopedido" class="btn btn-primary" id="btnpedido">Nuevo Pedido</a>
  <a href="informes/infopedidos.php" class="btn btn-info" id="btninfopedi">Info Pedidos</a>
  <div class="table-responsive">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="tablapedidos" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th width="10">ID</th>
                <th width="50">Valor</th>
                <th width="70">Valor Envío</th>
                <th width="30">Dolar</th>
                <th width="30">Incremento (%)</th>
                <th width="150">Edición</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $sql=mysqli_query($conexion,"SELECT * FROM pedidos",0);
            while($fila=mysqli_fetch_assoc($sql)){?>
              <tr>
                <td><?=$fila['IdPedido'];?></td>
                <td><?=$fila['Valor'];?></td>
                <td><?=$fila['ValorEnvio'];?></td>
                <td><?=$fila['Dolar'];?></td>
                <td><?=$fila['Incremento'];?></td>
                <td><a class="btn btn-xs btn-success" id="modalPedi" data-toggle="modal" data-target=".editarPedidos"
                  data-id="<?=$fila['IdPedido'];?>"
                  data-id2="<?=$fila['Valor'];?>"
                  data-id3="<?=$fila['ValorEnvio'];?>"
                  data-id4="<?=$fila['Dolar'];?>"
                  data-id5="<?=$fila['Incremento'];?>">Editar</a></td>
              </tr>
            <?php }?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Valor</th>
                <th>Valor Envío</th>
                <th>Dolar</th>
                <th>Incremento (%)</th>
                <th>Edición</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
//MODAL EDITAR PEDIDOSeditarPedidos
$(document).ready(function(e){
  $('.editarPedidos').on('show.bs.modal',function(e){
    var idpedido=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idpedido').val(idpedido);});});
$(document).ready(function(e){
  $('.editarPedidos').on('show.bs.modal',function(e){
    var valor=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#valor').val(valor);});});
$(document).ready(function(e){
  $('.editarPedidos').on('show.bs.modal',function(e){
    var envio=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#envio').val(envio);});});
$(document).ready(function(e){
  $('.editarPedidos').on('show.bs.modal',function(e){
    var dolar=$(e.relatedTarget).data().id4;
    $(e.currentTarget).find('#dolar').val(dolar);});});
$(document).ready(function(e){
  $('.editarPedidos').on('show.bs.modal',function(e){
    var incremento=$(e.relatedTarget).data().id5;
    $(e.currentTarget).find('#incremento').val(incremento);});});
</script>
<div class="modal editarPedidos" id="editarPedidos" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" id="dialog-Articulos">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Editar Pedidos</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form name="editarPedidos" action="acciones/actualizarpedidos.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Id Pedido</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idpedido" name="idpedido" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Valor Pedido</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="valor" name="valor" onkeypress="return validar_numero(event)" maxlength="6" required title="Ingrese el Valor del Pedido" placeholder="Ingrese el Valor del Pedido" autofocus>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo Envío</label>
              <div class="input-group">
    						<span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
    						<input class="form-control" type="text" id="envio" name="envio" onkeypress="return validar_numero(event)" maxlength="7" title="Ingrese el Valor del Envío" required placeholder="Ingrese el Valor del Envío">
    					</div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo Dolar</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="dolar" name="dolar" onkeypress="return validar_numero(event)" maxlength="4" title="Ingrese el Costo del Dolar" required placeholder="Costo del Dolar">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Incremento</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-plus" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="incremento" name="incremento" onkeypress="return validar_numero(event)" maxlength="5" required placeholder="Ingrese el Incremento">
                <span class="input-group-addon" id="addon"><i class="fa fa-percent" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-success" id="btnmodalpedi" value="Actualizar">
          <button type="button" class="btn btn-info" id="btnmodalpedi" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
