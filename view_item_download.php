<?phpinclude_once 'config/Classes/PHPExcel.php';include_once 'config/Classes/PHPExcel/IOFactory.php';include_once 'StockModel.php';$stockModelObj2=new StockModel();$r=$stockModelObj2->fetchAllItemCurrentStock();$obj = new PHPExcel();$obj->createSheet();$obj->getActiveSheet()->setCellValue('A1', 'id');$obj->getActiveSheet()->setCellValue('B1', 'name');$obj->getActiveSheet()->setCellValue('C1', 'category');$obj->getActiveSheet()->setCellValue('D1', 'current stock');$t=2;while($row=mysqli_fetch_array($r)){	$obj->getActiveSheet()->setCellValue('A'.$t,$row[0]);	$obj->getActiveSheet()->setCellValue('B'.$t,$row[1]);	$obj->getActiveSheet()->setCellValue('C'.$t,$row[2]);	$obj->getActiveSheet()->setCellValue('D'.$t,$row[3]);	$t++;}$objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');header('Content-type: application/vnd.ms-excel');header('Content-Disposition: attachment; filename="Test_File.xls"');$objWriter->save('php://output');?>