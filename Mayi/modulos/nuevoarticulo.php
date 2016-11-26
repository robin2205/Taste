<?php
require 'acciones/conexion.php';?>
<h1 class="page-header" id="h1">Artículos</h1>
<p id="parrafo">Aquí puede ingresar los Artículos para su Venta.</p>
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary" id="panel-body-articulos">
      <div class="tituarti panel-heading"><h3 class="panel-title">Nuevo Artículo</h3></div>
      <div class="panel-body">
        <form class="form-inline" action="acciones/guardararticulo.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Pedido</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-archive" aria-hidden="true"></i></span>
                <select class="form-control" id="pedido" name="pedido" onchange="javascript:Traer();" required>
                <option></option>
                <?php
                $sql=mysqli_query($conexion,"select * from pedidos",0);
                while($fila=mysqli_fetch_array($sql)){
                  echo "<option value='".$fila["IdPedido"]."'>".$fila["IdPedido"]."</option>";}?>
                </select>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Referencia</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-folder-open" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="referencia" name="referencia" onkeypress="return validar_textonumero(event)" maxlength="25" required placeholder="Ingrese la Referencia" autofocus>
              </div>
            </div>
          </div>
          <div class="row" id="info"></div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Categoría</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-object-ungroup" aria-hidden="true"></i></span>
                <select class="form-control" id="categoria" name="categoria" required>
                <option></option>
                <?php
                include 'acciones/conexion.php';
                $sql=mysqli_query($conexion,"select * from categorias ORDER BY Descripcion ASC",0);
                while($fila=mysqli_fetch_array($sql)){
                  echo "<option value='".$fila["IdCategoria"]."'>".$fila["Descripcion"]."</option>";}?>
                </select>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo del Artículo</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="costo" name="costo" onkeypress="return validar_numero(event)" maxlength="7" required placeholder="Ingrese el Costo del Artículo">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Utilidad</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-pie-chart" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="utilidad" name="utilidad" onkeypress="return validar_numero(event)" maxlength="3" required placeholder="Ingrese la Utilidad del Artículo">
              </div>
            </div>
            <div class="form-group col-xs-6 col-md-3">
              <label class="hidden-xs control-label">Acción</label>
              <input class="btn btn-danger" type="button" id="calcular" name="calcular" value="Cálcular Info" onclick="javascript:Calcular();">
            </div>
          </div>
          <div class="row" id="proceso"></div>
          <div class="row">
            <div class="form-group col-xs-12 col-md-12">
              <label class="hidden-xs control-label">Foto</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                <input class="form-control btn-warning" type="file" id="foto" name="foto" required>
              </div>
            </div>
          </div><br id="espacio"/>
          <div class="row">
            <div class="form-group col-xs-6 col-md-3">
              <input type="submit" name="boton" class="btn btn-primary" value="Guardar" id="btnnewart">
            </div>
            <div class="form-group col-xs-6 col-md-3">
              <a href="menu.php?seleccion=articulos" class="btn btn-info" id="btnnewart">Atrás</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
