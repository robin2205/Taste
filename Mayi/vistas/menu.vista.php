<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <script src="https://use.fontawesome.com/76cc39d280.js"></script>
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/zoom.css">
		<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <script  type="text/javascript">
    function validar_texto(e){
    	tecla=(document.all)?e.keyCode:e.which;
    	if (tecla==8) return true;
    	patron=/[A-Za-z\sáéíóúñ]/;
    	tecla_final=String.fromCharCode(tecla);
    	return patron.test(tecla_final);}
		function validar_textonumero(e){
    	tecla=(document.all)?e.keyCode:e.which;
    	if (tecla==8) return true;
    	patron=/[A-Za-z0-9\sáéíóú-]/;
    	tecla_final=String.fromCharCode(tecla);
    	return patron.test(tecla_final);}
    function validar_numero(e){
    	tecla=(document.all)?e.keyCode:e.which;
    	if (tecla==8) return true;
    	patron=/[0-9\.]/;
    	tecla_final=String.fromCharCode(tecla);
    	return patron.test(tecla_final);}
    function Traer(){
      var id=$('#pedido').val();
      $.ajax({
        type:'post',
        url:'ajax/info.php',
        data:('id='+id),
        success:function(respuesta){
            $('#info').html(respuesta);}})}
    function Calcular(){
      var costo=$('#costo').val();
      var incremento=$('input:text[name=incremento]').val();
      var dolar=$('input:text[name=dolar]').val();
      var utilidad=$('#utilidad').val();
      $.ajax({
        type:'post',
        url:'ajax/calculo.php',
        data:('costo='+costo+'&incremento='+incremento+'&dolar='+dolar+'&utilidad='+utilidad),
        success:function(respuesta){
          $('#proceso').html(respuesta);}})}
    function activar(){
      document.informes.infobus.disabled=false;
      document.informes.cliente.disabled=true;}
    function activar2(){
      document.informes.infobus.disabled=true;
      document.informes.cliente.disabled=false;}
    function desactivar(){
      document.informes.infobus.disabled=true;
      document.informes.cliente.disabled=true;}
    </script>
    <title>Taste</title>
  </head>
  <body id="cuerpomenu">
    <img id="background2" src="imagenes/fondo.png">
    <div id="wrapper">
      <!--BARRA LATERAL MENÚ-->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand">Menú<i class="fa fa-bars" aria-hidden="true"></i></li>
          <hr class="border">
          <li>
            <a href="menu.php?seleccion=inicio"><i class="fa fa-home" aria-hidden="true"></i>Inicio</a>
          </li>
          <li><a><i class="fa fa-book" aria-hidden="true"></i>Gestiones<span class="caret"></span></a>
            <ul>
              <li><a href="menu.php?seleccion=pedidos"><i class="fa fa-archive" aria-hidden="true"></i>Pedidos</a></li>
              <li><a href="menu.php?seleccion=articulos"><i class="fa fa-star" aria-hidden="true"></i>Artículos</a></li>
              <li><a href="menu.php?seleccion=clientes"><i class="fa fa-users" aria-hidden="true"></i>Clientes</a></li>
              <li><a href="menu.php?seleccion=categorias"><i class="fa fa-object-group" aria-hidden="true"></i>Categorías</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-thumbs-up" aria-hidden="true"></i>Transacciones<span class="caret"></span></a>
            <ul>
              <li><a href="menu.php?seleccion=ventas"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Ventas</a></li>
            </ul>
          </li>
          <li>
            <a><i class="fa fa-globe" aria-hidden="true"></i></i>Servicios<span class="caret"></span></a>
            <ul>
              <li><a href="informes/informeventas.php"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Info General Ventas</a></li>
              <li><a href="#" id="modalInfo" data-toggle="modal" data-target=".informes"><i class="fa fa-info" aria-hidden="true"></i>Otros Informes</a></li>
            </ul>
          </li>
          <li>
            <a href="#" id="modalConta" data-toggle="modal" data-target=".contacto"><i class="fa fa-comments" aria-hidden="true"></i>Contacto</a>
          </li>
          <li><a><i class="fa fa-sign-in" aria-hidden="true"></i>Sesión<span class="caret"></span></a>
            <ul>
              <li><a href="cerrarsesion.php"><i class="fa fa-times-circle" aria-hidden="true"></i>Salir</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--MODAL PARA INFORMES-->
      <div class="modal informes" id="informes" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">X</button>
              <h3 class="modal-title">Informes</h3>
            </div>
            <div class="modal-body custom-height-modal">
              <form class="form-inline" name="informes" action="informes/otrosinformes.php" method="post">
                <div class="main row">
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infopedidos" onclick="desactivar()" checked>Informe de Pedidos</label>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infoarticulos" onclick="desactivar()">Informe de Artículos</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infoclientes" onclick="desactivar()">Informe de Clientes</label>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infocategorias" onclick="desactivar()">Informe de Categorías</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infopedidoesp" onclick="activar()">Informe Pedido Específico</label>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infovencli" onclick="activar2()">Informe de Ventas por Cliente</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infoven2cli" onclick="activar2()">Informe de Pagos por Cliente</label>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 col-md-6">
                    <div class="radio">
                      <label class="control-label"><input type="radio" name="rseleccion" value="infoven3cli" onclick="activar2()">Informe de Artículos por Cliente</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12 col-md-6">
                    <label class="hidden-xs control-label">Ingrese la Información</label>
                    <input class="form-control" type="text" id="infobus" name="infobus" disabled="true" onkeypress="return validar_numero(event)" maxlength="5" required placeholder="Ingrese la Información">
                  </div>
                  <div class="form-group col-xs-12 col-md-6">
                    <label class="hidden-xs control-label">Seleccione el Cliente</label>
                    <select class="form-control" id="cliente" name="cliente" disabled="true" required>
                    <option></option>
                    <?php
                    include 'acciones/conexion.php';
                    $sql=mysqli_query($conexion,"select * from clientes ORDER BY NombreCliente");
                    while($fila=mysqli_fetch_array($sql)){
                      echo "<option value='".$fila["IdCliente"]."'>".$fila["NombreCliente"]."</option>";}?>
                    </select>
                  </div>
                </div><br id="espacio"/>
                <input type="submit" class="btn btn-success" id="btnmodalarti" value="Exportar">
                <button type="button" class="btn btn-info" id="btnmodalarti" data-dismiss="modal">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--MODAL PARA CONTACTO-->
      <div class="modal contacto" id="contacto" role="dialog" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">X</button>
              <h3 class="modal-title">Contacto</h3>
            </div>
            <div class="modal-body custom-height-modal">
              <form class="form-inline" name="contacto">
                <p><img width="180" align="left" style="margin-right:10px" src="imagenes/logocs.png">
                  Taste es desarrollado por CreativeSoft.
                  <br>Cualquier incidente presentado en el software (Aplicativo), por favor comunicarlo a:
                  <br><strong><a href="mailto:creativesoft2205@gmail.com">creativesoft2205@gmail.com</a></strong>
                  <br><strong>Móvil: 3003224304</strong>
                </p>
                <button type="button" class="btn btn-info" id="btnmodalarti" data-dismiss="modal">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--CONTENIDO SEGÚN LOS SUBMENÚS-->
      <div id="contenidomenu">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menú</a>
              <div class="labores">
                <?php
                /*LA ETIQUETA error_reporting SIRVE PARA CONTROLAR
                LOS MENSAJES DE ERROR, EL 0 SIRVE PARA NO MOSTRAR
                ERRORES EN PANTALLA*/
                error_reporting(0);
                /*CREAMOS UNA VARIABLE PARA CAPTURAR LA URL O PÁGINA A MOSTRAR
                CON LA ETIQUETA strip_tags SE ELIMINAN TODAS LAS ETIQUETAS HTML
                Y ASÍ EVITAR UN XSS*/
                $accion=strip_tags($_GET['seleccion']);
                /*HACEMOS UNA VALIDACIÓN DE QUE SI LA VARIABLE
                ESTA VACIA, SE MOSTRARÁ LA PAGÍNA PRINCIPAL*/
                if(accion==""){
                  include("modulos/inicio.php");}
                else{
                  switch($accion){
                    case 'inicio':
                      include("modulos/inicio.php");
                      break;
                    case 'pedidos':
                      include("modulos/pedidos.php");
                      break;
                    case 'nuevopedido':
                      include("modulos/nuevopedido.php");
                      break;
                    case 'articulos':
                      include("modulos/articulos.php");
                      break;
                    case 'nuevoArti':
                      include("modulos/nuevoarticulo.php");
                      break;
                    case 'categorias':
                      include("modulos/categorias.php");
                      break;
                    case 'clientes':
                      include("modulos/clientes.php");
                      break;
                    case 'ventas':
                      include("modulos/ventas.php");
                      break;
                    default:
                      include("modulos/inicio.php");
                      break;}}?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <p><img src="imagenes/logocs.png" width="50"> Copyright &copy; <?=date('Y',time())?></p>
    </footer>
    <script src="plugins/jQuery/main.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/jQuery/zoom.js"></script>
    <script>
    $(document).ready(function(){
      $("#menu-toggle").on('click',function(e){
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");});});
    $(document).ready(function(){
      $('#carousel').carousel({
        interval:4000});});
    $(document).ready(function(){
      $('#inicioModal').on('click',function(){
        $('.editarArticulos').addClass('animated fadeInUp').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('.foto').on('click',function(){
        $('.modalimg').addClass('animated zoomIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#modalCate').on('click',function(){
        $('.editarCategoria').addClass('animated lightSpeedIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#modalPedi').on('click',function(){
        $('.editarPedidos').addClass('animated flipInX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#modalEdiVen').on('click',function(){
        $('.editarVentas').addClass('animated rotateInDownLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#modalInfo').on('click',function(){
        $('.informes').addClass('animated rotateInUpLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#btneliminar').on('click',function(){
        $('.eliminarVenta').addClass('animated fadeInRightBig').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    $(document).ready(function(){
      $('#modalConta').on('click',function(){
        $('.contacto').addClass('animated rotateInDownRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd animationend');});});
    /*TABLA ARTÍCULOS*/
    $('#tablaarti').DataTable({
    "language":{
        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "No hay datos disponibles en esta tabla",
        "sInfo":            "Registros del _START_ al _END_ de un total de _TOTAL_ registros.",
        "sInfoEmpty":       "Registros del 0 al 0 de un total de 0 registros.",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate":{
            "sFirst":       "Primero",
            "sLast":        "Último",
            "sNext":        "Siguiente",
            "sPrevious":    "Anterior"},
        "oAria":{
            "sSortAscending":  ":Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ":Activar para ordenar la columna de manera descendente"}}});
    $(function(){
      $("#tablaarti").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "info": true,
        "autoWidth": false});});
    /*TABLA CATEGORIAS*/
    $('#tablacate').DataTable({
    "language":{
        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "No hay datos disponibles en esta tabla",
        "sInfo":            "Registros del _START_ al _END_ de un total de _TOTAL_.",
        "sInfoEmpty":       "Registros del 0 al 0 de un total de 0.",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate":{
            "sFirst":       "Primero",
            "sLast":        "Último",
            "sNext":        "Siguiente",
            "sPrevious":    "Anterior"},
        "oAria":{
            "sSortAscending":  ":Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ":Activar para ordenar la columna de manera descendente"}}});
    $(function(){
      $("#tablacate").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "info": true,
        "autoWidth": false});});
    /*TABLA PEDIDOS*/
    $('#tablapedidos').DataTable({
    "language":{
        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "No hay datos disponibles en esta tabla",
        "sInfo":            "Registros del _START_ al _END_ de un total de _TOTAL_.",
        "sInfoEmpty":       "Registros del 0 al 0 de un total de 0.",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate":{
            "sFirst":       "Primero",
            "sLast":        "Último",
            "sNext":        "Siguiente",
            "sPrevious":    "Anterior"},
        "oAria":{
            "sSortAscending":  ":Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ":Activar para ordenar la columna de manera descendente"}}});
    $(function(){
      $("#tablapedidos").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "info": true,
        "autoWidth": false});});
    /*TABLA CLIENTES*/
    $('#tablaclientes').DataTable({
    "language":{
        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "No hay datos disponibles en esta tabla",
        "sInfo":            "Registros del _START_ al _END_ de un total de _TOTAL_.",
        "sInfoEmpty":       "Registros del 0 al 0 de un total de 0.",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate":{
            "sFirst":       "Primero",
            "sLast":        "Último",
            "sNext":        "Siguiente",
            "sPrevious":    "Anterior"},
        "oAria":{
            "sSortAscending":  ":Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ":Activar para ordenar la columna de manera descendente"}}});
    $(function(){
      $("#tablaclientes").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "info": true,
        "autoWidth": false});});
    /*TABLA VENTAS*/
    $('#tablaventa').DataTable({
    "language":{
        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "No hay datos disponibles en esta tabla",
        "sInfo":            "Registros del _START_ al _END_ de un total de _TOTAL_.",
        "sInfoEmpty":       "Registros del 0 al 0 de un total de 0.",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate":{
            "sFirst":       "Primero",
            "sLast":        "Último",
            "sNext":        "Siguiente",
            "sPrevious":    "Anterior"},
        "oAria":{
            "sSortAscending":  ":Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ":Activar para ordenar la columna de manera descendente"}}});
    $(function(){
      $("#tablaventa").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "info": true,
        "autoWidth": false});});
    </script>
  </body>
</html>
