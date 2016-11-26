<?php
include 'acciones/conexion.php';?>
<div class="contenidoarticulos col-md-12">
  <div class="table-responsive">
    <h1 class="page-header" id="h1">Artículos</h1>
    <p id="parrafo">Aquí puede visualizar la información de los Artículos.</p>
    <a href="menu.php?seleccion=nuevoArti" class="btn btn-primary" id="btnarticulo">Nuevo Artículo</a>
    <a href="informes/infoarticulos.php" class="btn btn-info" id="btninfoarti">Info Artículos</a>
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table id="tablaarti" class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th width="10">ID</th>
                <th width="20">Foto</th>
                <th width="15">Pedido</th>
                <th width="150">Referencia</th>
                <th width="40">Categoría</th>
                <th width="20">Costo</th>
                <th width="50">PRP</th>
                <th width="20">Utilidad</th>
                <th width="30">PVP</th>
                <th width="120">Edición</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sql2=mysqli_query($conexion,"SELECT * FROM articulos");
              while($fila=mysqli_fetch_assoc($sql2)){?>
                <tr class="table-row">
                  <td><?=$fila['IdArticulo'];?></td>
                  <td><img height="100px;" id="imag" src="fotos/<?=$fila['Foto'];?>" data-action="zoom"></td>
                  <td><?=$fila['IdPedido'];?></td>
                  <td><?=$fila['Referencia'];?></td>
                <?php
                /*CAPTURO EL IDCATEGORIA*/
                $idcategoria=$fila['IdCategoria'];
                $sql3=mysqli_query($conexion,"SELECT *FROM categorias WHERE IdCategoria=".$idcategoria);
                while($fila2=mysqli_fetch_assoc($sql3)){?>
                  <td><?=$fila2['Descripcion'];?></td>
                  <td><?=$fila['Costo'];?></td>
                  <td><?=$fila['PrecioRealPesos'];?></td>
                  <td><?=$fila['Utilidad'];?></td>
                  <td><?=$fila['PVP'];?></td>
                  <td><a class="btn btn-xs btn-success" id="inicioModal" data-toggle="modal" data-target=".editarArticulos"
                    data-id="<?=$fila['IdArticulo'];?>"
                    data-id2="<?=$fila['IdPedido'];?>"
                    data-id3="<?=$fila['Referencia'];?>"
                    data-id4="<?=$fila2['Descripcion'];?>"
                    data-id5="<?=$fila['Costo'];?>"
                    data-id6="<?=$fila['PrecioRealPesos'];?>"
                    data-id7="<?=$fila['Utilidad'];?>"
                    data-id8="<?=$fila['PVP'];?>">Editar</a>
                    <a class="btn btn-xs btn-primary" id="modalVen" data-toggle="modal" data-target=".venderArticulo"
                    data-id=<?=$fila['IdArticulo'];?>
                    data-id2="<?=$fila['Referencia'];?>"
                    data-id3="<?=$fila['PVP'];?>">Venta</a>
                  </td>
                </tr>
              <?php }}?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Pedido</th>
                <th>Referencia</th>
                <th>Categoría</th>
                <th>Costo</th>
                <th>Precio Real</th>
                <th>Utilidad</th>
                <th>PVP</th>
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
//MODAL EDITAR ARTÍCULOS
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var idarticulo=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idArticulo').val(idarticulo);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var idpedido=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#idpedido').val(idpedido);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var referencia=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#referencia').val(referencia);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var categoria=$(e.relatedTarget).data().id4;
    $(e.currentTarget).find('#categoria').val(categoria);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var costo=$(e.relatedTarget).data().id5;
    $(e.currentTarget).find('#costo').val(costo);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var prp=$(e.relatedTarget).data().id6;
    $(e.currentTarget).find('#prp').val(prp);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var utilidad=$(e.relatedTarget).data().id7;
    $(e.currentTarget).find('#utilidad').val(utilidad);});});
$(document).ready(function(e){
  $('.editarArticulos').on('show.bs.modal',function(e){
    var pvp=$(e.relatedTarget).data().id8;
    $(e.currentTarget).find('#pvp').val(pvp);});});
/*MODAL VENTA ARTICULO*/
$(document).ready(function(e){
  $('.venderArticulo').on('show.bs.modal',function(e){
    var idArti=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#articulo').val(idArti);});});
$(document).ready(function(e){
  $('.venderArticulo').on('show.bs.modal',function(e){
    var ref=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#referencia').val(ref);});});
$(document).ready(function(e){
  $('.venderArticulo').on('show.bs.modal',function(e){
    var pvp=$(e.relatedTarget).data().id3;
    $(e.currentTarget).find('#pvp').val(pvp);});});
</script>
<div class="modal editarArticulos" id="editarArticulos" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" id="dialog-Articulos">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Editar Artículos</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form class="form-inline" name="editarArticulos" action="acciones/actualizararticulo.php" method="post" enctype="multipart/form-data">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-4">
              <label class="hidden-xs control-label">Id Artículo</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idArticulo" name="idArticulo" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-4">
              <label class="hidden-xs control-label">Pedido</label>
              <div class="input-group">
    						<span class="input-group-addon" id="addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
    						<input class="form-control" type="text" id="idpedido" name="idpedido" readonly>
    					</div>
            </div>
            <div class="form-group col-xs-12 col-md-4">
              <label class="hidden-xs control-label">Categoría</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-object-ungroup" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="categoria" name="categoria" readonly
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Referencia</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-folder-open" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="referencia" name="referencia" onkeypress="return validar_textonumero(event)" maxlength="25" required placeholder="Ingrese la Referencia" autofocus>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="costo" name="costo" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el Costo del Artículo">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Precio Real</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="prp" name="prp" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el PVP del Artículo">
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Utilidad</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="utilidad" name="utilidad" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el PVP del Artículo">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">PVP</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="pvp" name="pvp" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el PVP del Artículo">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-12">
              <label class="hidden-xs control-label">Foto&nbsp;</label><label class="hidden-xs control-label" id="advertencia">(Si desea cambiar la imagen que tiene el artículo, seleccione el archivo nuevo.)</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                <input class="form-control btn-warning" type="file" id="foto" name="foto">
              </div>
            </div>
          </div><br id="espacio"/>
          <input type="submit" class="btn btn-success" id="btnmodalarti" value="Actualizar">
          <button type="button" class="btn btn-info" id="btnmodalarti" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal venderArticulo" id="venderArticulo" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" id="dialog-Articulos">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Venta de Artículo</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form class="form-inline" name="venderArticulo" action="acciones/guardarventa.php" method="post">
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Artículo</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-star" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="articulo" name="articulo" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Referencia</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-folder-open" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="referencia" name="referencia" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Cliente</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <select class="form-control" id="cliente" name="cliente" required>
                <option></option>
                <?php
                $sql=mysqli_query($conexion,"select * from clientes ORDER BY NombreCliente");
                while($fila=mysqli_fetch_array($sql)){
                  echo "<option value='".$fila["IdCliente"]."'>".$fila["NombreCliente"]."</option>";}?>
                </select>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Precio</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="pvp" name="pvp" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Fecha</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input class="form-control" type="date" id="fecha" name="fecha" required>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Pago</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-book" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="pago" name="pago" onkeypress="return validar_numero(event)" maxlength="7" placeholder="Ingrese el Pago del Cliente">
              </div>
            </div>
          </div><br id="espacio"/>
          <input type="submit" class="btn btn-primary" id="btnmodalarti" value="Vender">
          <button type="button" class="btn btn-info" id="btnmodalarti" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
