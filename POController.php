<?php
include_once "POModel.php";
include_once "VendorController.php";
include_once "IndentController.php";
include_once "ItemController.php";
include_once "CategoryController.php";
class POController
{
    function getDetailsToDisplayForIndentId()
	{
		$para=func_get_args();
		$obj=new POModel();
		return $obj->fetchDetailsToDisplayForIndentId($para[0]);
	}
    function getIndentIdsForCancellationOfPurchaseOrders()
    {
        $obj=new POModel();
        return $obj->indentIdsForCancellationOfPurchaseOrders();
    }
    function getDataForReport()
    {
        $para=  func_get_args();
        $obj=new POModel();
        if(func_num_args($para)==2)
        return $obj->getDataForReport($para[0],$para[1]);
        else
            return $obj->getDataForReport ($para[0],$para[1],$para[2],$para[3]);
    }
    function getCompleteVendorDetails()
    {
        $obj=new VendorController();
        return $obj->getCompleteVendorDetails();
    }
    function selectParticularIndentRecord()
    {
        $para=  func_get_args();
        $obj=new IndentController();
        return $obj->selectParticularIndentRecord($para[0]);
    }
    function getRowFromDepartment()
    {
        $para=  func_get_args();
        $obj=new DepartmentController();
        return $obj->getRow($para[0]);
    }
    function getCategoryDetailsFromCategory_Vendor()
    {
        $para=  func_get_args();
        $obj=new VendorController();
        return $obj->getCategoryDetailsFromCategory_Vendor($para[0]);
    }
    function selectPORecords()
    {
        $para=  func_get_args();
        $obj=new POModel();
        return $obj->selectPORecords($para[0]);
    }
    function cancelPO()
    {
        $para=  func_get_args();
        $obj=new POModel();
        return $obj->cancelPO($para[0]);
    }
    function updateIndentStatusOnCancellation()
    {
        $para=  func_get_args();
        $obj=new IndentController();
        return $obj->updateIndentStatusOnCancellation($para[0]);
    }
        
    function updateIndent_ItemStatusOnCancellation()
    {
        $para=  func_get_args();
        $obj=new IndentController();
        return $obj->updateIndent_ItemStatusOnCancellation($para[0],$para[1]);
    }
    
    function changeIndentStatus()
    {
        $obj=new IndentController();
        return $obj->changeIndentStatus();
    }
    function makeEntries()
    {
        $obj=new POModel();
        $para=  func_get_args();
        return $obj->makeEntries($para[0],$para[1],$para[2],$para[3],$para[4],$para[5]);
    }
    function getItemDetails()
    {
        $obj=new ItemController();
        if(func_num_args()==1)
        {
            $para=  func_get_args();
            return $obj->getItemDetails($para[0]);
        }
    }
    function categoryList()
    {
        $para=func_get_args();
        $obj=new CategoryController();
        return $obj->categoryList($para[0]);
        
    }
       function getVendorDetails()
    {
      
      $obj=new VendorController();
      if(func_num_args()==1)
      {
          
          $para=  func_get_args();
          return $obj->getVendorDetails ($para[0]);
      }
       }
    function getCategory_VendorList()
    {
        $para=  func_get_args();
        $obj=new VendorController();
        return $obj->getCategory_VendorList($para[0]);
    }
    function getItemUsingCategory()
    {
        $para=  func_get_args();
        $obj=new IndentController();
        return $obj->getItemUsingCategory($para[0]);
    }
    function countCategory()
    {
        $obj=new IndentController();
        return $obj->countCategory();
    }
    function selectIndentList()
    {
        $para= func_get_args();
        $obj=new IndentController();
        
        return $obj->selectIndentList($para[0]);
        
    }
    function selectIndent_ItemList()
    {
        $para=func_get_args();
        $obj=new IndentController();
        if(func_num_args() == 1)
     {
         return $obj->selectIndent_ItemList($para[0]);
     }
     else
     return $obj->selectIndent_ItemList($para[0],$para[1],$para[2]);
        
    }
    function selectPurchaseOrderList()
    {
        $para=  func_get_args();
        $obj=new POModel();
        if(func_num_args()==2 )
        return $obj->selectPurchaseOrderList($para[0],$para[1]);
    else 
        return $obj->selectPurchaseOrderList($para[0]);
    
    }
	
	function getPurchaseDetails($ui)
   {
	$POModelObj=new POModel();
	$result=$POModelObj->fetchPurchaseDetails($ui);
	if($result)
	{
	    return $result;
	}
	else
	{
	    return false;
	}
}

function getPOId()
{
$POModelObj2=new POModel();
	$result2=$POModelObj2->fetchPOId();
	if($result2)
	{
	    return $result2;
	}
	else
	{
	    return false;
	}

} 
function getPurchase_orderForVendor()
    {
        $purchase_orderModelObj = new POModel();
        $result = $purchase_orderModelObj->fetchPurchase_orderForVendor(func_get_arg(0));
		$index=0;
		$array=NULL;
		while($row=mysqli_fetch_array($result))
		{
			$array[$index] = $row;
			$index++;
		}
		return $array;
    }
	
	function update_PO()
    {
        $para=  func_get_args();
        $obj8=new POModel();
        return ($obj8->update_PO($para[0],$para[1]));
        
    }
    function update_Indent_Item()
    {
        $para=  func_get_args();
    $obj9=new IndentController();
    return $obj9->update_Indent_Item($para[0]);
    }
    function cancel_PO() 
    {
    
        $para=  func_get_args();
        $obj7=new POModel();
        return $obj7->cancel_PO($para[0]);
    }
    function fetch_PO_details()
    {
        
        $obj6=new POModel();
        if(func_num_args()!=0)
        {
            $para=  func_get_args();
            return($obj6->fetch_PO_details($para[0]));
        }
        else
        return $obj6->fetch_PO_details();
        
    }
   /* function getVendorDetails()
    {
        $para=  func_get_args();
        $obj8=new VendorController();
        return $obj8->getVendorDetails($para[0]);

        
    }*/
    function add_to_POdb()
    {
         $para=  func_get_args();
    $obj5=new POModel();
    return $obj5->add_to_POdb($para[0],$para[1],$para[2]);
    }
    function fetchCategory_Vendor()
    {
    $para=  func_get_args();
    
    $obj4=new VendorController();
    return $obj4->fetchCategory_Vendor($para[0]);
    }
    function fetchItemList()
    {
       $para=  func_get_args();
       $obj4=new ItemController();
    return $obj4->fetchItemList($para[0]); 
    }
    function getIndentDetails() {
        $validate=1;
      $obj2=new IndentController();     
      if(func_num_args()!=0)  
      {
    $para=  func_get_args();
   /* for($i=0;$i<func_num_args();$i++)
    {
        if(empty($para[$i]) || !isset($para[$i]))
        {
            $validate=0;
        }
    }
    if($validate==1)*/
    return $obj2->fetchIndentList($para[0]);
    /*else if($validate==0 && $para[0]=='0')
    {
        $_SESSION['err_msg']="the fields provided by you is incorrect or empty";
        header('location:index.php');
    }*/
      }
         else
    return $obj2->fetchIndentList();
               
    }
    function getIndent_ItemDetails()
    {
        $obj3=new IndentController();
        return $obj3->fetchIndent_ItemDetails();
    }
   function modify_Indent_Status()
   {
    $para=  func_get_args();
    $obj=new IndentController();
    return $obj->updateIndentDetils($para[0]);
   }
    
}
?>