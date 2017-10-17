<?php

    include_once 'excel/Classes/PHPExcel.php';
    include_once 'VendorController.php';
    include_once 'CategoryController.php';
    include_once 'ItemController.php';
    include_once 'Vendor_CategoryController.php';
    if(!isset($_GET) || empty($_GET) || !isset($_GET['report']) || empty($_GET['report']))
    {
        die();
    }
    $tempObj = new PHPExcel();
    $tempObj->createSheet();
    $tempObj->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    if($_GET['report']=="listOfVendorsAgainstIDNamePhone")
    {
        $vendorID = $_GET['vendorID'];
        $vendorName = $_GET['vendorName'];
        $vendorPhone = $_GET['vendorPhone'];
        if(empty($vendorID))
            $vendorID = NULL;
        if(empty($vendorName))
            $vendorName = NULL;
        if(empty($vendorPhone))
            $vendorPhone = NULL;
        $vendorControllerObj=new VendorController();
        $catControllerObj=new CategoryController();
        if((isset($_REQUEST['vendorID']) && !empty($_REQUEST['vendorID'])) && $_REQUEST['vendorID']!="Ex:-12")
        {
            $vendorID=$_REQUEST['vendorID'];
            $vendorDetails=$vendorControllerObj->getVendorDetail($vendorID, NULL, NULL);
        }
        else
        {
            $vendorName=$_GET['vendorName'];
            $vendorPhone=$_GET['vendorPhone'];
            $vendorDetails=$vendorControllerObj->getVendorDetail(NULL, $vendorName, $vendorPhone);
        }
        if(sizeof($vendorDetails) <= 1)
        {
            $vendorID = $vendorDetails[0]['vendor_id'];
            $vendorDetails = $vendorDetails[0];
            $categoryID=$vendorControllerObj->getVendorCategory($vendorID);
            for($i=0;$i<sizeOf($categoryID)/2;$i++)
            {
                    $category[$i]=$catControllerObj->getCategoryName($categoryID[$i][0]);
            }
            $purchase_orderControllerObj=new POController();
            $stockControllerObj=new StockController();
            $itemControllerObj=new ItemController();
            $indentItemControllerObj=new IndentItemController();
            $purchase_orderID=$purchase_orderControllerObj->getPurchase_orderForVendor($vendorID);
            if(!is_null($purchase_orderID))
            {
                $index=0;
                for($index=0;$index<sizeOf($purchase_orderID);$index++)
                {
                        $temp=$indentItemControllerObj->getItemDetailsAgainstPO($purchase_orderID[$index][0]);
                        if($temp!=false)
                                $deliveryDetails[$index] = $temp;
                        else
                                $deliveryDetails[$index] = false;
                }
            }
            $size = sizeof($vendorDetails)/2;
            for($i=0;$i<$size;$i++)
            {
                if(is_null($vendorDetails[$i]) || is_bool($vendorDetails[$i]) || empty($vendorDetails[$i])){
                        $vendorDetails[$i] = "N/A";
                }
            }
            $tempObj->getActiveSheet()->setCellValue("A1","Vendor Details");
            $tempObj->getActiveSheet()->mergeCells('A1:E1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A2","Personal Details");
            $tempObj->getActiveSheet()->mergeCells('A2:B2');
            $tempObj->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A4","Vendor ID");
            $tempObj->getActiveSheet()->setCellValue("B4","Name");
            $tempObj->getActiveSheet()->setCellValue("C4","Address");
            $tempObj->getActiveSheet()->setCellValue("D4","Email");
            $tempObj->getActiveSheet()->setCellValue("F4","Phone 1");
            $tempObj->getActiveSheet()->setCellValue("G4","Phone 2");
            $tempObj->getActiveSheet()->setCellValue("H4","Category");
            $tempObj->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("A5",$vendorDetails[0]);
            $tempObj->getActiveSheet()->setCellValue("B5",$vendorDetails[1]);
            $tempObj->getActiveSheet()->setCellValue("C5",$vendorDetails[2]);
            $tempObj->getActiveSheet()->setCellValue("D5",$vendorDetails[3]);
            $tempObj->getActiveSheet()->setCellValue("F5",$vendorDetails[4]);
            $tempObj->getActiveSheet()->setCellValue("G5",$vendorDetails[5]);
            $appended = "";
            $count = 0;
            foreach($category as $value)
            {
                if(is_null($value))
                    break;
                if($count != 0)
                    $appended .= ", ";
                $appended .= $value[0];
            }
            $tempObj->getActiveSheet()->setCellValue("H5",$appended);
            
            
            $tempObj->getActiveSheet()->setCellValue("B7","Purchase Order Details");
            $tempObj->getActiveSheet()->mergeCells('B7:C7');
            $tempObj->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            if(!is_null($purchase_orderID))
            {
                $tempObj->getActiveSheet()->setCellValue("A8","ORDER NO");
                $tempObj->getActiveSheet()->setCellValue("B8","Name");
                $tempObj->getActiveSheet()->setCellValue("C8","Status");
                $tempObj->getActiveSheet()->setCellValue("D8","Item Name");
                $tempObj->getActiveSheet()->setCellValue("F8","Quantity");
                $tempObj->getActiveSheet()->getStyle('A8:H8')->getFont()->setBold(true);
                
                for($i=9;$i<sizeOf($purchase_orderID);$i++)
                {
                    $tempObj->getActiveSheet()->setCellValue("A8","Purchase Order #".$purchase_orderID[$i][0]);
                    $j = 0;
                    if(!is_bool($deliveryDetails[$i]))
                    {
                            foreach($deliveryDetails[$i] as $value)
                            {
                                    if($j>0)
                                            $i++;
                                    if($value!=false)
                                    {
                                            $tempObj->getActiveSheet()->setCellValue("B".$i,$value['name']);
                                            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['status']);
                                            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['quantity']);
                                    }
                                    else
                                    {
                                            $tempObj->getActiveSheet()->setCellValue("C".$i,"N/A");
                                            $tempObj->getActiveSheet()->setCellValue("D".$i,"No Items Found");
                                            $tempObj->getActiveSheet()->setCellValue("E".$i,"N/A");
                                    }
                                    $j++;
                            }
                    }
                    else {
                            $tempObj->getActiveSheet()->setCellValue("C".$i,"N/A");
                            $tempObj->getActiveSheet()->setCellValue("D".$i,"No Items Found");
                            $tempObj->getActiveSheet()->setCellValue("E".$i,"N/A");
                    }
                }
            }
            else
            {
                $tempObj->getActiveSheet()->setCellValue("B".$i,"No Purchase Orders found for the given Vendor.");
                $tempObj->getActiveSheet()->mergeCells('B7:F7');
            }
        }
        else
        {

            $tempObj->getActiveSheet()->setCellValue("A2","List of Vendors");
            $tempObj->getActiveSheet()->mergeCells('A2:B2');
            $tempObj->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A4","Vendor ID");
            $tempObj->getActiveSheet()->setCellValue("B4","Vendor Name");
            $tempObj->getActiveSheet()->getStyle('A4:B4')->getFont()->setBold(true);
            $i = 5;
            foreach($vendorDetails as $value){
                $tempObj->getActiveSheet()->setCellValue("A".$i,$value['vendor_id']);
                $tempObj->getActiveSheet()->setCellValue("B".$i,$value['name']);
                $i++;
            }
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vendorList.xls"');
        $objWriter->save('php://output');
    }
    
    else if($_GET['report']=="listOfVendorsAgainstCategoryItem")
    {
        $categoryID=$_GET['catID'];
        $itemID= $_GET['itemID'];
        $catName = NULL;
        $itemName = NULL;
        if($categoryID == "")
            $categoryID = NULL;
        if($itemID == "")
            $itemID = NULL;
        $catControllerObj=new CategoryController();
        $itemControllerObj= new ItemController();
        $vendor_catControllerObj=new Vendor_CategoryController();
       // $vendorControllerObj=new VendorController();
        if(!is_null($categoryID))
        {
            $catName=$catControllerObj->getCategoryName($categoryID);
            if($catName==FALSE)
            {
                die();
            }
            $catName = $catName[0];
        }
        if(!is_null($itemID))
        {
            $itemName=$itemControllerObj->getOneItemName($itemID);
            if($itemName==FALSE)
            {
                die();
            }
        }
        if(!is_null($categoryID))
            $vendor=$vendor_catControllerObj->getVendorInfo($categoryID);
        if(!is_null($itemID))
            $vendorInfo=$vendor_catControllerObj->getVendorInformation($itemID);
        if($catName)
        {
            $tempObj->getActiveSheet()->setCellValue("A1","List of Vendors");
            $tempObj->getActiveSheet()->mergeCells('A1:E1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A4","Vendor ID");
            $tempObj->getActiveSheet()->setCellValue("B4","Vendor Name");
            $tempObj->getActiveSheet()->getStyle('A4:B4')->getFont()->setBold(true);
            $i = 5;
            foreach($vendor as $value){
                $tempObj->getActiveSheet()->setCellValue("A".$i,$value['vendor_id']);
                $tempObj->getActiveSheet()->setCellValue("B".$i,$value['name']);
                $i++;
            }
					    
        }
        else if($itemName)
        {
            $tempObj->getActiveSheet()->setCellValue("A1","List of Vendors($itemName)");
            $tempObj->getActiveSheet()->mergeCells('A1:E1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A4","Vendor ID");
            $tempObj->getActiveSheet()->setCellValue("B4","Vendor Name");
            $tempObj->getActiveSheet()->getStyle('A4:B4')->getFont()->setBold(true);
            $i = 5;
            foreach($vendorInfo as $value){
                $tempObj->getActiveSheet()->setCellValue("A".$i,$value[0]);
                $tempObj->getActiveSheet()->setCellValue("B".$i,$value[1]);
                $i++;
            }
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vendorList.xls"');
        $objWriter->save('php://output');        
    }
    else if($_GET['report']=="listOfVendorsAgainstAllCategory")
    {
        $vendor_catControllerObj=new Vendor_CategoryController();	 
        $vendor=$vendor_catControllerObj->getVendorList();
        if($vendor)
        {
            $tempObj->getActiveSheet()->setCellValue("A1","List of Vendors");
            $tempObj->getActiveSheet()->mergeCells('A1:D1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A3","Vendor ID");
            $tempObj->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("B3","Vendor Name");
            $tempObj->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("C3","Category ID");
            $tempObj->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("D3","Category Name");
            $tempObj->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
            for($i=4;$i<sizeOf($vendor);$i++){
                $tempObj->getActiveSheet()->setCellValue("A".$i,$vendor[$i][2]);
                $tempObj->getActiveSheet()->setCellValue("B".$i,$vendor[$i][3]);
                $tempObj->getActiveSheet()->setCellValue("C".$i,$vendor[$i][0]);
                $tempObj->getActiveSheet()->setCellValue("D".$i,$vendor[$i][1]);
            }
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vendorListCategoryWise.xls"');
        $objWriter->save('php://output');
    }
    else if($_GET['report']=="listOfVendorsAgainstAllItems")
    {
        $vendor_categoryObj= new Vendor_CategoryController();
        $vendorDetails= $vendor_categoryObj->getVendor_ItemList();
        if($vendorDetails)
        {
            $tempObj->getActiveSheet()->setCellValue("A1","List of Vendors");
            $tempObj->getActiveSheet()->mergeCells('A1:D1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A3","Vendor ID");
            $tempObj->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("B3","Vendor Name");
            $tempObj->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("C3","Item ID");
            $tempObj->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->setCellValue("D3","Item Name");
            $tempObj->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
            for($i=4;$i<sizeOf($vendorDetails);$i++){
                $tempObj->getActiveSheet()->setCellValue("A".$i,$vendorDetails[$i][2]);
                $tempObj->getActiveSheet()->setCellValue("B".$i,$vendorDetails[$i][3]);
                $tempObj->getActiveSheet()->setCellValue("C".$i,$vendorDetails[$i][0]);
                $tempObj->getActiveSheet()->setCellValue("D".$i,$vendorDetails[$i][1]);
            }
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vendorListItemWise.xls"');
        $objWriter->save('php://output');
    }
    
?>