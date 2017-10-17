<?php
include_once 'excel/config/Classes/PHPExcel/IOFactory.php';
include_once 'POUI.php';
$obj = new PHPExcel();
$obj->createSheet();
$obj->getActiveSheet()->setCellValue('A1', 'Purchase Order Id');
$obj->getActiveSheet()->setCellValue('B1', 'Indent Id');
$obj->getActiveSheet()->setCellValue('C1', 'Raising Department');
$obj->getActiveSheet()->setCellValue('D1', 'Vendor Id');
$obj->getActiveSheet()->setCellValue('E1', 'Vendor Name');
$obj->getActiveSheet()->setCellValue('F1', 'Email');
$obj->getActiveSheet()->setCellValue('G1', 'Contact Number');
$obj->getActiveSheet()->setCellValue('H1', 'Indent Raise Date');
$obj->getActiveSheet()->setCellValue('I1', 'Indent Status');
$obj->getActiveSheet()->setCellValue('J1', 'Purchase order release date');
$obj->getActiveSheet()->setCellValue('K1', 'Expected Date');
$obj->getActiveSheet()->setCellValue('L1', 'Amount');
$obj->getActiveSheet()->setCellValue('M1', 'Purchase Order Status');
$obj->getActiveSheet()->setCellValue('N1', 'Item Id');
$obj->getActiveSheet()->setCellValue('O1', 'Item Name');
$obj->getActiveSheet()->setCellValue('P1', 'Category Id');
$obj->getActiveSheet()->setCellValue('Q1', 'Category Name');
$obj->getActiveSheet()->setCellValue('R1', 'Quantity of Item');
$reportObj=new POUI();
$count=2;
$poResult=$reportObj->getPODetailsForReport('vendor',$_GET['id']);
while($poArray=  mysqli_fetch_array($poResult))
{
$obj->getActiveSheet()->setCellValue('A'.$count, $poArray['purchase_order_id']);
$obj->getActiveSheet()->setCellValue('B'.$count, $poArray['indent_id']);
$obj->getActiveSheet()->setCellValue('C'.$count, $poArray['department_name']);
$obj->getActiveSheet()->setCellValue('D'.$count, $poArray['vendor_id']);
$obj->getActiveSheet()->setCellValue('E'.$count, $poArray['vendor_name']);
$obj->getActiveSheet()->setCellValue('F'.$count, $poArray['email']);
$obj->getActiveSheet()->setCellValue('G'.$count, $poArray['phone1']);
$obj->getActiveSheet()->setCellValue('H'.$count, $poArray['raise_date']);
$obj->getActiveSheet()->setCellValue('I'.$count, $poArray['indent_status']);
$obj->getActiveSheet()->setCellValue('J'.$count, $poArray['release_date']);
$obj->getActiveSheet()->setCellValue('K'.$count, $poArray['expected_date']);
$obj->getActiveSheet()->setCellValue('L'.$count, $poArray['amount']);
$obj->getActiveSheet()->setCellValue('M'.$count, $poArray['purchase_order_status']);
$obj->getActiveSheet()->setCellValue('N'.$count, $poArray['item_id']);
$obj->getActiveSheet()->setCellValue('O'.$count, $poArray['name_brand']);
$obj->getActiveSheet()->setCellValue('P'.$count, $poArray['category_id']);
$obj->getActiveSheet()->setCellValue('Q'.$count, $poArray['category_name']);
$obj->getActiveSheet()->setCellValue('R'.$count, $poArray['quantity']);
$count++;
}

$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="PurchaseOrderDetails.xls"');
$objWriter->save('php://output');


?>
