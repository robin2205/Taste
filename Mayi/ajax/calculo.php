<?php
$costo=$_POST['costo'];
$incremento=$_POST['incremento'];
$dolar=$_POST['dolar'];
$utilidad=$_POST['utilidad'];
$prp=($costo*(1+$incremento))*$dolar;
$pvp=$prp*$utilidad;
echo '<div class="form-group col-xs-12 col-md-6">
        <label class="hidden-xs control-label">Precio Real Pesos</label>
        <div class="input-group">
          <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
          <input class="form-control" type="text" id="precioreal" name="precioreal" value="'.$prp.'" readonly>
        </div>
      </div>
      <div class="form-group col-xs-12 col-md-6">
        <label class="hidden-xs control-label">PVP</label>
        <div class="input-group">
          <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
          <input class="form-control" type="text" id="pvp" name="pvp" value="'.$pvp.'" onkeypress="return validar_numero(event)" maxlength="9" required placeholder="Ingrese el PVP del Artículo">
        </div>
      </div>';
?>
