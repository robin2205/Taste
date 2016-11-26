<?php
include 'acciones/conexion.php';?>
<div class="contenidoarticulos col-md-12">
  <h1 class="page-header" id="h1">Ventas</h1>
  <p id="parrafo">Aquí puede visualizar la información de las Ventas que se han realizado.</p>
  <a class="btn btn-info" href="informes/informeventas.php" id="btninfoven">Informe General</a>
  <div class="table-responsive">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table id="tablaventa" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th width="10">ID</th>
                <th width="100">Cliente</th>
                <th width="100">Artículo</th>
                <th width="50">PVP</th>
                <th width="30">Fecha</th>
                <th width="100">Edición</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $sql=mysqli_query($conexion,"SELECT * FROM ventas");
            while($fila=mysqli_fetch_assoc($sql)){?>
              <tr class="table-row">
                <td><?=$fila['IdVenta'];?></td>
            <?php
            $cliente=$fila['IdCliente'];
            $sql2=mysqli_query($conexion,"SELECT *FROM clientes WHERE IdCliente=".$cliente);
            while($fila2=mysqli_fetch_assoc($sql2)){?>
                <td><?=$fila2['NombreCliente']?></td>
            <?php
            $articulo=$fila['IdArticulo'];
            $sql3=mysqli_query($conexion,"SELECT *FROM articulos WHERE IdArticulo=".$articulo);
            while($fila3=mysqli_fetch_assoc($sql3)){?>
                <td><?=$fila3['Referencia'];?></td>
                <td><?=$fila3['PVP'];?></td>
            <?php
            $sql4=mysqli_query($conexion,"SELECT MAX(Fecha) AS Fecha FROM registro_pagos WHERE IdCliente=".$fila['IdCliente']);
            if($fila4=mysqli_fetch_row($sql4)){?>
                <td><?=trim($fila4[0]);?></td>
                <td>
                  <a class="btn btn-xs btn-success" id="modalEdiVen" data-toggle="modal" data-target=".editarVentas"
                  data-id="<?=$fila['IdVenta'];?>"
                  data-id2="<?=$fila2['NombreCliente'];?>"
                  data-id3="<?=$fila4[0];?>">Editar</a>
                  <a class="btn btn-xs btn-danger" id="btneliminar" data-toggle="modal" data-target=".eliminarVenta"
                  data-id="<?=$fila['IdVenta'];?>"
                  data-id2="<?=$fila2['NombreCliente'];?>"
                  data-id3="<?=$fila3['PVP'];?>"
                  data-id4="<?=$fila4[0];?>"
                  data-id5="<?=$fila['IdCliente'];?>">Eliminar</a>
                </td>
              </tr>
            <?php }}}}?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Artículo</th>
                <th>PVP</th>
                <th>Fecha</th>
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
/*MODAL EDITAR VENTAS*/
$(document).ready(function(e){
  $('.editarVentas').on('show.bs.modal',function(e){
    var idventa=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idventa').val(idventa);});});
$(document).ready(function(e){
  $('.editarVentas').on('show.bs.modal',function(e){
    var cliente=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#cliente').val(cliente);});});
$(document).ready(function(e){
  $('.editarVentas').on('show.bs.modal',function(e){
    var fecha=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#fecha').val(fecha);});});
/*MODAL ELIMINAR VENTA*/
$(document).ready(function(e){
  $('.eliminarVenta').on('show.bs.modal',function(e){
    var idventa=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idventa').val(idventa);});});
$(document).ready(function(e){
  $('.eliminarVenta').on('show.bs.modal',function(e){
    var cliente=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#cliente').val(cliente);});});
$(document).ready(function(e){
  $('.eliminarVenta').on('show.bs.modal',function(e){
    var pvp=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#pvp').val(pvp);});});
$(document).ready(function(e){
  $('.eliminarVenta').on('show.bs.modal',function(e){
    var fecha=$(e.relatedTarget).data().id4;
    $(e.currentTarget).find('#fecha').val(fecha);});});
$(document).ready(function(e){
  $('.eliminarVenta').on('show.bs.modal',function(e){
    var idcli=$(e.relatedTarget).data().id5;
    $(e.currentTarget).find('#idcliente').val(idcli);});});
</script>
<!--MODAL EDITAR VENTA-->
<div class="modal editarVentas" id="editarVentas" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Editar Venta</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form class="form-inline" name="editarVentas" action="acciones/actualizarventas.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Id Venta</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idventa" name="idventa" readonly>
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
              <label class="hidden-xs control-label">Fecha</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input class="form-control" type="date" id="fecha" name="fecha" required autofocus>
              </div>
            </div>
          </div><br id="espacio"/>
          <input type="submit" class="btn btn-success" value="Modificar">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--MODAL ELIMINAR VENTA-->
<div class="modal eliminarVenta" id="eliminarVenta" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Eliminar Venta</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form class="form-inline" id="eliminarVenta" name="eliminarVenta" action="acciones/eliminarVenta.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Id Venta</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idventa" name="idventa" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Cliente</label>
              <input type="text" name="idcliente" id="idcliente" class="hidden">
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="cliente" name="cliente" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">PVP</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="pvp" name="pvp" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Fecha</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input class="form-control" type="date" id="fecha" name="fecha" readonly>
              </div>
            </div>
          </div><br id="espacio"/>
          <input type="submit" class="btn btn-danger" value="Eliminar">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
