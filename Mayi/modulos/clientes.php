<div class="clientes col-md-5">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h1 class="panel-title">Clientes</h1>
      <span class="pull-right click"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
    </div>
    <div class="panel-body">
      <p id="parrafo">Aquí puede Ingresar la información de los Clientes nuevos.</p>
      <form class="" action="acciones/guardarcliente.php" method="post">
        <div class="form-group col-xs-12 col-md-12">
          <label class="hidden-xs control-label">Clientes</label>
          <div class="input-group">
            <span class="input-group-addon" id="addon"><i class="fa fa-user-plus" aria-hidden="true"></i></i></span>
            <input class="form-control" type="text" id="cliente" name="cliente" onkeypress="return validar_texto(event)" title="Ingrese el nombre del Cliente" maxlength="100" required placeholder="Ingrese el Cliente">
          </div>
        </div>
        <div class="form-group col-xs-12 col-md-6">
          <input type="submit" name="boton" class="btn btn-primary" value="Guardar" id="btnnewart">
        </div>
      </form>
    </div>
  </div>
</div>
<div class="tabla_clientes col-md-12">
  <h1 class="page-header" id="h1">Clientes</h1>
  <p id="parrafo">Aquí puede visualizar la información de los Clientes.</p>
  <a href="informes/infoclientes.php" class="btn btn-info" id="btninfocli">Informe de Clientes</a>
  <div class="box-body">
    <table id="tablaclientes" class="table table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th width="10">ID</th>
          <th width="100">Nombre Cliente</th>
          <th width="70">Debe</th>
          <th width="90">Saldo a Favor</th>
          <th width="70">Fecha</th>
          <th width="100">Edición</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'acciones/conexion.php';
        $sql=mysqli_query($conexion,"SELECT * FROM clientes");
        while($fila=mysqli_fetch_assoc($sql)){?>
          <tr>
            <td><?=$fila['IdCliente'];?></td>
            <td><?=$fila['NombreCliente'];?></td>
            <td><?=$fila['Deuda'];?></td>
            <td><?=$fila['SaldoaFavor'];?></td>
        <?php
        $sql3=mysqli_query($conexion,"SELECT MAX(Fecha) AS Fecha FROM registro_pagos WHERE IdCliente=".$fila['IdCliente']);
        if($fila3=mysqli_fetch_row($sql3)){?>
            <td><?=trim($fila3[0]);?></td>
            <td>
              <a class="btn btn-xs btn-success" id="modalCliente" data-toggle="modal" data-target=".editarCliente"
              data-id="<?=$fila['IdCliente'];?>"
              data-id2="<?=$fila['NombreCliente'];?>">Editar</a>
              <a class="btn btn-xs btn-primary" id="modalModiVen" data-toggle="modal" data-target=".modificarVenta"
              data-id="<?=$fila['IdCliente'];?>"
              data-id2="<?=$fila['NombreCliente'];?>"
              data-id3="<?=$fila['Deuda'];?>"
              data-id4="<?=$fila['SaldoaFavor'];?>">Modificar</a>
              <a class="btn btn-xs btn-info" href="javascript:VentasCliente(<?=$fila['IdCliente'];?>);">Detalles</a>
            </td>
          </tr>
        <?php }}?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Nombre Cliente</th>
          <th>Debe</th>
          <th>Saldo a Favor</th>
          <th>Fecha</th>
          <th>Edición</th>
        </tr>
        </tfoot>
    </table>
  </div>
</div>
<script type="text/javascript">
/*FUNCIÓN PARA IMPRIMIR INFORME DE VENTAS POR CLIENTE*/
function VentasCliente(idCliente){
  var id=idCliente;
  if(id!=null){
    window.location="informes/infoventascliente.php?idCliente="+id;}}
//MODAL EDITAR CATEGORÍA
$(document).ready(function(e){
  $('.editarCliente').on('show.bs.modal',function(e){
    var idcliente=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idcliente').val(idcliente);});});
$(document).ready(function(e){
  $('.editarCliente').on('show.bs.modal',function(e){
    var nombre=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#nombre').val(nombre);});});
/*MODAL MODIFICAR VENTA*/
$(document).ready(function(e){
  $('.modificarVenta').on('show.bs.modal',function(e){
    var idcliente=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idcliente').val(idcliente);});});
$(document).ready(function(e){
  $('.modificarVenta').on('show.bs.modal',function(e){
    var cliente=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#cliente').val(cliente);});});
$(document).ready(function(e){
  $('.modificarVenta').on('show.bs.modal',function(e){
    var deuda=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#deuda').val(deuda);});});
$(document).ready(function(e){
  $('.modificarVenta').on('show.bs.modal',function(e){
    var saldo=$(e.relatedTarget).data().id4;
    $(e.currentTarget).find('#saldo').val(saldo);});});
</script>
<!--MODAL PARA EDITAR LA CATEGORÍA-->
<div class="modal editarCliente" id="editarCliente" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Editar Cliente</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form name="editarCliente" action="acciones/actualizarcliente.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-4">
              <label class="hidden-xs control-label">Id Cliente</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idcliente" name="idcliente" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-8">
              <label class="hidden-xs control-label">Nombre Cliente</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="nombre" name="nombre" onkeypress="return validar_texto(event)" maxlength="100" required placeholder="Ingrese el Nombre" autofocus>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-success" id="btnmodalarti" value="Actualizar">
          <button type="button" class="btn btn-info" id="btnmodalarti" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--MODAL MODIFICAR VENTA-->
<div class="modal modificarVenta" id="modificarVenta" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Modificar Deuda</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form class="form-inline" name="modificarVenta" action="acciones/modificarventa.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Id Cliente</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idcliente" name="idcliente" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Cliente</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="cliente" name="cliente" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Deuda</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="deuda" name="deuda" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Saldo a Favor</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="saldo" name="saldo" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Pago</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="pago" name="pago" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el Pago" autofocus>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Fecha</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input class="form-control" type="date" id="fecha" name="fecha" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Utilizar Saldo a Favor</label>
              <div class="input-group">
                <label class="radio-inline"><input type="radio" id="opcion" name="opcion" value="Si">Si</label>
                <label class="radio-inline"><input type="radio" id="opcion" name="opcion" value="No" checked>No</label>
              </div>
            </div>
          </div><br id="espacio"/>
          <input type="submit" class="btn btn-success" value="Actualizar">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
