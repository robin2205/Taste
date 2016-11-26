<?php
session_start();
require '../acciones/conexion.php';
require_once '../Classes/PHPExcel.php';//Incluyo el archivo con las clases de PHPExcel
#Instancio un Objeto
$objPHP=new PHPExcel();
#Se establecen las propiedades de la hoja
$objPHP->getProperties()
->setCreator("YouSoft SAS")//Nombre del Autor
->setLastModifiedBy("YouSoft SAS")//Último usuario que lo modificó
->setTitle("Informe Ventas")//Título
->setSubject("Informe")//Asunto
->setDescription("Informe")//Descripción
->setKeywords("Inoforme Ventas")//Etiqueta
->setCategory("Reporte");//Categoria
/***********************************************************************************/
#Creamos las variables y el arreglo de los Títulos principales
$titurepo="Informe Ventas General";
$titucabe=array('Id Venta','Cliente','Pedido','Artículo','Costo','PRP','Utilidad','PVP','Ganancia');
#Se combinan las celdas A1:G1, para colocar el título
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

$sql=mysqli_query($conexion,"SELECT * FROM ventas");
$i=3;
while($fila=mysqli_fetch_array($sql)){
  $sql2=mysqli_query($conexion,"SELECT NombreCliente FROM clientes WHERE IdCliente=".$fila['IdCliente']);
  if($fila2=mysqli_fetch_assoc($sql2)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('B'.$i,$fila2['NombreCliente']);}
  $sql3=mysqli_query($conexion,"SELECT * FROM articulos WHERE IdArticulo=".$fila['IdArticulo']);
  if($fila3=mysqli_fetch_array($sql3)){
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('C'.$i,$fila3['IdPedido'])
    ->setCellValue('D'.$i,$fila3['Referencia'])
    ->setCellValue('E'.$i,$fila3['Costo'])
    ->setCellValue('F'.$i,$fila3['PrecioRealPesos'])
    ->setCellValue('G'.$i,$fila3['Utilidad'])
    ->setCellValue('H'.$i,$fila3['PVP']);
    $ganancia=$fila3['PVP']-$fila3['PrecioRealPesos'];}
    $objPHP->setActiveSheetIndex(0)
    ->setCellValue('A'.$i,$fila['IdVenta'])
    ->setCellValue('I'.$i,$ganancia);
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
$objPHP->getActiveSheet()->getColumnDimension('A')->setWidth(11);//Ancho de una Columna
$objPHP->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHP->getActiveSheet()->getColumnDimension('C')->setWidth(9);
$objPHP->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHP->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHP->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHP->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHP->getActiveSheet()->getColumnDimension('H')->setWidth(11);
$objPHP->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHP->getActiveSheet()->getRowDimension("1")->setRowHeight(35);//Altura de las filas
$objPHP->getActiveSheet()->getRowDimension("2")->setRowHeight(22);//Altura de las filas
for($f=3;$f<$i;$f++){
  $objPHP->getActiveSheet()->getRowDimension($f)->setRowHeight(15);}//Altura de las filas
#Se renombra la hoja
$objPHP->getActiveSheet()->setTitle('Informe Ventas');
#Se establece la hoja activa, para que cuando se abra el documento se muestre primero
$objPHP->setActiveSheetIndex(0);
#Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=Ventas General.xlsx');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');
$objPHP=PHPExcel_IOFactory::createWriter($objPHP,'Excel2007');
$objPHP->save('PHP://output');
exit;?>
