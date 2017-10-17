<?php
include_once 'excel/config/Classes/PHPExcel/IOFactory.php';
include_once 'IndentUI.php';
$obj = new PHPExcel();
$obj->createSheet();
$obj->getActiveSheet()->setCellValue('A1', 'Indent Id');
$obj->getActiveSheet()->setCellValue('B1', 'Raising Department Name');
$obj->getActiveSheet()->setCellValue('C1', 'Raise date');
$obj->getActiveSheet()->setCellValue('D1', 'Status Of Indent');
$obj->getActiveSheet()->setCellValue('E1', 'Item Name');
$obj->getActiveSheet()->setCellValue('F1', 'Category Name');
$obj->getActiveSheet()->setCellValue('G1', 'Quantity');
$obj->getActiveSheet()->setCellValue('H1', 'Item Status');
$obj->getActiveSheet()->setCellValue('I1', 'Purchase Order ID');

$obj1=new IndentUI();
$count=2;
$result=$obj1->getIndentDetailsForReport('status',$_GET['id']);
while($array=  mysqli_fetch_array($result))
{
$obj->getActiveSheet()->setCellValue('A'.$count, $array[0]);
$obj->getActiveSheet()->setCellValue('B'.$count, $array[1]);
$obj->getActiveSheet()->setCellValue('C'.$count, $array[2]);
$obj->getActiveSheet()->setCellValue('D'.$count, $array[3]);
$obj->getActiveSheet()->setCellValue('E'.$count, $array[4]);
$obj->getActiveSheet()->setCellValue('F'.$count, $array[5]);
$obj->getActiveSheet()->setCellValue('G'.$count, $array[6]);
$obj->getActiveSheet()->setCellValue('H'.$count, $array[7]);
$obj->getActiveSheet()->setCellValue('I'.$count, $array[8]);
$count++;
}

$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="IndentReport.xls"');
$objWriter->save('php://output');
?>