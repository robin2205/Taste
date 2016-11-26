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
exit;?>
