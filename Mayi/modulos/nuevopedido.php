<h1 class="page-header" id="h1">Pedidos</h1>
<p id="parrafo">Aquí puede ingresar los Pedidos nuevos.</p>
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary" id="panel-body-pedidos">
      <div class="tituarti panel-heading"><h3 class="panel-title">Pedido Nuevo</h3></div>
      <div class="panel-body">
        <form class="form-inline" action="acciones/guardarpedido.php" method="post">
          <section class="main row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Valor Pedido&nbsp;</label><label class="hidden-xs control-label" id="advertencia">(Dolares)</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="valor" name="valor" onkeypress="return validar_numero(event)" maxlength="6" required title="Ingrese el Valor del Pedido" placeholder="Ingrese el Valor del Pedido" autofocus>
              </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo Envío&nbsp;</label><label class="hidden-xs control-label" id="advertencia">(Pesos)</label>
              <div class="input-group">
    						<span class="input-group-addon" id="addon"><i class="fa fa-money" aria-hidden="true"></i></span>
    						<input class="form-control" type="text" id="envio" name="envio" onkeypress="return validar_numero(event)" maxlength="7" title="Ingrese el Valor del Envío" required placeholder="Ingrese el Valor del Envío">
    					</div>
            </div>
          </section>
          <div class="row">
            <div class="form-group col-xs-12 col-md-6">
              <label class="hidden-xs control-label">Costo Dolar&nbsp;</label><label class="hidden-xs control-label" id="advertencia">(Pesos)</label>
              <div class="input-group">
                <span class="input-group-addon" id="addon"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
                <input class="form-control" type="text" id="dolar" name="dolar" onkeypress="return validar_numero(event)" maxlength="4" title="Ingrese el Costo del Dolar" required placeholder="Costo del Dolar">
                <span class="input-group-addon" id="addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
              </div>
            </div>
          </div><br id="espacio"/>
          <div class="row">
            <div class="form-group col-xs-6 col-md-3">
              <input type="submit" name="boton" class="btn btn-primary" value="Guardar" id="btnnewart">
            </div>
            <div class="form-group col-xs-6 col-md-3">
              <a href="menu.php?seleccion=pedidos" class="btn btn-info" id="btnnewart">Atrás</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
