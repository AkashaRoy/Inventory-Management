<?php
    
    include_once 'excel/Classes/PHPExcel.php';
    include_once 'StockController.php';
    include_once 'StudentController.php';
    if(!isset($_GET) || empty($_GET) || !isset($_GET['report']) || empty($_GET['report']))
    {
        die();
    }
    $tempObj = new PHPExcel();
    $tempObj->createSheet();
    $tempObj->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    if($_GET['report']=="issueDetailsMixed")
    {
        $itemID = $_GET['itemID'];
        $categoryID = $_GET['categoryID'];
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        if($itemID == 'select' || empty($itemID))
            $itemID = NULL;
        if($categoryID == 'select' || empty($categoryID))
            $categoryID = NULL;
        if($day == 'select' || empty($day))
            $day = NULL;
        if($month == 'select' || empty($month))
            $month = NULL;
        if($year == 'select' || empty($year))
            $year = NULL;
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getIssueDetails($itemID, $categoryID, $day, $month, $year, "department");
        $i=3;
        if(empty($row) || is_null($row))
        {
            $tempObj->getActiveSheet()->setCellValue("A1","No department has been issued any items with the provided comination.");
            $tempObj->getActiveSheet()->mergeCells('A1:F1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
        else {
            $tempObj->getActiveSheet()->setCellValue("A1","Items issued to Departments");
            $tempObj->getActiveSheet()->mergeCells('A1:F1');
            $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $tempObj->getActiveSheet()->setCellValue("A2","Department ID");
            $tempObj->getActiveSheet()->setCellValue("B2","Department Name");
            $tempObj->getActiveSheet()->setCellValue("C2","Item ID");
            $tempObj->getActiveSheet()->setCellValue("D2","Item Name");
            $tempObj->getActiveSheet()->setCellValue("E2","Quantity");
            $tempObj->getActiveSheet()->setCellValue("F2","Issue Date");
            $tempObj->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
            foreach($row as $value)
            {
                if(is_null($value))
                    break;
                $tempObj->getActiveSheet()->setCellValue("A".$i,$value['department_id']);
                $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name']));
                $tempObj->getActiveSheet()->setCellValue("C".$i,$value['item_id']);
                $tempObj->getActiveSheet()->setCellValue("D".$i,ucwords($value['name_brand']));
                $tempObj->getActiveSheet()->setCellValue("E".$i,$value['quantity']);
                if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                    $tempObj->getActiveSheet()->setCellValue("F".$i,$value['issue_date']);
                }
                else {
                    $tempObj->getActiveSheet()->setCellValue("F".$i,"N/A");
                }
                $i++;
            }
        }
        $i=$i+4;
        $row = $stockControllerObj->getIssueDetails($itemID, $categoryID, $day, $month, $year, "student");
        if(empty($row) || is_null($row))
        {
            $tempObj->getActiveSheet()->setCellValue("A".$i,"No student has been issued any items with the provided comination.");
            $tempObj->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
            $tempObj->getActiveSheet()->getStyle('A'.$i.':E'.$i)->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }
        else {
            $tempObj->getActiveSheet()->setCellValue("A".$i,"Items issued to Students");
            $tempObj->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
            $tempObj->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $tempObj->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $i++;
            $tempObj->getActiveSheet()->setCellValue("A".$i,"Student ID");
            $tempObj->getActiveSheet()->setCellValue("B".$i,"Student Name");
            $tempObj->getActiveSheet()->setCellValue("C".$i,"Item ID");
            $tempObj->getActiveSheet()->setCellValue("D".$i,"Item Name");
            $tempObj->getActiveSheet()->setCellValue("E".$i,"Quantity");
            $tempObj->getActiveSheet()->setCellValue("F".$i,"Issue Date");
            $tempObj->getActiveSheet()->getStyle('A'.$i.':F'.$i)->getFont()->setBold(true);
            $i++;
            foreach($row as $value)
            {
                if(is_null($value))
                    break;
                $tempObj->getActiveSheet()->setCellValue("A".$i,$value['student_id']);
                $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name']));
                $tempObj->getActiveSheet()->setCellValue("C".$i,$value['item_id']);
                $tempObj->getActiveSheet()->setCellValue("D".$i,ucwords($value['name_brand']));
                $tempObj->getActiveSheet()->setCellValue("E".$i,$value['quantity']);
                if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                    $tempObj->getActiveSheet()->setCellValue("F".$i,$value['issue_date']);
                }
                else {
                    $tempObj->getActiveSheet()->setCellValue("F".$i,"N/A");
                }
                $i++;
            }
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="issueDetails.xls"');
        $objWriter->save('php://output');
    }



    else if($_GET['report']=="issueDetailsStudent")
    {
        $sID = $_GET['sID'];
        $studentControllerObj = new StudentController();
        $temp = $studentControllerObj->checkStudentId($sID);
        if(empty($temp) || $temp == 2) {
            die();
        }
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstStudent($sID);
        if(empty($row) || is_null($row))
        {
            die();
        }
        $tempObj->getActiveSheet()->setCellValue("A1","Items issued to a Student");
        $tempObj->getActiveSheet()->mergeCells('A1:E1');
        $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->setCellValue("B2","Student ID: ".$sID);
        $tempObj->getActiveSheet()->mergeCells('B2:C2');
        $tempObj->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->setCellValue("B4","Student Name : ".ucwords($row[0]['name']));
        $tempObj->getActiveSheet()->mergeCells('B4:C4');
        $tempObj->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->setCellValue("A6","Item ID");
        $tempObj->getActiveSheet()->setCellValue("B6","Item Name");
        $tempObj->getActiveSheet()->setCellValue("C6","Quantity");
        $tempObj->getActiveSheet()->setCellValue("D6","Issue Date");
        $tempObj->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
        $i=7;
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $tempObj->getActiveSheet()->setCellValue("A".$i,$value['item_id']);
            $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name_brand']));
            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['quantity']);
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $tempObj->getActiveSheet()->setCellValue("D".$i,$value['issue_date']);
            }
            else {
                $tempObj->getActiveSheet()->setCellValue("C".$i,"N/A");
            }
            $i++;
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="studentIssueDetails.xls"');
        $objWriter->save('php://output');
    }

    else if($_GET['report']=="issueDetailsDepartment")
    {
        $deptID = $_GET['deptID'];
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstDept($deptID);
        if(empty($row) || is_null($row))
        {
            die();
        }

        $tempObj->getActiveSheet()->setCellValue("A1","Items issued to ".ucwords($row[0]['name'])."(".$deptID.")");
        $tempObj->getActiveSheet()->mergeCells('A1:D1');
        $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->setCellValue("A3","Item ID");
        $tempObj->getActiveSheet()->setCellValue("B3","Item Name");
        $tempObj->getActiveSheet()->setCellValue("C3","Quantity");
        $tempObj->getActiveSheet()->setCellValue("D3","Issue Date");
        $tempObj->getActiveSheet()->getStyle('A3:D3')->getFont()->setBold(true);
        $i=4;
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $tempObj->getActiveSheet()->setCellValue("A".$i,$value['item_id']);
            $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name_brand']));
            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['quantity']);
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $tempObj->getActiveSheet()->setCellValue("D".$i,$value['issue_date']);
            }
            else {
                $tempObj->getActiveSheet()->setCellValue("C".$i,"N/A");
            }
            $i++;
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="deptIssueDetails.xls"');
        $objWriter->save('php://output');
    }

    else if($_GET['report']=="issueDetailsAllDepartments")
    {
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstAllDepts();
        if(empty($row) || is_null($row))
        {
            die();
        }

        
        $tempObj->getActiveSheet()->setCellValue("A1","Items issued to Departments");
        $tempObj->getActiveSheet()->mergeCells('A1:F1');
        $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->setCellValue("A3","Department ID");
        $tempObj->getActiveSheet()->setCellValue("B3","Department Name");
        $tempObj->getActiveSheet()->setCellValue("C3","Item ID");
        $tempObj->getActiveSheet()->setCellValue("D3","Item Name");
        $tempObj->getActiveSheet()->setCellValue("E3","Quantity");
        $tempObj->getActiveSheet()->setCellValue("F3","Issue Date");
        $tempObj->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);
        $i=4;
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $tempObj->getActiveSheet()->setCellValue("A".$i,$value['department_id']);
            $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name']));
            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['item_id']);
            $tempObj->getActiveSheet()->setCellValue("D".$i,ucwords($value['name_brand']));
            $tempObj->getActiveSheet()->setCellValue("E".$i,$value['quantity']);
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $tempObj->getActiveSheet()->setCellValue("F".$i,$value['issue_date']);
            }
            else {
                $tempObj->getActiveSheet()->setCellValue("F".$i,"N/A");
            }
            $i++;
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="allDeptIssueDetails.xls"');
        $objWriter->save('php://output');
    }

    else if($_GET['report']=="issueDetailsAllStudents")
    {

        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstAllStudents();
        if(empty($row) || is_null($row))
        {
            die();
        }
        
        $tempObj->getActiveSheet()->setCellValue("A1","Items issued to Students");
        $tempObj->getActiveSheet()->mergeCells('A1:F1');
        $tempObj->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $tempObj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $tempObj->getActiveSheet()->setCellValue("A3","Student ID");
        $tempObj->getActiveSheet()->setCellValue("B3","Student Name");
        $tempObj->getActiveSheet()->setCellValue("C3","Item ID");
        $tempObj->getActiveSheet()->setCellValue("D3","Item Name");
        $tempObj->getActiveSheet()->setCellValue("E3","Quantity");
        $tempObj->getActiveSheet()->setCellValue("F3","Issue Date");
        $tempObj->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);
        $i=4;
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $tempObj->getActiveSheet()->setCellValue("A".$i,$value['student_id']);
            $tempObj->getActiveSheet()->setCellValue("B".$i,ucwords($value['name']));
            $tempObj->getActiveSheet()->setCellValue("C".$i,$value['item_id']);
            $tempObj->getActiveSheet()->setCellValue("D".$i,ucwords($value['name_brand']));
            $tempObj->getActiveSheet()->setCellValue("E".$i,$value['quantity']);
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $tempObj->getActiveSheet()->setCellValue("F".$i,$value['issue_date']);
            }
            else {
                $tempObj->getActiveSheet()->setCellValue("F".$i,"N/A");
            }
            $i++;
        }
        $tempObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $tempObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($tempObj, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="allStudentsIssueDetails.xls"');
        $objWriter->save('php://output');
    }

?>