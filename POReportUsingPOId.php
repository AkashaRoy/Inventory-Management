<?php
include_once 'excel/config/Classes/PHPExcel/IOFactory.php';
include_once 'POUI.php';
$obj = new PHPExcel();
$obj->createSheet();
$obj->getActiveSheet()->setCellValue('A1', 'Purchase Order Id');
$obj->getActiveSheet()->setCellValue('A2', 'Indent Id');
$obj->getActiveSheet()->setCellValue('A3', 'Raising Department');
$obj->getActiveSheet()->setCellValue('A4', 'Vendor Id');
$obj->getActiveSheet()->setCellValue('A5', 'Vendor Name');
$obj->getActiveSheet()->setCellValue('A6', 'Email');
$obj->getActiveSheet()->setCellValue('A7', 'Contact Number');
$obj->getActiveSheet()->setCellValue('A8', 'Indent Raise Date');
$obj->getActiveSheet()->setCellValue('A9', 'Indent Status');
$obj->getActiveSheet()->setCellValue('A10', 'Purchase order release date');
$obj->getActiveSheet()->setCellValue('A11', 'Amount');
$obj->getActiveSheet()->setCellValue('A12', 'Expected Date');
$obj->getActiveSheet()->setCellValue('A13', 'Purchase Order Status');
$ReportObj=new POUI();
$count2=1;
$count=1;
$POResult=$ReportObj->getPODetailsForReportUsingPOId('purchase_order_id',$_GET['id']);
while($PODetails=  mysqli_fetch_array($POResult))
{
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['purchase_order_id']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['indent_id']);
    $count++;
    $indentResult=$ReportObj->getPODetailsForReportUsingPOId('indent',$PODetails['indent_id']);
    $indentDetails=  mysqli_fetch_array($indentResult);
    $obj->getActiveSheet()->setCellValue('B'.$count, $indentDetails['name']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['vendor_id']);
    $count++;
    $vendorResult=$ReportObj->getPODetailsForReportUsingPOId('vendor_id',$PODetails['vendor_id']);
    $vendorDetails=  mysqli_fetch_array($vendorResult);
    $obj->getActiveSheet()->setCellValue('B'.$count, $vendorDetails['name']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $vendorDetails['email']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $vendorDetails['phone1']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $indentDetails['raise_date']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $indentDetails['status']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['release_date']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['amount']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['expected_date']);
    $count++;
    $obj->getActiveSheet()->setCellValue('B'.$count, $PODetails['status']);
    $count++;
    $indent_itemResult=$ReportObj->getPODetailsForReportUsingPOId('indent_item',$_GET['id']);
    while($indent_itemArray=  mysqli_fetch_array($indent_itemResult))
    {
    $obj->getActiveSheet()->setCellValue('A'.$count, 'Item'.$count2);
    $obj->getActiveSheet()->setCellValue('B'.$count,$indent_itemArray['item_id']);//item id
    $itemResult=$ReportObj->getPODetailsForReportUsingPOId('item',$indent_itemArray['item_id']);
    $itemArray=  mysqli_fetch_array($itemResult);
    $count++;
    $obj->getActiveSheet()->setCellValue('A'.$count, 'Item Name (Item '.$count2.')');
    $obj->getActiveSheet()->setCellValue('B'.$count,$itemArray['name_brand']);//item name
    $count++;
    $obj->getActiveSheet()->setCellValue('A'.$count, 'Catgeory Id');
    $obj->getActiveSheet()->setCellValue('B'.$count,$itemArray['category_id']);//catgeory id
    $count++;
    $categoryresult=$ReportObj->getPODetailsForReportUsingPOId('category',$itemArray['category_id']);
    $categoryArray=  mysqli_fetch_array($categoryresult);
    $obj->getActiveSheet()->setCellValue('A'.$count, 'Catgeory Name');
    $obj->getActiveSheet()->setCellValue('B'.$count,$categoryArray['name']);//category name
    $count++;
    $obj->getActiveSheet()->setCellValue('A'.$count, 'Quantity');
    $obj->getActiveSheet()->setCellValue('B'.$count,$indent_itemArray['quantity']);
    $count2++;
   }
    
}
$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="PurchaseOrderDetails.xls"');
$objWriter->save('php://output');

?>
