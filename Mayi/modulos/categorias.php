<div id="cuerpocategorias">
  <div class="ingreso_cate col-md-5">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h1 class="panel-title">Categorías</h1>
        <span class="pull-right click"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
      </div>
      <div class="panel-body">
        <p id="parrafo">Aquí puede Ingresar la información de las Categorías nuevas.</p>
        <form class="" action="acciones/guardarcategoria.php" method="post">
          <div class="form-group col-xs-12 col-md-12">
            <label class="hidden-xs control-label">Categoría</label>
            <div class="input-group">
              <span class="input-group-addon" id="addon"><i class="fa fa-object-ungroup" aria-hidden="true"></i></span>
              <input class="form-control" type="text" id="categoria" name="categoria" onkeypress="return validar_texto(event)" maxlength="25" required placeholder="Ingrese la Categoría">
            </div>
          </div>
          <div class="form-group col-xs-12 col-md-6">
            <input type="submit" name="boton" class="btn btn-primary" value="Guardar" id="btnnewart">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="tabla_cate col-md-7">
    <h1 class="page-header" id="h1">Categorías</h1>
    <p id="parrafo">Aquí puede visualizar la información de las Categorías.</p>
    <a href="informes/infocategorias.php" class="btn btn-info" id="btninfocate">Informe Categorías</a>
    <div class="box-body">
      <table id="tablacate" class="table table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th width="30">ID</th>
            <th width="100">Descripción Categoría</th>
            <th width="80">Edición</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'acciones/conexion.php';
          $sql=mysqli_query($conexion,"SELECT * FROM categorias",0);
          while($fila=mysqli_fetch_assoc($sql)){?>
            <tr>
              <td><?=$fila['IdCategoria'];?></td>
              <td><?=$fila['Descripcion'];?></td>
              <td><a class="btn btn-xs btn-success" id="modalCate" data-toggle="modal" data-target=".editarCategoria"
                data-id="<?=$fila['IdCategoria'];?>"
                data-id2="<?=$fila['Descripcion'];?>">Editar</a></td>
            </tr>
          <?php }?>
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Descripción Categoría</th>
            <th>Edición</th>
          </tr>
          </tfoot>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
//MODAL EDITAR CATEGORÍA
$(document).ready(function(e){
  $('.editarCategoria').on('show.bs.modal',function(e){
    var idcate=$(e.relatedTarget).data().id;
    $(e.currentTarget).find('#idCategoria').val(idcate);});});
$(document).ready(function(e){
  $('.editarCategoria').on('show.bs.modal',function(e){
    var descripcion=$(e.relatedTarget).data().id2;
    $(e.currentTarget).find('#descripcion').val(descripcion);});});
</script>
<!--MODAL PARA EDITAR LA CATEGORÍA-->
<div class="modal editarCategoria" id="editarCategoria" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" id="dialog-Categoria">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h3 class="modal-title">Editar Categoría</h3>
      </div>
      <div class="modal-body custom-height-modal">
        <form name="editarCategoria" action="acciones/actualizarcategoria.php" method="post">
          <div class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Id Categoría</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="idCategoria" name="idCategoria" readonly>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Descripción</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="descripcion" name="descripcion" onkeypress="return validar_texto(event)" maxlength="25" required placeholder="Ingrese la Descripción" autofocus>
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
