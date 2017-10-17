<?php
include_once 'POController.php';
include_once 'IndentController.php';
class POUI
{
function searchByDate()
{
    $para=  func_get_args();
    $obj=new POController();
    $resultPO="";
    $poArray="";
    $resultPO=$obj->getDataForReport('release date',$para[0],$para[1],$para[2]);
    $rows=  mysqli_num_rows($resultPO);
    if($rows==0)
        return false;
    $form="";
    $form.="<filter></filter><h3>Search results for Purchase Orders created on the date(yyyy-mm-dd): '$para[0]-$para[1]-$para[2]'</h3><table align=center><tr><td align=center>Purchase Order Id</td>
            <td align=center>Indent Id</td>
            <td align=center>Release date</td>
            <td align=center>Expected Date</td>
            <td align=center>Amount</td>
            <td align=center>Status</td>
            <td align=center>Item Id</td>
            <td align=center>Item Name</td>
            <td align=center>Category</td>
            <td align=center>Quantity</td>
            </tr>";
         
    while ($poArray=  mysqli_fetch_array($resultPO))
    {
        $form.="<tr>
                <td><a  href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                <td><a   href='indexPO.php?id=8&code=$poArray[1]' target='_blank'>$poArray[1]</a></td>
                <td>$poArray[9]</td>
                <td>$poArray[11]</td>
                <td>$poArray[10]</td>
                <td>$poArray[12]</td>
                <td>$poArray[13]</td>
                <td>$poArray[14]</td>
                <td>$poArray[16]</td>
                <td>$poArray[17]</td>
                </tr>";
    }
        $form.="</table><br/>
                <button onclick='printPage()'>Print</button>
				<a href=POReportUsingDate.php?id1=$para[0]&id2=$para[1]&id3=$para[2] ><button>Download</button></a>
				<a href=indexPO.php?id=3><button>Go Back</button></a>";
                            
        return $form;
        
    }
    function searchByMonth()
    {
        $para=  func_get_args();
        $obj=new POController();
        $resultPO="";
        $poArrat="";
        $resultPO=$obj->getDataForReport('month',$para[0]);
        $rows=  mysqli_num_rows($resultPO);
        if($rows==0)
            return false;
        $form="";
        $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
        $index=$para[0]-1;
         $form.="<filter></filter><h3>Search results for Purchase Orders created in the month of ' $month[$index] '</h3><table align=center><tr><td align=center>Purchase Order Id</td>
                 <td align=center>Indent Id</td>
                 <td align=center>Release date</td>
                 <td align=center>Expected Date</td>
                 <td align=center>Amount</td>
                 <td align=center>Status</td>
                 <td align=center>Item Id</td>
                 <td align=center>Item Name</td>
                 <td align=center>Category</td>
                 <td align=center>Quantity</td></tr>";
        
        while ($poArray=  mysqli_fetch_array($resultPO))
        {
            $form.="<tr>
                    <td><a  href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                    <td><a   href='indexPO.php?id=8&code=$poArray[1]' target='_blank'>$poArray[1]</a></td>
                    <td>$poArray[9]</td>
                    <td>$poArray[11]</td>
                    <td>$poArray[10]</td>
                    <td>$poArray[12]</td>
                    <td>$poArray[13]</td>
                    <td>$poArray[14]</td>
                    <td>$poArray[16]</td>
                    <td>$poArray[17]</td>
                    </tr>";
                    }
        $form.="</table><br/>
				<button onclick='printPage()'>Print</button>
                <a href=POReportUsingMonth.php?id=$para[0] ><button>Download</button></a>
		<a href=indexPO.php?id=3><button>Go Back</button></a>";
        
        return $form;
   
    }
     function searchByYear()
    {
        $para=  func_get_args();
        $obj=new POController();
        $resultPO="";
        $poArray="";
        $resultPO=$obj->getDataForReport('year',$para[0]);
        $rows=  mysqli_num_rows($resultPO);
        if($rows==0)
            return false;
        $form="";
        $form.="<filter></filter><h3>Search results for the year: '$para[0]'</h3><table align=center><tr><td align=center>Purchase Order Id</td>
                <td align=center>Indent Id</td>
                <td align=center>Release date</td>
                <td align=center>Expected Date</td>
                <td align=center>Amount</td>
                <td align=center>Status</td>
                <td align=center>Item Id</td>
                <td align=center>Item Name</td>
                <td align=center>Category</td>
                <td align=center>Quantity</td></tr>";
        
        while ($poArray=  mysqli_fetch_array($resultPO))
        {
            $form.="<tr>
                    <td><a  href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                    <td><a   href='indexPO.php?id=8&code=$poArray[1]' target='_blank'>$poArray[1]</a></td>
                    <td>$poArray[9]</td>
                    <td>$poArray[11]</td>
                    <td>$poArray[10]</td>
                    <td>$poArray[12]</td>
                    <td>$poArray[13]</td>
                    <td>$poArray[14]</td>
                    <td>$poArray[16]</td>
                    <td>$poArray[17]</td>
                    </tr>";
        }
        $form.="</table><br/>
				<button onclick='printPage()'>Print</button>
                <a href=POReportUsingYear.php?id=$para[0] ><button>Download</button></a>
				<a href=indexPO.php?id=3><button>Go Back</button></a>";
                   
        return $form;
        
    }
    function searchByCategory()
    {
        $para=  func_get_args();
        $obj=new POController();
        $resultPO="";
        $poArray="";
        $resultPO=$obj->getDataForReport('category',$para[0]);
        $rows=  mysqli_num_rows($resultPO);
        if($rows==0)
            return false;
       
         
        $form="";
        $form.="<filter></filter><h3>Search results for Purchase Orders made for items belonging to the category id: '<a href=indexPO.php?id=9&code=$para[0] target='_blank'>$para[0]</a> ' </h3><table align=center><tr><td align=center>Purchase Order Id</td>
                <td align=center>Indent Id</td>
                <td align=center>Release date</td>
                <td align=center>Expected Date</td>
                <td align=center>Amount</td>
                <td align=center>Status</td>
                <td align=center>Item Id</td>
                <td align=center>Item Name</td>
                <td align=center>Category</td>
                <td align=center>Quantity</td></tr>";
        
        while ($poArray=  mysqli_fetch_array($resultPO))
        {
            $form.="<tr>
                    <td><a  href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                    <td><a   href='indexPO.php?id=8&code=$poArray[1]' target='_blank'>$poArray[1]</a></td>
                    <td>$poArray[9]</td>
                    <td>$poArray[11]</td>
                    <td>$poArray[10]</td>
                    <td>$poArray[12]</td>
                    <td>$poArray[13]</td>
                    <td>$poArray[14]</td>
                    <td>$poArray[16]</td>
                    <td>$poArray[17]</td>
                    </tr>";
                    }
        $form.="</table><br/>
                <button onclick='printPage()'>Print</button>
				<a href=POReportUsingCategory.php?id=$para[0] ><button>Download</button></a>
				<a href=indexPO.php?id=3><button>Go Back</button></a>";
                  
        return $form;
        
    }
    
    function searchByItem()
    {
        $para=  func_get_args();
        $obj=new POController();
        $resultPO="";
        $poArray="";
        $resultPO=$obj->getDataForReport('item',$para[0]);
        $rows=  mysqli_num_rows($resultPO);
        if($rows==0)
             return false; 
        $form="";
        $form.="<filter></filter><h3>Search results for Purchase Orders created for the item id:'<a href=indexPO.php?id=6&code=$para[0] target='_blank'>$para[0]</a>'</h3><table align=center><tr><td align=center>Purchase Order Id</td>
                <td align=center>Indent Id</td>
                <td align=center>Release date</td>
                <td align=center>Expected Date</td>
                <td align=center>Amount</td>
                <td align=center>Status</td>
                <td align=center>Item Id</td>
                <td align=center>Item Name</td>
                <td align=center>Category</td>
                <td align=center>Quantity</td></tr>";
         
        while ($value=  mysqli_fetch_array($resultPO))
        {
            $form.="<tr>
                    <td><a  href='indexPO.php?id=4&code=".$value['purchase_order_id']."' target='_blank'>".$value['purchase_order_id']."</a></td>
                    <td><a   href='indexPO.php?id=8&code=".$value['indent_id']."' target='_blank'>".$value['indent_id']."</a></td>
                    <td>".$value['release_date']."</td>
                    <td>".$value['expected_date']."</td>
                    <td>".$value['amount']."</td>
                    <td>".$value['purchase_order_status']."</td>
                    <td>".$value['item_id']."</td>
                    <td>".$value['name_brand']."</td>
                    <td>".$value['category_name']."</td>
                    <td>".$value['quantity']."</td>
                    </tr>";
                    }
        $form.="</table><br/>
				<button onclick='printPage()'>Print</button>
                <a href=POReportUsingItem.php?id=$para[0] ><button>Download</button></a>
				<a href=indexPO.php?id=3><button>Go Back</button>";
        return $form;
        
    }
    function searchByStatus()
    {
        $para=  func_get_args();
        $obj=new POController();
        $resultPO=$obj->getDataForReport('status',$para[0]);
        $rows=  mysqli_num_rows($resultPO);
        if($rows==0)
             return false; 
        $form="";
        $form.="<filter></filter><h3>Search results for Purchase Orders having status :'$para[0]'</h3><table align=center><tr><td align=center>Purchase Order Id</td>
                <td align=center>Indent Id</td>
                <td align=center>Release date</td>
                <td align=center>Expected Date</td>
                <td align=center>Amount</td>
                <td align=center>Status</td>
                <td align=center>Item Id</td>
                <td align=center>Item Name</td>
                <td align=center>Category</td>
                <td align=center>Quantity</td></tr>";
        while($poArray=  mysqli_fetch_array($resultPO))
        {
            $form.="<tr>
                    <td><a  href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                    <td><a   href='indexPO.php?id=8&code=$poArray[1]' target='_blank'>$poArray[1]</a></td>
                    <td>$poArray[9]</td>
                    <td>$poArray[11]</td>
                    <td>$poArray[10]</td>
                    <td>$poArray[12]</td>
                    <td>$poArray[13]</td>
                    <td>$poArray[14]</td>
                    <td>$poArray[16]</td>
                    <td>$poArray[17]</td>
                    </tr>";
        }
        $form.="</table><br/>
				<button onclick='printPage()'>Print</button>
                <a href=POReportUsingStatus.php?id=$para[0] ><button>Download</button></a>
            	<a href=indexPO.php?id=3><button>Go Back</button></a>";
            
        return $form;
        
    }
    function getPODetailsForReport()
    {
        $para=  func_get_args();
        $obj=new POController();
        if(func_num_args($para)==2)
            return $obj->getDataForReport($para[0],$para[1]);
         else
             return $obj->getDataForReport ($para[0],$para[1],$para[2],$para[3]);
    }
    function getPODetailsForReportUsingPOId()
    {
        $para=  func_get_args();
        $obj=new POController();
        $indentobj=new IndentController();
        if($para[0]=='purchase_order_id')
             $result=$obj->selectPORecords($para[1]);
        else if($para[0]=='vendor_id')
            $result=$obj->getVendorDetails($para[1]);
        else if($para[0]=='indent')
            $result=$indentobj->getAllIndentDetails($para[1]);
        else if($para[0]=='indent_item')
            $result=$obj->selectIndent_ItemList($para[1]);
        else if($para[0]=='item')
            $result=$obj->getItemDetails($para[1]);
        else if($para[0]=='category')
            $result=$obj->categoryList($para[1]);
        if($result)
            return $result;
        else
            return false;
    }
    function searchByIndentIdCheck()
    {
        $obj=new IndentController();
        $para=  func_get_args();
        $counter=0;
        $indentRes=$obj->selectIndentList('all');
        while($indentArray=  mysqli_fetch_array($indentRes))
        {
            if($indentArray[0]==$para[0])
            {
                $counter=1;
                break;
                }
        }
        
        if($counter==0)
            return false;
        else
        {//contents from indent ui showindent()
         //   echo "working";
            $args=func_get_args();	
		//$id=$_SESSION['id'];
		{	
			$_SESSION['selected_indent_id']=$args[0];
			//unset ($_SESSION['id']);
                        //echo "selected indent id".$_SESSION['selected_indent_id'];
			$row="";
			
			$obj=new IndentController();
			$temp=$obj->showIndentDetails($args[0]);
			
			$obj2=new DepartmentController();
			$dept=$obj2->fetchDepartmentData($temp[1]);
			
			$obj3=new ItemController();
			
	
			//$existing_item;
			//$qty;
			//$i=0;
			//$item=0;
			$count=0;
			//$poid="";
			
			
			$ret= "<br/><br/><br/><table cellspacing=10 align=center cellpadding=8 >	
				<tr><td>Indent ID  :</td><td>".$args[0]."</td></tr>
				<tr><td>Department :</td><td>".$dept[0]."</td></tr>			
				<tr><td>Raise date :</td><td>".$temp[2]."</td></tr>
				<tr><td>Indent status :</td><td>".$temp[3]."</td></tr>";
				
			
			for($i=5,$j=7;$i<count($temp);$i+=5,$j+=5)
			{
				$name=$obj3->getAllItemData($temp[$i]);
				$existing_item[$count]=$name[0];
				$qty[$count]=$temp[$j];
				$count++;
			}
			for($i=0,$j=8;$i<$count;$i++,$j+=5)
			{
				$ret.= "<tr><td>Item :</td><td>".$existing_item[$i]."</td><td>Quantity:</td><td>".$qty[$i]."</td>
				<td>Status:</td><td>".$temp[$j]."</td></tr>";
			}
			$i=0;
			$obj=new POController();
			$po=$obj->fetch_PO_details();
			$total_no=  mysqli_num_rows($po);
			if($total_no!=0)
			{
				while($row=mysqli_fetch_array($po))
				{
					 $rowid[$i] = $row[0];
					 $i++;
				}
				$row="";
				$test = new IndentController();
				$obj4 = new POController();
				
				$ret.= "<tr><td>Total no of purchase order created:</td><td>".$total_no."</td></tr></table>";
				for($i=0;$i<$total_no;$i++)
				{
					$podetails = $obj4->selectPORecords($rowid[$i]);
					$po=mysqli_fetch_array($podetails);
					
					$res = $test-> selectIndent_ItemList($rowid[$i]);
					
					$ret.=  "<br /><br /><table cellspacing='2' cellpadding='3'><tr><td colspan='3'>&nbsp&nbsp</td></tr>
							<tr><td colspan='3'>&nbsp&nbsp</td></tr>
							<tr><td>Purchase order id :</td><td>".$rowid[$i]."</td></tr>
							<tr><td>Vendor id :</td><td>".$po[1]."</td></tr>
							<tr><td>Release date :</td><td>".$po[3]."</td></tr>
							<tr><td>Expected date :</td><td>".$po[5]."</td></tr>
							<tr><td>Amount </td><td>Rs. ".$po[4]."</td></tr>
							<tr><td>Purchase order status :</td><td>".$po[6]."</td></tr>";
					while($testres = mysqli_fetch_array($res))//use code here
					{
						$name=$obj3->getAllItemData($testres[1]);
						$ret.= "<tr><td>Item :</td><td>".$name[0]."</td>
                                                    <td>Quantity:</td>
                                                    <td>".$testres[3]."</td>
                                                        <td>Status:</td>
                                                        <td>".$testres[4]."</td></tr>";
					}
                                        
					$ret.= " </table><br/>
                                     ";
				}
			}
                        
			if($temp[3]=='cancelled')
                            {
                                $ret.="</table><br>This indent has already been cancelled and hence cannot be updated
                        ";
                                //echo $ret."1";
                            //    return $ret;
       
                                }
                            if($temp[3]=='approved')
                            {
                                $ret.="</table><br>This indent has already been approved and hence cannot be updated
                        ";
                                //echo $ret."2";
                          //      return $ret;
                            }
                            else
                            {
                                $ret.="</table><br/><br/><br/><p><font color='white'>
						
						";
                                //echo $ret."3";
			//	return $ret;
                            }
			
		}	
                        $ret.="<button onclick='printPage()'>Print</button>
						<a href=POReportingUsingIndentId.php?id=$para[0] ><button>Download</button></a>
						<a href=indexPO.php?id=3><button>Go Back</button></a>";
                return $ret;
        }
        
                        
    }
    function searchByPurchaseOrderCheck()
    {
        $obj=new POController();
        $form="";
        $para= func_get_args();
        $res=$obj->selectPORecords($para[0]);
        $poArray=  mysqli_fetch_array($res);
        if($poArray==NULL)
        return false;
        else 
        {
        
          $form.=$this->displayPurchaseOrderDetails($para[0]);
          $form.="<br/>
		  <button onclick='printPage()'>Print</button>
		  <a href=POReportUsingPOId.php?id=$para[0] ><button>Download</button></a>
          <a href=indexPO.php?id=3><button>Go Back</button></a>";
          return $form;
        }
    }
   function searchByVendorName()
   {
       $form="";
       $obj=new POController();
       $objVendor=new VendorController();
       $para=  func_get_args();
       $res=$obj->selectPurchaseOrderList('All');
       $counter=0;
       $res1=$objVendor->getVendorDetails($para[0]);
       $vendorArray=  mysqli_fetch_array($res1);
       $form.="<br/><br/><h3>Vendor Name:$vendorArray[1]</h3>
           <h3>Vendor Id  :
           <a   href='indexPO.php?id=5&code=$vendorArray[0]' target='_blank'>$vendorArray[0]</a></h3>
             <h3>Purchase Order Ids given to vendor</h3>
           <table align=center border=1><tr><td align=center>Purchase Order Id</td>
           <td align=center>Indent Id</td>
           <td align=center>Release date</td>
           <td align=center>Expected Date</td>
           <td align=center>Amount</td>
           <td align=center>Status</td>
		   </tr>";
       while($poArray=  mysqli_fetch_array($res))
       {
           if($poArray[1]==$para[0])//
           {
               $form.="<tr><td><a   href='indexPO.php?id=4&code=$poArray[0]' target='_blank'>$poArray[0]</a></td>
                   <td><a   href='indexPO.php?id=8&code=$poArray[2]' target='_blank'>$poArray[2]</a></td>
                   <td>$poArray[3]</td>
                   <td>$poArray[5]</td>
                   <td>$poArray[4]</td>
                   <td>$poArray[6]</td>
                   </tr>";
               $counter++;
           }
       }
       $form.="</table><br/> ";
       $form.="<button onclick='printPage()'>Print</button>
	   <a href=POReportUsingVendor.php?id=$para[0]><button>Download</button></a>
       <a href=indexPO.php?id=3 ><button>Go Back</button></a>";
       if($counter==0)
           return false;
       else
       {
              return $form;       
       }
           
   }
    function checkValidIndentIdForCancellation()
    {
        $para=  func_get_args();
        $obj=new POController();
        $count=0;
        $indentResult=$obj->getIndentIdsForCancellationOfPurchaseOrders();
        while($indentArray=  mysqli_fetch_array($indentResult))
        {
           if($para[0]==$indentArray[0]) 
               $count=1;
        }
        if($count==1)
            return true;
        else 
            return false;
       
    }
    function checkValidIndentId()
    {
        $para=func_get_args();
        $obj=new POController();
        $res=$obj->selectIndentList('pending');
        $counter=0;
        while($indentArray=  mysqli_fetch_array($res))
        {
            if($indentArray[0]==$para[0])
                $counter++;
           
        }
        if($counter==0)
            return false;
        else 
            return true;
        
    }
    function displayPurchaseOrderDetails()
    {
        $para=  func_get_args();//$para[0] will contain purchase order id
        $form="";
        $form.="<br/>
            <div>
            <h3>Purchase Order Details for Purchase Order Id :".$para[0]."</h3> 
            <table align=center><tr><td align=center>Purchase Order Id</td>
            ";
        $obj=new POController();
        $res1=$obj->selectPORecords($para[0]);//object from purchase order table
        if($res1 || $res1!=NULL)
        {
            $poArray=  mysqli_fetch_array($res1);
              $form.="<td align=center colspan='2'>".$poArray[0]."</td></tr>
                  <tr><td align=center >Vendor Id</td>
                  <td align=center colspan='2'><a   href=indexPO.php?id=5&code=".$poArray[1]." target='_blank'>".$poArray[1]."</a></td></tr>";
            $res2=$obj->getVendorDetails($poArray[1]);//object of vendor table for a record corresponding to vendor id
            if($res2!=false || $res2!=NULL)
            {
                $vendorArray=  mysqli_fetch_array($res2);//fetch the vendor name from here            
                $form.="<tr><td align=center > Vendor Name</td>
                    <td align=center colspan='2'>".$vendorArray[1]."</td></tr>
                <tr><td align=center >Indent Id</td><td align=center colspan='2'><a   href=indexPO.php?id=8&code=".$poArray[2]." target='_blank'>".$poArray[2]."</a></td></tr>
                <tr><td align=center >Amount</td><td align=center colspan='2'>".$poArray[4]."</td></tr>
                <tr><td align=center >Release date</td><td align=center colspan='2'>".$poArray[3]."</td></tr>
                <tr><td align=center >Expected date</td><td align=center colspan='2'>".$poArray[5]."</td></tr>
                <tr><td align=center >Items</td>
                <td align=center>Item Id</td>
                <td align=center>Quantity</td></tr>";
                $res3=$obj->selectIndent_ItemList($poArray[0]);//items from the indent_item table for a purchase order
               while($poItemsArray=  mysqli_fetch_array($res3))//fetch item ids from indent_item
                {
                  $form.="<tr><td></td><td align=center><a   href=indexPO.php?id=6&code=".$poItemsArray[1]." target='_blank'>".$poItemsArray[1]."</a></td><td align=center>".$poItemsArray[3]."</td></tr>";
                }
                    $form.="</tr>
                    <tr><td align=center>Purchase Order Status</td>
                    <td align=center colspan='2'>$poArray[6]</td></tr></table><br/><br/>
                    </div>";
            }//if $res2
        }//if $res1
        return $form;
    }//function
    function displayVendorDetails()
    {
        $para=  func_get_args();//$para[0] contains  Vendor id
        $obj=new POController();
        $res1=$obj->getVendorDetails($para[0]);
        $vendorArray=  mysqli_fetch_array($res1);
        $form="";
        $form.="<h3>Vendor Details for Vendor Id</b> :".$para[0]."</h3>";
        $form.="<table align=center border=1><tr><td align=center>Vendor Id</b></td><td align=center colspan='2'>".$para[0]."</td></tr>
        <tr><td align=center>Vendor Name</b></td><td align=center colspan='2'>".$vendorArray[1]."</td></tr>
        <tr><td align=center>Address</b></td><td align=center colspan='2'>".$vendorArray[2]."</td></tr>
        <tr><td align=center>Email</b></td><td align=center colspan='2'>".$vendorArray[3]."</td></tr>
        <tr><td align=center>Contact</b></td>
        <td align=center colspan='2'>".$vendorArray[4]."</td></tr>
        ";
        $res2=$obj->getCategoryDetailsFromCategory_Vendor($para[0]);
        $form.="<tr><td align=center>Category Details</td>
            <td align=center>Category Id</td><td>Category Name</tr>";
        while($categoryArray=  mysqli_fetch_array($res2))
        {
            $res3=$obj->categoryList($categoryArray[1]);
            $categoryNameArray=  mysqli_fetch_array($res3);
            $form.="<tr><td>&nbsp&nbsp</td><td align=center><a   href=indexPO.php?id=9&code=".$categoryArray[1]." target='_blank'>".$categoryArray[1]."</a></td><td align=center>".$categoryNameArray[1]."</td></tr>";
        }
        $form.="</table>";
        return $form;
    }
    function displayItemDetails()
    {
        $obj=new POController();
        $para=  func_get_args();//$para[0] contains  Item id
        $res1=$obj->getItemDetails($para[0]);
        $form="";
        $itemArray=  mysqli_fetch_array($res1);
        $res2=$obj->categoryList($itemArray[1]);
            $categoryNameArray=  mysqli_fetch_array($res2);
            $form.="<h3>Item Details for Item Id</b> :".$itemArray[0]."</h3>
            <table align=center border=1><tr><td align=center>Item Id</b></td><td align=center>".$itemArray[0]."</td></tr>
                <tr><td align=center>Item Name</b></td><td align=center>$itemArray[2]</td></tr>
            <tr><td align=center>Category Id</b></td><td align=center><a   href=indexPO.php?id=9&code=".$itemArray[1]." target='_blank'>".$itemArray[1]."</a></td></tr>
            <tr><td align=center>Category Name</b></td><td align=center>".$categoryNameArray[1]."</td></tr></table>";
        return $form;
    }
    function displayDepartmentDetails()
    {
        $obj=new POController();
        $para=  func_get_args();//$para[0] contains  department id
        $form="";
        $res1=$obj->getRowFromDepartment($para[0]);
        $departmentArray=  mysqli_fetch_array($res1);
        $res2=$obj->selectIndentList('pending');
        $form.="<h3>Department Details having Department Id</b> :".$para[0]."</h3>";
        $form.="<table align=center border=1><tr><td align=center>Department Id</b></td><td align=center>".$para[0]."</td>
            <tr><td align=center>Department Name</b></td><td align=center>".$departmentArray[1]."</td></tr>
                <tr><td align=center>Pending Indents raised by department</b></td><td align=center><table align=center>";
        $counter=0;
        while($indentPendingArray=  mysqli_fetch_array($res2))
        {
            if($indentPendingArray[1]==$para[0])
            {
                $counter++;
            $form.="<tr><td align=center><a   href=indexPO.php?id=8&code=".$indentPendingArray[0]." target='_blank'>".$indentPendingArray[0]."</a></td></tr>";
            }
        }
        if($counter==0)
            $form.="<tr><td>None</td></tr>";
        $form.="</table></td></tr></table>";
        return $form;
    }
    function displayIndentDetails()
    {
        $obj=new POController();
        $para=  func_get_args();//$para[0] contains indent details
		$displayResult=$obj->getDetailsToDisplayForIndentId($para[0]);
		$displayArray=mysqli_fetch_array($displayResult);
        $form="";
		$form.="<h3>Details Of Indent Id: $para[0]</h3>
		<table><tr><td>Indent Id</td><td>$para[0]</td></tr>
		<tr><td>Department Id</td><td>$displayArray[1]</td></tr>
		<tr><td>Department Name</td><td>$displayArray[2]</td></tr>
		<tr><td>Raise Date</td><td>$displayArray[4]</td></tr>
		<tr><td>Status</td><td>$displayArray[3]</td></tr></table><br /><br /><table><tr><td>Purchase Orders</td><td>Id</td><td>Status</td></tr>";
		$displayResult=$obj->getDetailsToDisplayForIndentId($para[0]);
		while($displayArray=mysqli_fetch_array($displayResult))
		{
		$form.="<tr><td>&nbsp&nbsp</td><td><a href=indexPO.php?id=4&code=$displayArray[5] target='_blank'>$displayArray[5]</a></td><td>$displayArray[6]</td></tr>";
		}
       $form.="</table>";
        return $form;
    }
    function displayCategoryDetails()
    {
        $obj=new POController();
        $para=  func_get_args();
        $form="";
        $res=$obj->categoryList($para[0]);
        $categoryArray=  mysqli_fetch_array($res);
        $form.="<h3>Category Details having Category Id</b> :".$para[0]."</h3>";
        $form.="<table align=center border=1><tr><td align=center>Category Id</b> </td><td align=center>".$para[0]."</td></tr>
            <tr><td align=center>Category Name</b> </td><td align=center>".$categoryArray[1]."</td></tr></table>";
        return $form;
    }
    function createPurchaseOrder()
    {
    $obj1=new IndentController();    
    $form="";
    $form.="<br/><br/><br/><br/><h3>Create Purchase Order</h3>
        <form name='createPurchaseOrder' action='' method='get' >
      <table align='center'><tr><td>Indent Id:</td>
      <td>
    <input type='text' name='indentId' id='indentId' onkeypress='return isValidKeyPurchaseOrder(event)'><img src='1.png' height='15' width='15' title='select indent id against which generation of purchase order has to be done if indent id is known Ex:1001'/>
    </td></tr>
    <tr><td colspan='2'>If you do not remember the ID,use the drop down:</td></tr>
    <tr><td>Indent Id:</b></td><td>
    <select name='IndentIdPending' id='IndentIdPending'><option value='0'>--SELECT--</option>";
    $fetchedPendingIndentList=$obj1->selectIndentList('pending');
    while($row=mysqli_fetch_array($fetchedPendingIndentList))
    {
        $form.="<option value='".$row[0]."'>".$row[0]."</option>";
    } 
    $form.="</select><img src='1.png' height='15' width='15' title='select indent id against which generation of purchase order has to be done if you do not know the indent id'/>
        </td></tr>
        <tr><td>
        <input type='submit' name='proceed' id='proceed' value='Proceed' onclick='return validateEntryCreatePurchaseOrder(this)' />
        </td><td>
        <input type='reset' name='reset' id='Reset'/></td></tr></table></form> ";
    return $form; 
    }
    function createPOForIndent()
    {
        $objItem=new ItemController();
        $objIndent=new IndentController();
        $objPO=new POController();
        $para=  func_get_args();             
        $_SESSION['selectedIndentId']=$para[0];
        $fetchedPendingIndent_ItemList=$objIndent->selectIndent_ItemList('IndentId','pending',$para[0]);      
        $form="";
        $form.="  <h3>Details of Indent Id :".$para[0]."</h3> ";
        $fetchedPurchaseOrder=$objPO->selectPurchaseOrderList('IndentId',$para[0]);
        //$row=mysqli_fetch_array($fetchedPurchaseOrder);
        $row=  mysqli_num_rows($fetchedPurchaseOrder);
        if($row!=0)//if at least one purchase order has been generated
            {
            //generated purchase orders
        $form.="  <h3>Generated Purchase Orders</h3> ";
        $form.="<table align='center' border='1' cellspacing=5 cellpadding=2>
            <tr><td align='center'>Purchase Order Id</td>
			<td align='center'>Items</td>
			<td align='center'>Vendor Id</td>
			<td align='center'>Release date</td>
			<td align=center>Expected Date</td>
			<td align='center'>Status</td></tr>";       
         //$fetchedPurchaseOrder=$objPO->selectPurchaseOrderList('IndentId',$para[0]);        
         //$row1=mysqli_fetch_array($fetchedPurchaseOrder);
         
        while($row1=mysqli_fetch_array($fetchedPurchaseOrder))
        {
      
      
            $res3=$objIndent->selectIndent_ItemList($row1[0]);
            $form.="<tr><td><a   href=indexPO.php?id=4&code=".$row1[0]." target='_blank'>".$row1[0]."</a></td>
		<td><table align=center border=1><tr><td aign=center>Item Id</td>
                <td align=center>Item Name</td></tr>";
		while($arr=mysqli_fetch_array($res3))
		{
                    $itemList=$objItem->getItemDetails($arr[1]);
                    $itemArray=  mysqli_fetch_array($itemList);
		$form.="<tr><td align=center>$itemArray[1]</td><td align=center>$itemArray[2]</td></tr>";
		}
		$form.="</table></td>
		<td><a href=indexPO.php?id=5&code=".$row1[1]." target='_blank'>".$row1[1]."</a>
         <td align=center>".$row1[3]."</td>
		 <td align=center>".$row1[5]."</td>
		 <td align=center>".$row1[6]."</td></tr>";           
        }//while row1
        $form.="</table><br><br> ";
        //pending items
        //$fetchedPurchaseOrder=$objPO->selectPurchaseOrderList('IndentId',$para[0]);        
        //$row1=mysqli_fetch_array($fetchedPurchaseOrder);
      
        //if($row1!=NULL )//&& $counter==0)
        //{
         $form.="<h3> Pending Items</h3> ";
             $form.="<table align='center' border='1' cellspacing=1 cellpadding=2>";
             while($row1=  mysqli_fetch_array($fetchedPendingIndent_ItemList))
             {
                  $res=$objItem->getItemDetails($row1[1]);
                  $itemArray=  mysqli_fetch_array($res);
             $form.="<tr><td>Item Id  :</b></td><td><a   href=indexPO.php?id=6&code=".$row1[1]." target='_blank'>".$row1[1]."</a></td>
                 <td align=center> Name</b></td><td>$itemArray[2]</td>
                 <td>Quantity  :</b></td><td>".$row1[3]."</td>
                     <td>Status  :</b></td><td>".$row1[4]."</td>";
             }
             $form.="</table> <form name='createPO' method='get' action=''>
                 <input type='submit' name='backFromCreatePurchaseOrder' id='backFromCreatePurchaseOrder' value='Go Back' />
                 <input type='submit' name='createPurchaseOrder' id='createPurchaseOrder' value='Create PO'/></form> ";
          // }
         }
         else if($row==0)//if no purchase order has been created for any of the items of the indent
         {
             //pending purchase orders
             $form.="<h3>Pending Items</h3>
                    <br/>";
             $form.="<table align='center' border=1 >";
             while($row1=  mysqli_fetch_array($fetchedPendingIndent_ItemList))
             {
                     $res=$objItem->getItemDetails($row1[1]);
                  $itemArray=  mysqli_fetch_array($res);
             $form.="<tr><td>Item Id  :</b></td><td><a   href=indexPO.php?id=6&code=".$row1[1]." target='_blank'>".$row1[1]."</a></td>
                 <td align=center> Name :</b></td><td>$itemArray[2]</td>
                 <td>Quantity  :</b></td><td>".$row1[3]."</td>
                 <td>Status  :</b></td><td>".$row1[4]."</td></tr>";
             }
             $form.="</table> <form name='createPO' method='get' action=''>
                 <input type='submit' name='backFromCreatePurchaseOrder' id='backFromCreatePurchaseOrder' value='Go Back' />
                 <input type='submit' name='createPurchaseOrder' id='createPurchaseOrder' value='Create PO'/></form> ";
         }
        return $form;
    }
    function createPurchaseOrderEntry()
    {
       $form="";
	   $countItem=0;
	   $countAmnt=0;
	   $countVendor=0;
	   $countDate=0;
        $objIndent=new IndentController();
        //$obj=new POController();
        $objCategory=new CategoryController();
        $objItem=new ItemController();
        $objVendor=new VendorController();
        $form.="<h4><font color=brown> Fields having <font color=red>*</font> marks are mandatory</font></h4>  <h3><b>Indent Requirements</b></h3> ";
        $form.="<form action='' method='get' name='placePurchaseOrder' onsubmit='return ValidateCreatePurchaseOrderForm(this)'>
            <link rel='stylesheet' type='text/css' href='cal.css' media='screen' /><table class='ds_box' cellpadding='0' cellspacing='0' id='ds_conclass' style='display: none;'>
	    <tr><td id='ds_calclass'></table>
            <table border='1' align='center' cellspacing=5 cellpadding=5><tr><td align=center>Category Id  </td><td align=center>Category Name</td><td align=center>Item<font color=red>*</font></td><td align=center>Total Cost(in Rs.)<font color=red>*</font></td>
            <td align=center>Vendor<font color=red>*</font></td><td align=center>Current Date</td><td align=center>Expected Date<font color=red>*</font></td></tr>";
        $fetchCategory=$objIndent->countCategory();      
        $num1=0;
        while($count=mysqli_fetch_array($fetchCategory))
        {
            $itemByCategory=$objIndent->getItemUsingCategory($count[0]);
            $categoryName=$objCategory->categoryList($count[0]);
            $categoryNameList=  mysqli_fetch_array($categoryName);
            $form.="<tr><td><input type='text' value='".$count[0]."' name='category_id[".$num1."][]' id='category_id' readonly=true size=5 /></td>
                <td><input type='text' name='category_name[".$num1."][]' readonly=true value='".$categoryNameList[1]."' size=12 /></td>
                <td><table>";
            $num=0;
            while($itemArray= mysqli_fetch_array($itemByCategory))
            { 
                $num++;
                $itemName=$objItem->getItemDetails($itemArray[0]);
                $itemNameArray=  mysqli_fetch_array($itemName);
				$form.="<tr><td><input type='checkbox' name='item_id_list[".$num1."][]' id='check[".$countItem."]' value='".$itemArray[0]."'>".$itemNameArray[2]."
				<span style='color:Red;' id='ItemList".$countItem."'></span></td></tr>";
				$countItem++;
			}
            $form.="</table></td><td><table>";
            for($i=1;$i<=$num;$i++){
            $form.="<tr><td><input type='text' maxlength=8 name='Amount[".$num1."][]' id='Amount[".$countAmnt."]' size=8 onkeypress='return isValidKeyAmountPurchaseOrder(event)' /><span style='color:Red;' id='Amnt".$countAmnt."'></span></td></tr>";
            $countAmnt++;
			}
            $form.="</table></td><td><select name='VendorList[".$num1."][]' id='VendorList[".$countVendor."]'><option value='0'>--select--</option>";
			$countVendor++;
            $vendorDetails=$objVendor->getCategory_VendorList($count[0]);
            while($vendorListArray= mysqli_fetch_array($vendorDetails))
            {
                $vendorNameList=$objVendor->getVendorDetails($vendorListArray[2]);
                $vendorNameArray=  mysqli_fetch_array($vendorNameList);
             $form.="<option value='".$vendorListArray[2]." '>".$vendorNameArray[1]."</option>";
            }
            
            $form.="</select><span style='color:Red;' id='VenList".$num1."'></span>
			</td><td><input type='text' align='center' name='current_date' id='current_date[".$countDate."]' value=".date("Y-m-d")." readonly=true size=11 /></td><td><script type='text/javascript' src='cal.js'></script>
            <input onclick='ds_sh(this);'  name='expected_date[]' readonly='readonly' id='expected_date[".$countDate."]' style='cursor: text;' size=11/>
			<span style='color:Red;' id='ExDate".$num1."'></span></td></tr>";
			$countDate++;
			$num1++;
			$count++;
        }
        $_SESSION['available_categories']=$num1++;
        $num1--;
        $form.="</table>
		<br/><br/><font align='left'>Total categories:<input type='text' size='1' readonly='true' id='totalCategory' value=$num1 />
		<br/><font align='left'>Total item:<input type='text' size='1' readonly='true' name='total' id='total' value='".$countItem."'></font><br/>
			<br/>
                       
			<input type='submit' name='place_order' value='Place PO'/>
			
            <input type='reset' value='Reset data' name='reset_data'/></form>
             "; 
        return $form;
    }
    function displayCreatedPurchaseOrder()
    {
               $obj=new POController();
               $objIndent=new IndentController();
               $para=  func_get_args();
               $purchaseOrdersGenerated=$obj->makeEntries($para[0],$para[1],$para[2],$para[3],$para[4],$para[5]);
               $indentStatus=$objIndent->changeIndentStatus();
               $form="";
			   $form.="<br/><br/><br/><br/>";
               if($purchaseOrdersGenerated==TRUE )
               {
               
               $form.="<h3>Details of the Purchase Orders against the Indent Id : <a   href=indexPO.php?id=8&code=".$_SESSION['selectedIndentId']." target='_blank'>".$_SESSION['selectedIndentId']."</a><br/>";
               $form.="<br/><form name='display_form' method='get' action=''>
                   <table align='center' border=1>
				   <tr><td align=center>Purchase Order Id</td>
				   <td align=center>Vendor Id</td>
				   <td align=center>Vendor Name</td>
				   <td align=center>Release Date</td>
				   <td align=center>Expected Date</td>
				   <td align=center>Amount</td>
				   <td align=center>Status</td></tr>";
               $PurchaseOrderDetails=$obj->selectPurchaseOrderList('IndentId',$_SESSION['selectedIndentId']);    
               while($PODetailsArray=  mysqli_fetch_array($PurchaseOrderDetails))
               {
                   if($PODetailsArray[6]!='cancelled')
                   {
                       $VendorDetails=$obj->getVendorDetails($PODetailsArray[1]);
                       $VendorDetailsArray=  mysqli_fetch_array($VendorDetails);
                       $form.="<tr><td><a   href=indexPO.php?id=4&code=".$PODetailsArray[0]." target='_blank'>".$PODetailsArray[0]."</a></td>
                           <td><a   href=indexPO.php?id=5&code=".$PODetailsArray[1]." target='_blank'>".$PODetailsArray[1]."</a></td>
                           <td>".$VendorDetailsArray[1]."</td>
						   <td>".$PODetailsArray[3]."</td>
						   <td>".$PODetailsArray[5]."</td>
						   <td>".$PODetailsArray[4]."</td>
						   <td>".$PODetailsArray[6]."</td></tr>";
                   }
               }
               
               $form.="</table><br/><br/>";
               $approvedIndent=$obj->selectIndentList('approved');
               $counter=0;
               while($approvedIndentArray=  mysqli_fetch_array($approvedIndent))
               {
                   if($approvedIndentArray[0]==$_SESSION['selectedIndentId'])
                       $counter++;
               }
               if($counter==0)
               $form.="<input type='submit' name='createPurchaseOrder' id='createPurchaseOrder' value='Back'/>
                   </form>";
           else {
               $form.="</form>";
                }
               }
              return $form;   
    }
    
    function cancelPurchaseOrder()
    {
      $obj1=new POController();    
    $form="";
    $form.="<br/><br/><br/><br/>  <h3>Cancellation of Purchase Order</h3> 
        <form name='cancelPurchaseOrder' action='' method='get'>
      <table align='center'><tr><td>Indent Id:</b></td>
      <td>
    <input type='text' name='indentIdCancel' id='indentId' onkeypress='return isValidKeyPurchaseOrder(event)'><img src='1.png' height='15' width='15' title='select indent id against which cancellation of purchase order has to be done if indent id is known Ex:1001'/>
    </td></tr>
    <tr><td></td><td>	If you do not remember the ID,use the drop down:</td></tr>
    <tr><td>Indent Id:</size></b></td><td>
    <select name='IndentIdCancelDropDown' id='IndentIdCancelDropDown'><option value='0'>--SELECT--</option>";
    $indentIdResult=$obj1->getIndentIdsForCancellationOfPurchaseOrders();
    $row= mysqli_num_rows($indentIdResult);
    if($row!=0)
    {
        while($indentIdArray=  mysqli_fetch_array($indentIdResult))
        {
            $form.="<option value='".$indentIdArray[0]."'>".$indentIdArray[0]."</option>";
        }
    }
    
    $form.="</select><img src='1.png' height='15' width='15' title='select indent id whose purchase order needs to be cancelled'/>
        </td></tr>
        </table>
		<br/>
        <input type='submit' name='proceedWithCancel' id='proceedWithCancel' value='Proceed' onclick='return onclickValidateCancelPurchaseOrder(this)' />
        <input type='reset' value='Reset'/>
       </form> ";
    return $form; 
        
    }
    function cancelPurchaseOrderDisplay()
    {
        $objIndent=new IndentController();
        $obj=new POController();
        $para=  func_get_args();
        $num=  func_num_args();
        $formDisplay="";
        if($num==2)
        {
            $res1=$objIndent->updateIndentStatusOnCancellation($para[0]);
            $res2=$objIndent->updateIndent_ItemStatusOnCancellation($para[0],$para[1]);
            $res3=$obj->cancelPO($para[1]);
           if($res1 && $res2 && $res3)
           {
               $formDisplay.="Purchase Order ".$para[1]." against indent has been cancelled";
           }
           else
           {
               $formDisplay.="Purchase Order ".$para[1]." against indent has not been cancelled";
           }
            
        }
        $fetch_po_details=  $obj->selectPurchaseOrderList('IndentId',$para[0]);
        $form="";
        $form.="  <h3 align='center'><font color=black>Cancellation Of Purchase Order</font></h3> 
        <h3 align='center'>Purchase Order Details  :</h3>
        <form name='cancelPurchaseOrderDisplay' method='get' action=''><table border='1' align='center'>
        <tr><th>Purchase Order Id</th><th>Vendor Id</b></h3></th><th>Indent Id</b></h3></th><th>Release Date</b></h3>
        </th><th>Amount</b></h3></th><th>Expected Date</b></h3></th><th>Status</b></h3></th><th>Cancel</b></h3></th></tr>";
        while($row = mysqli_fetch_array($fetch_po_details))
	{
	   $form.="<tr><td><a   href='indexPO.php?id=4&code=".$row[0]."' target='_blank'>".$row[0]."</a></td>
               <td><a   href=indexPO.php?id=5&code=".$row[1]." target='_blank'>".$row[1]."</a></td>
                   <td><a   href=indexPO.php?id=8&code=".$row[2]." target='_blank'>".$row[2]."</a></td><td>".$row[3]."</td><td>".$row[4]."</td>
           <td>".$row[5]."</td><td>".$row[6]."</td>";
	   if($row[6]=='pending')
	   $form.="<td align='center'><a href='indexPO.php?cancelPOId=".$row[0]."' onclick='return confirmationFunction($row[0],$row[2]);' >Cancel</a></td></tr>";  
	}
        
        $form.="</table><br/><a href='indexPO.php?id=2'>Go Back</a>";
        return $form;
        
    }
    function getDetails()
    {
       $form="";
       $obj=new POController();
       $form.="<br/><br/><br/><br/><h3>Get Details of Purchase Order</h3><br/>
       <table align=center><tr><td>Search by: </td>
       <td><select id='search' onChange='return showForm(this)'>
       <option>--SELECT--</option>
       <option>Purchase Order Id</option>
       <option>Vendor</option>
       <option>Indent</option>
       <option>Status</option>
       <option>Release Date</option>
       <option>Item</option>
       <option>Category</option>
       <option>Year</option>
       <option>Month</option>
    </select></td><td><img src='1.png' height='15' width='15' title='select an option from the menu to search for a particular purchase order'/></td>
    </tr></table>
    <table id='monthForm' style='display:none' align='center'>
    <form action='' method='get' name='selectMonth' onSubmit='return checkInput(9)'>
    <tr><td>Choose Month : </td><td><select id='MonthPO' name='MonthPO' ><option value='0'>--SELECT--</option>
    <option value='01'>January</option><option value='02'>February</option><option value='03'>March</option><option value='04'>April</option>
    <option value='05'>May</option><option value='06'>June</option><option value='07'>July</option><option value='08'>August</option>
    <option value='09'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option>
    </select></td></tr>
           <tr><td><input type=submit name='searchMonthButton' value='search' /></td>
           <td><input type=reset value=reset /></td></tr>
    </form>
    </table>
    <table id='yearForm' style='display:none' align='center'>
    <form action='' method='get' name='selectYear' onSubmit='return checkInput(8)'>
    <tr><td>Choose Year : </td><td><select id='YearPO' name='YearPO' ><option value='0'>--SELECT--</option>
    <option value='2013'>2013</option>
    <option value='2014'>2014</option>
    <option value='2015'>2015</option>
    </select></td></tr>
           <tr><td><input type=submit name='searchYearButton' value='search' /></td>
           <td><input type=reset value=reset /></td></tr>
    </form>
    </table>
    <table id='categoryForm' style='display:none' align='center'>
    <form action='' method='get' name='selectCategory' onSubmit='return checkInput(7)'>
    <tr><td>Choose Category : </td><td><select id='CategoryPO' name='CategoryPO' ><option value='0'>--SELECT--</option>";
       $objCategory=new CategoryController();
       $categoryResult=$objCategory->selectAllCategories();
       while($categoryArray=  mysqli_fetch_array($categoryResult))
       {
           $form.="<option value=$categoryArray[0]>$categoryArray[0]---$categoryArray[1]</option>";
       }
       
       $form.="</select></td></tr>
           <tr><td><input type=submit name='searchCategoryButton' value='search' /></td>
           <td><input type=reset value=reset /></td></tr>
           </form></table>
           <table id='itemForm' style='display:none' align='center'>
            <form action='' method='get' name='selectItem' onSubmit='return checkInput(6)'>
            <tr><td>Choose  Item : </td><td><select id='ItemPO' name='ItemPO' ><option value='0'>--SELECT--</option>";
       $objItem=new ItemController();
       $itemResult=$objItem->selectAlItem();   
      while($itemArray=  mysqli_fetch_array($itemResult))
       {
           $form.="<option value='$itemArray[0]'>$itemArray[0]----$itemArray[2]</option>";
       }
    $form.="</select></td>
        <tr><td><input type=submit name='searchItemButton' value='search' /></td>
        <td><input type=reset value=reset /></td></tr></form>
        </table>
        <table id='DateForm' style='display:none' align='center'>
		    <form action='' method='get' name='DForm' onSubmit='return checkInput(2)'>
		     <tr><td>Enter Date : </td><td>Day: </td><td><select name='day'><option>--SELECT--</option>";
        for($i=01;$i<32;$i++){if($i<10)$form.='<option>0'.$i.'</option>';
        else
            $form.='<option>'.$i.'</option>';
        }
		                          $form.="</select></td><td>Month: </td><td><select name='month'><option>--SELECT--</option>";
                                               for($i=01;$i<13;$i++){if($i<10)$form.="<option>0".$i."</option>";
                                                                     else 
                                                                       $form.="<option>".$i."</option>";
                                               }
		                          $form.="</td><td>Year: </td><td><select name='year'><option>--SELECT--</option>";
                                            for($i=2013;$i<2050;$i++)
                                            {$form.="<option>".$i."</option>";}		                          
             $form.="</td></tr><tr><td></td><td></td><td></td><td><input type=submit name='searchDateButton' value='submit'></td><td><input type='reset' value='clear'></td></tr>
     	   </form>
    </table>
    <table id='statusSearchForm' style='display:none' align='center'>
    <form action='' method='get'  name='statusForm' onSubmit='return checkInput(5);'>
     <tr><td>Choose  Status : </td><td><select id='statusPO' name='statusPO' ><option value='0'>--SELECT--</option>
     <option value='pending'>Pending</option>
     <option value='cancelled'>Cancelled</option>
     <option value='received'>Received</option>
     <option value='partial'>Partial</option></select></tr>
     <tr><td><input type=submit value='search' name='searchStatusButton' /></td>
     <td><input type=reset value=reset /></td></tr>
     </form>
    </table>
    <table id='indentSearchForm' style='display:none' align='center'>
    <form action='' method='get' name='IForm' onsubmit='return checkInput(4)'>
      <tr><td>Enter Indent id : </td>
      <td><input type=text name='Indentid' onkeypress='return isValidKeyPurchaseOrder(event)'></td><td><img src='1.png' height='15' width='15' title='Type a Indent Id whose details you would like to know Ex:10'/></td></tr>
      <tr><td><input type=submit name='searchIndentButton' value='Search'></td><td><input type='reset' value='clear'></td></tr>
    </form>
    </table>
    <table id='IdForm' style='display:none' align='center'>
    <form action='' method='get' name='PForm' onSubmit='return checkInput(3)'>
      <tr><td>Enter Purchase Order id : </td>
      <td><input type=text name='Pid' onkeypress='return isValidKeyPurchaseOrder(event)'></td><td><img src='1.png' height='15' width='15' title='Type a Purchase Order whose details you would like to know Ex:10'/></td></tr>
      <tr><td><input type=submit name='searchPurchaseOrderButton' value='Search'></td><td><input type='reset' value='clear'></td></tr>
    </form>
    </table>
    <table id='VendorForm' style='display:none' align='center'>
    <form action='' method='get'  name='VForm' onSubmit='return checkInput(1);'>
     <tr><td>Choose Vendor Name : </td><td><select id='Vname' name='Vname' ><option value='0'>--SELECT--</option>";
       //fetch vendor details and add to the select dro7pdown                     
       $objVendor=new VendorController();
       $res=$objVendor->getCompleteVendorDetails();                                          
       while($vendorArray=  mysqli_fetch_array($res))
       {
       $form.="<option value='$vendorArray[0]'>$vendorArray[1]</option>";
       }
       $form.="</select></td><td><img src='1.png' height='15' width='15' title='Select a vendor according to which you wish to group the purchase orders'/></td></tr>
	      <tr><td><input type='submit' name='searchVendorNameButton' value='submit'></td><td><input type='reset' value='clear'></td></tr>
	    </form>
    </table>
    ";
             return $form;
        
    }
	function displayHelp()
	{
	$form="";
	$form.="<br/><br/><br/><br/><br/><br/><br/><br/><table><tr><td><h2>1. Click on the CREATE PURCHASE ORDER tab to get the following screen. Fill in the indent id. </h2></td></tr><tr><td><img src='pics/po1.jpg'/>
		</td></tr><tr><td><h2>2. The details of that indent , along with all the purchase orders against it, are displayed. The purchase orders are classified into two categories.</h2></td></tr><tr><td><img src='pics/po2.jpg'/></td></tr>
	<tr><td><h2>3. Finally click the Create Purchase Order link at the bottom of the page.</h2></td></tr><tr><td><img src='pics/po3.jpg' /></td></tr>
	<tr><td><h2>4. The following screen appears:</h2></td></tr><tr><td><img src='pics/po4.jpg'/></td></tr>
	<tr><td><h2>5. Fill out the details for each of the entries:</h2></td></tr><tr><td><img src='pics/po5.jpg' /></td></tr>
	<tr><td><h2>6. Finally click the Place Purchase Order link at the bottom of the page. </h2></td></tr><tr><td><img src='pics/po6.jpg'/></td></tr>
	<tr><td><h2>7. The details of the purchase order you have just placed are shown here. The purchase order ids just created, are also shown.</h2></td></tr><tr><td><img src='pics/po7.jpg'/></td></tr>
	<tr><td><h2>8. To cancel a purchase order already created, click the CANCEL PURCHASE ORDER tab. </h2></td></tr><tr><td><img src='pics/po8.jpg'/></td></tr>
	<tr><td><h2>9. Then the following screen appears: </h2></td></tr><tr><td><img src='pics/po9.jpg'/></td></tr>
	<tr><td><h2>10. The purchase orders, with options for cancellation appears.</h2></td></tr><tr><td><img src='pics/po10.jpg'/></td></tr>
	<tr><td><h2>11. Click on the Search tab to search for a particular purchase order. </h2></td></tr><tr><td><img src='pics/po11.jpg'/></td></tr>
	<tr><td><h2>12. The Search By option appears. Choose if you want to search by purchase order id or by vendor. </h2></td></tr><tr><td><img src='pics/po12.jpg'/></td></tr>
	<tr><td><h2>13. If you choose to search by purchase order id, enter the purchase order id and view its details.</h2></td></tr><tr><td><img src='pics/po13.jpg'/></td></tr>
	<tr><td><h2>14. If you choose to search by vendor name, enter the vendor name and view the details. </h2></td></tr><tr><td><img src='pics/po14.jpg'/></td></tr>
	</table>";
	return $form;
	}
}
?>