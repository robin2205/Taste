<?php
session_start();
require '../acciones/conexion.php';
require_once '../Classes/PHPExcel.php';//Incluyo el archivo con las clases de PHPExcel
$opcion=$_POST['rseleccion'];
if($opcion=="infopedidos"){
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Pedidos")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Pedidos")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Informe Pedidos";
  $titucabe=array('Id Pedido','Valor','Costo de Envío','Dolar','Incremento');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:E1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3])
  ->setCellValue('E2',$titucabe[4]);

  $sql=mysqli_query($conexion,"SELECT * FROM pedidos");
  $i=3;
  while($fila=mysqli_fetch_array($sql)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A'.$i,$fila['IdPedido'])
    ->setCellValue('B'.$i,$fila['Valor'])
    ->setCellValue('C'.$i,$fila['ValorEnvio'])
    ->setCellValue('D'.$i,$fila['Dolar'])
    ->setCellValue('E'.$i,$fila['Incremento']);
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:E'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(12);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(14);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe Pedidos');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Informe Pedidos.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infoclientes"){
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Clientes")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Clientes")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Informe Clientes";
  $titucabe=array('Id Cliente','Nombre del Cliente','Deuda','Saldo a Favor');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:D1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3]);

  $sql=mysqli_query($conexion,"SELECT * FROM clientes");
  $i=3;
  while($fila=mysqli_fetch_array($sql)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A'.$i,$fila['IdCliente'])
    ->setCellValue('B'.$i,$fila['NombreCliente'])
    ->setCellValue('C'.$i,$fila['Deuda'])
    ->setCellValue('D'.$i,$fila['SaldoaFavor']);
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:D2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:D'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(13);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(35);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe Clientes');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Informe Clientes.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infoarticulos"){
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Artículos")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Artículos")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Informe Artículos";
  $titucabe=array('Id Artículo','Pedido','Referencia','Categoría','Costo','Precio Real Pesos','Utilidad','PVP','Foto');
  #Se combinan las celdas A1:I1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:I1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3])
  ->setCellValue('E2',$titucabe[4])
  ->setCellValue('F2',$titucabe[5])
  ->setCellValue('G2',$titucabe[6])
  ->setCellValue('H2',$titucabe[7])
  ->setCellValue('I2',$titucabe[8]);

  $sql=mysqli_query($conexion,"SELECT * FROM articulos");
  $i=3;
  while($fila=mysqli_fetch_array($sql)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A'.$i,$fila['IdArticulo'])
    ->setCellValue('B'.$i,$fila['IdPedido'])
    ->setCellValue('C'.$i,$fila['Referencia'])
    ->setCellValue('E'.$i,$fila['Costo'])
    ->setCellValue('F'.$i,$fila['PrecioRealPesos'])
    ->setCellValue('G'.$i,$fila['Utilidad'])
    ->setCellValue('H'.$i,$fila['PVP']);
    $objDrawing=new PHPExcel_Worksheet_Drawing();
    $objDrawing->setPath($fila['Foto']);
    $objDrawing->setHeight(80);
    $objDrawing->setCoordinates('I'.$i);
    $objDrawing->setOffsetX(5);
    $objDrawing->setOffsetY(3);
    $objDrawing->setWorksheet($objPHP->getActiveSheet());
    $sql2=mysqli_query($conexion,"SELECT * FROM categorias WHERE IdCategoria=".$fila['IdCategoria']);
    if($fila2=mysqli_fetch_array($sql2)){
      $objPHP->setActiveSheetIndex(0)
      ->setCellValue('D'.$i,$fila2['Descripcion']);}
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:I2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:I'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(13);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(9);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(17);
  $objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(16);
  $objPHP->getActiveSheet()->getColumnDimension('F')->setWidth(21);
  $objPHP->getActiveSheet()->getColumnDimension('G')->setWidth(10);
  $objPHP->getActiveSheet()->getColumnDimension('H')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('I')->setWidth(13);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(65);}//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe Artículos');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Informe Artículos.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infocategorias"){
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Categorías")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Categorías")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Informe Categorías";
  $titucabe=array('Id Categoría','Descripción Categoría');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:B1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1]);

  $sql=mysqli_query($conexion,"SELECT * FROM categorias");
  $i=3;
  while($fila=mysqli_fetch_array($sql)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A'.$i,$fila['IdCategoria'])
    ->setCellValue('B'.$i,$fila['Descripcion']);
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:B2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:B'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(15);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(30);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe Categorías');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Informe Categorías.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infopedidoesp"){
  $pedido=$_POST['infobus'];
  $sql=mysqli_query($conexion,"SELECT * FROM pedidos WHERE IdPedido=".$pedido);
  $respuesta=mysqli_fetch_array($sql);
  if($respuesta==null){?>
    <script>
      alert('La información no se encuentra registrada en la Base de Datos.')
      location.href="../menu.php?seleccion=inicio";
    </script>
  <?php }
  else{
    #Instancio un Objeto
    $objPHP=new PHPExcel();
    #Se establecen las propiedades de la hoja
    $objPHP->getProperties()
    ->setCreator("YouSoft SAS")//Nombre del Autor
    ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
    ->setTitle("Informe Pedido especifico")//Título
    ->setSubject("Informe")//Asunto
    ->setDescription("Informe")//Descripción
    ->setKeywords("Inoforme Perdido especifico")//Etiqueta
    ->setCategory("Reporte");//Categoria
    /***********************************************************************************/
    #Creamos las variables y el arreglo de los Títulos principales
    $titurepo="Informe Pedido ".$pedido;
    $titucabe=array('Valor','Costo envío','Dolar','Incremento','Artículos del Pedido');
    #Se combinan las celdas A1:G1, para colocar el título
    $objPHP->setActiveSheetIndex(0)
    ->mergeCells('A1:E1');
    #Se agregan los títulos del Reporte
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A1',$titurepo)//Título del Reporte
    ->setCellValue('A2',$titucabe[0])//Cabeceras
    ->setCellValue('B2',$titucabe[1])
    ->setCellValue('C2',$titucabe[2])
    ->setCellValue('D2',$titucabe[3])
    ->setCellValue('E2',$titucabe[4]);

    $sql2=mysqli_query($conexion,"SELECT * FROM pedidos WHERE IdPedido=".$pedido);
    $i=3;
    while($fila=mysqli_fetch_array($sql2)){
      $objPHP->setActiveSheetIndex(0)
      ->setCellValue('A'.$i,$fila['Valor'])
      ->setCellValue('B'.$i,$fila['ValorEnvio'])
      ->setCellValue('C'.$i,$fila['Dolar'])
      ->setCellValue('D'.$i,$fila['Incremento']);
      $sql3=mysqli_query($conexion,"SELECT Referencia FROM articulos WHERE IdPedido=".$pedido);
      while($fila3=mysqli_fetch_array($sql3)){
        $objPHP->setActiveSheetIndex(0)
        ->setCellValue('E'.$i,$fila3['Referencia']);
        $i++;}}
    mysqli_free_result($sql);
    mysqli_free_result($sql2);
    mysqli_free_result($sql3);
    mysqli_close($conexion);
    /***********************************************************************************/
    #ESTILOS
    $estititurepo=array(
      'font'=>array(
        'name'=>'Arial',
        'bold'=>true,
        'size'=>24,
        'color'=>array('rgb'=>'FFFFFF')),
      'fill'=>array(
        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
        'color'=>array('argb'=>'FF220835')),
      'borders'=>array(
        'allborders'=>array(
          'style'=>PHPExcel_Style_Border::BORDER_THIN,
          'color'=>array('rgb'=>'000000'))),
      'alignment'=>array(
        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'=>0,
        'wrap'=>TRUE));
    $estititucabe=array(
      'font'=>array(
        'name'=>'Arial',
        'bold'=>true,
        'size'=>12,
        'color'=>array('rgb'=>'000000')),
      'fill'=>array(
        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
        'color'=>array('rgb'=>'dddddd')),
      'borders'=>array(
        'allborders'=>array(
          'style'=>PHPExcel_Style_Border::BORDER_THIN,
          'color'=>array('rgb'=>'000000'))),
      'alignment'=>array(
        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'=>0,
        'wrap'=>TRUE));
    $estiinfo=new PHPExcel_Style();
    $estiinfo->applyFromArray(array(
      'font'=>array(
        'name'=>'Arial',
        'size'=>11,
        'color'=>array('rgb'=>'000000')),
      'fill'=>array(
        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
        'color'=>array('rgb'=>'FFFFFF')),
      'borders'=>array(
        'allborders'=>array(
          'style'=>PHPExcel_Style_Border::BORDER_THIN,
          'color'=>array('rgb'=>'000000'))),
      'alignment'=>array(
        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation'=>0,
        'wrap'=>TRUE)
      ));

    $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
    $objPHP->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
    $objPHP->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
    $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:E'.($i-1));//Le asignamos los estilos a la información
    $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(11);//Ancho de una Columna
    $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(14);
    $objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(23);
    $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
    $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
    for($f=3;$f<$i;$f++){
      $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
    #Se renombra la hoja
    $objPHP->getActiveSheet()->setTitle('Informe Pedido');
    #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
    $objPHP->setActiveSheetIndex(0);
    #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename=Informe Pedido '.$pedido.'.xlsx');
    header('Cache-Control: max-age=0');
    header('Pragma: no-cache');
    $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
    $objPHP->save('PHP://output');
    exit;}
}
else if($opcion=="infovencli"){
  function filtro($var){
    $filtrado=str_replace("'","&#39;",$var);
    return $filtrado;}
  $id=$_POST['cliente'];
  $id=filtro($id);
  $sql=mysqli_query($conexion,"select NombreCliente from clientes where IdCliente=".$id);
  if($fila=mysqli_fetch_assoc($sql)){
    $nombrecliente=$fila['NombreCliente'];}
  #Empezamos a traer los datos
  $sql2=mysqli_query($conexion,"SELECT * FROM registro_pagos WHERE IdCliente=".$id);
  require_once '../Classes/PHPExcel.php';//Incluyo el archivo con las clases de PHPExcel
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Ventas por Cliente")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Ventas por Cliente")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Ventas Cliente ".$nombrecliente;
  $titucabe=array('Deuda','Saldo a Favor','Artículo','Foto','PVP','Detalles de Fechas','Detalles de Pagos');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:G1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3])
  ->setCellValue('E2',$titucabe[4])
  ->setCellValue('F2',$titucabe[5])
  ->setCellValue('G2',$titucabe[6]);

  $i=3;
  $sql3=mysqli_query($conexion,"SELECT Deuda,SaldoaFavor FROM clientes WHERE IdCliente=".$id);
  $fila3=mysqli_fetch_assoc($sql3);
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A'.$i,$fila3['Deuda'])
  ->setCellValue('B'.$i,$fila3['SaldoaFavor']);
  $sql4=mysqli_query($conexion,"SELECT * FROM ventas WHERE IdCliente=".$id);
  while($fila4=mysqli_fetch_array($sql4)){
    $articulo=$fila4['IdArticulo'];
    $sql5=mysqli_query($conexion,"SELECT Referencia,PVP,Foto FROM articulos WHERE IdArticulo=".$articulo);
    if($fila5=mysqli_fetch_array($sql5)){
      $objPHP->setActiveSheetIndex(0)
      ->setCellValue('C'.$i,$fila5['Referencia'])
      ->setCellValue('E'.$i,$fila5['PVP']);
      $objDrawing=new PHPExcel_Worksheet_Drawing();
      $objDrawing->setPath($fila5['Foto']);
      $objDrawing->setHeight(80);
      $objDrawing->setCoordinates('D'.$i);
      $objDrawing->setOffsetX(5);
      $objDrawing->setOffsetY(3);
      $objDrawing->setWorksheet($objPHP->getActiveSheet());}
    $i++;}
  $i=3;
  while($fila2=mysqli_fetch_array($sql2)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('F'.$i,$fila2['Pago'])
    ->setCellValue('G'.$i,$fila2['Fecha']);
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:G2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:G'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(17);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHP->getActiveSheet()->getColumnDimension('F')->setWidth(23);
  $objPHP->getActiveSheet()->getColumnDimension('G')->setWidth(22);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(65);}//Altura de las filas
  //$objPHP->getActiveSheet()->getDefaultRowDimension("3")->setRowHeight(65);//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe de Ventas');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Ventas Cliente '.$id.'.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infoven2cli"){
  function filtro($var){
    $filtrado=str_replace("'","&#39;",$var);
    return $filtrado;}
  $id=$_POST['cliente'];
  $id=filtro($id);
  $sql=mysqli_query($conexion,"select NombreCliente from clientes where IdCliente=".$id);
  if($fila=mysqli_fetch_assoc($sql)){
    $nombrecliente=$fila['NombreCliente'];}
  #Empezamos a traer los datos
  $sql2=mysqli_query($conexion,"SELECT * FROM registro_pagos WHERE IdCliente=".$id);
  require_once '../Classes/PHPExcel.php';//Incluyo el archivo con las clases de PHPExcel
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Pagos por Cliente")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Pagos por Cliente")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Ventas Cliente ".$nombrecliente;
  $titucabe=array('Deuda','Saldo a Favor','Detalles de Fechas','Detalles de Pagos');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:D1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3]);

  $i=3;
  $sql3=mysqli_query($conexion,"SELECT Deuda,SaldoaFavor FROM clientes WHERE IdCliente=".$id);
  $fila3=mysqli_fetch_assoc($sql3);
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A'.$i,$fila3['Deuda'])
  ->setCellValue('B'.$i,$fila3['SaldoaFavor']);
  while($fila2=mysqli_fetch_array($sql2)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('C'.$i,$fila2['Pago'])
    ->setCellValue('D'.$i,$fila2['Fecha']);
    $i++;}
  mysqli_free_result($sql);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:D2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:D'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(17);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(22);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(21);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
  //$objPHP->getActiveSheet()->getDefaultRowDimension("3")->setRowHeight(65);//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe de Pagos');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Pagos Cliente '.$id.'.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}
else if($opcion=="infoven3cli"){
  function filtro($var){
    $filtrado=str_replace("'","&#39;",$var);
    return $filtrado;}
  $id=$_POST['cliente'];
  $id=filtro($id);
  #Empezamos a traer los datos
  $sql=mysqli_query($conexion,"select NombreCliente from clientes where IdCliente=".$id);
  if($fila=mysqli_fetch_assoc($sql)){
    $nombrecliente=$fila['NombreCliente'];}
  require_once '../Classes/PHPExcel.php';//Incluyo el archivo con las clases de PHPExcel
  #Instancio un Objeto
  $objPHP=new PHPExcel();
  #Se establecen las propiedades de la hoja
  $objPHP->getProperties()
  ->setCreator("YouSoft SAS")//Nombre del Autor
  ->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
  ->setTitle("Informe Artículos por Cliente")//Título
  ->setSubject("Informe")//Asunto
  ->setDescription("Informe")//Descripción
  ->setKeywords("Inoforme Artículos por Cliente")//Etiqueta
  ->setCategory("Reporte");//Categoria
  /***********************************************************************************/
  #Creamos las variables y el arreglo de los Títulos principales
  $titurepo="Artículos Cliente ".$nombrecliente;
  $titucabe=array('Deuda','Saldo a Favor','Artículo','Foto','PVP');
  #Se combinan las celdas A1:G1, para colocar el título
  $objPHP->setActiveSheetIndex(0)
  ->mergeCells('A1:E1');
  #Se agregan los títulos del Reporte
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A1',$titurepo)//Título del Reporte
  ->setCellValue('A2',$titucabe[0])//Cabeceras
  ->setCellValue('B2',$titucabe[1])
  ->setCellValue('C2',$titucabe[2])
  ->setCellValue('D2',$titucabe[3])
  ->setCellValue('E2',$titucabe[4]);

  $i=3;
  $sql2=mysqli_query($conexion,"SELECT Deuda,SaldoaFavor FROM clientes WHERE IdCliente=".$id);
  $fila2=mysqli_fetch_assoc($sql2);
  $objPHP->setActiveSheetIndex(0)
  ->setCellValue('A'.$i,$fila2['Deuda'])
  ->setCellValue('B'.$i,$fila2['SaldoaFavor']);
  $sql3=mysqli_query($conexion,"SELECT * FROM ventas WHERE IdCliente=".$id);
  while($fila3=mysqli_fetch_array($sql3)){
    $articulo=$fila3['IdArticulo'];
    $sql4=mysqli_query($conexion,"SELECT Referencia,PVP,Foto FROM articulos WHERE IdArticulo=".$articulo);
    if($fila4=mysqli_fetch_array($sql4)){
      $objPHP->setActiveSheetIndex(0)
      ->setCellValue('C'.$i,$fila4['Referencia'])
      ->setCellValue('E'.$i,$fila4['PVP']);
      $objDrawing=new PHPExcel_Worksheet_Drawing();
      $objDrawing->setPath($fila4['Foto']);
      $objDrawing->setHeight(80);
      $objDrawing->setCoordinates('D'.$i);
      $objDrawing->setOffsetX(5);
      $objDrawing->setOffsetY(3);
      $objDrawing->setWorksheet($objPHP->getActiveSheet());}
    $i++;}
  mysqli_free_result($sql);
  mysqli_free_result($sql2);
  mysqli_free_result($sql3);
  mysqli_free_result($sql4);
  mysqli_close($conexion);
  /***********************************************************************************/
  #ESTILOS
  $estititurepo=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>24,
      'color'=>array('rgb'=>'FFFFFF')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('argb'=>'FF220835')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estititucabe=array(
    'font'=>array(
      'name'=>'Arial',
      'bold'=>true,
      'size'=>12,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'dddddd')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE));
  $estiinfo=new PHPExcel_Style();
  $estiinfo->applyFromArray(array(
    'font'=>array(
      'name'=>'Arial',
      'size'=>11,
      'color'=>array('rgb'=>'000000')),
    'fill'=>array(
      'type'=>PHPExcel_Style_Fill::FILL_SOLID,
      'color'=>array('rgb'=>'FFFFFF')),
    'borders'=>array(
      'allborders'=>array(
        'style'=>PHPExcel_Style_Border::BORDER_THIN,
        'color'=>array('rgb'=>'000000'))),
    'alignment'=>array(
      'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation'=>0,
      'wrap'=>TRUE)
    ));

  $objPHP->getActiveSheet()->getStyle('A1:XFD1048576')->getFill()->setFillType(
  PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF');//Fondo Blanco para toda la Hoja
  $objPHP->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estititurepo);//Le asignamos los estilos al título
  $objPHP->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estititucabe);//La asignamos los estilos a la cabecera de estilos
  $objPHP->getActiveSheet()->setSharedStyle($estiinfo,'A3:E'.($i-1));//Le asignamos los estilos a la información
  $objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de una Columna
  $objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(17);
  $objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
  $objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
  for($f=3;$f<$i;$f++){
    $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(65);}//Altura de las filas
  //$objPHP->getActiveSheet()->getDefaultRowDimension("3")->setRowHeight(65);//Altura de las filas
  #Se renombra la hoja
  $objPHP->getActiveSheet()->setTitle('Informe de Artículos');
  #Se establece la hoja activa, para que cuando se abra el documento se muestre primero
  $objPHP->setActiveSheetIndex(0);
  #Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename=Artículos Cliente '.$id.'.xlsx');
  header('Cache-Control: max-age=0');
  header('Pragma: no-cache');
  $objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
  $objPHP->save('PHP://output');
  exit;
}?>
