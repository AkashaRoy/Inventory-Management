<?php
include_once "VendorModel.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class VendorController
{
    function getCompleteVendorDetails()
    {
        $obj=new VendorModel();
        return $obj->getCompleteVendorDetails();
    }
     function getCategoryDetailsFromCategory_Vendor()
     {
         $para=  func_get_args();
         $obj=new VendorModel();
         return $obj->getCategoryDetailsFromCategory_Vendor($para[0]);
     }
    function getCategory_VendorList()
    {
        $para=  func_get_args();
        $obj=new VendorModel();
        return $obj->getCategory_VendorList($para[0]);
    }
       function getVendorDetails()
    {
        
        $obj=new VendorModel();
        if(func_num_args()==1)
        {
            $para=  func_get_args();
            return $obj->getVendorDetails($para[0]);
        }
       }
	   
	   function getAllVendorDetails($code)
{
$vendorModelObj=new VendorModel();
	$result=$vendorModelObj->fetchAllVendorData($code);
	if($result)
	{
	   
	    return $result;
	}
	else
	{
	    return false;
	}

}

function addVendor()
    {
	    if($this->validateVendorData(func_get_arg(0),func_get_arg(1),func_get_arg(3),func_get_arg(5)))
	    {
            $arg2 = func_get_arg(2);
	        if(!is_null($arg2) && !empty($arg2))
            {
                if(!$this->validateVendorData($arg2)) {
                    return FALSE;
                }
            }
            $arg4 = func_get_arg(4);
            if(!is_null($arg4) && !empty($arg4))
            {
                if(!$this->validateVendorData(func_get_arg(4))){
                    return FALSE;
                }
            }
            $vdcntobj=new VendorModel();
	        $res=$vdcntobj->insertVendor(func_get_arg(0),func_get_arg(1),func_get_arg(2),func_get_arg(3),func_get_arg(4),func_get_arg(5));
	        if($res==2)
			{
				return 2;
				
			}
			else if($res==3)
			{
				return 3;
			}
			else
			{
				return false;
				}
	    }
	    else
	    {
		    return false;
	    }
    }    
    function getSavedVendorDetails()
{
$vendorModelObj1 = new VendorModel();
        $args = func_get_args();
        $vendorID = func_get_arg(0);
        $vendorName = func_get_arg(1);
        $vendorAddress = func_get_arg(2);
        $vendorEmail = func_get_arg(3);
        $vendorPhone = func_get_arg(4);
        $vendorPhone2 = func_get_arg(5);
        //$vendorCategory = func_get_arg(6);
/*        if(!is_null(func_get_arg(0)))
        {
            $vendorID = func_get_arg(0);
        }
        else
        {
            $vendorName = func_get_arg(1);
            $vendorPhone = func_get_arg(4);
        }*/
        $result = $vendorModelObj1->fetchSavedVendorDetails($vendorID,$vendorName,$vendorAddress,$vendorEmail,$vendorPhone,$vendorPhone2);
		$row=mysqli_fetch_array($result);
		if(empty($row))
			return false;
		else
			return $row;
}
    function getVendorDetail()
    {
        $vendorModelObj1 = new VendorModel();
        $arg0 = NULL;
        $arg1 = NULL;
        $arg2 = NULL;
        if(!is_null(func_get_arg(0)))
        {
            $arg0 = func_get_arg(0);
        }
        else
        {
            $arg1 = func_get_arg(1);
            $arg2 = func_get_arg(2);
        }
        $result = $vendorModelObj1->fetchVendorDetails($arg0,$arg1,$arg2);
        $i = 0;
        if(mysqli_num_rows($result) == 1)
        {
            $row[0] = mysqli_fetch_array($result);
            return $row;
        }
        while($i <  mysqli_num_rows($result))
        {
            $row[$i]=mysqli_fetch_array($result);
            $i++;
        }
        if(empty($row))
            return false;
        else
            return $row;
    }
	
    function validateVendorData()
    {
	    $dataarr=func_get_args();
	    $FLAG_VALID=true;
	    for($i=0;$i<sizeof($dataarr);$i++)
	    {
	        if(!isset($dataarr[$i]) || empty($dataarr[$i]))
		        $FLAG_VALID=false;
	    }
	    return $FLAG_VALID;
    }
	
    function editVendorData()
    {
	    $dataarr1=func_get_args();
	    $name=$dataarr1[0];
	    $address=$dataarr1[1];
	    $email=$dataarr1[2];
	    $phone1=$dataarr1[3];
	    $phone2=$dataarr1[4];
	    $category=$dataarr1[5];
	    $vendorID=$dataarr1[6];
        if(!is_null($phone2))
	    {   
            if($this->validateVendorData($name,$address,$phone1,$category,$vendorID))
	        {
                $arg2 = func_get_arg(2);
                if(!is_null($arg2) && !empty($arg2))
                {
                    if(!$this->validateVendorData(func_get_arg(2))){
                        return FALSE;
                    }
                }
                $arg4 = func_get_arg(4);
                if(!is_null($arg4) && !empty($arg4))
                {
                    if(!$this->validateVendorData(func_get_arg(4))){
                        return FALSE;
                    }
                }
	            $vendorModelObj=new VendorModel();
	            if($vendorModelObj->updateVendorData($name,$address,$email,$phone1,$phone2,$category,$vendorID))
		            return true;
	            else
		            return false;
	        }
	        else {
	            return false;
	        }
        }
        else{
            if($this->validateVendorData($name,$address,$email,$phone1,$category,$vendorID))
	        {
	            $vendorModelObj=new VendorModel();
	            if($vendorModelObj->updateVendorData($name,$address,$email,$phone1,$phone2,$category,$vendorID))
		            return true;
	            else
		            return false;
	        }
	        else {
	            return false;
	        }
        }
    }

    function getVendorCategory()
    {
        $vendorModelObj2 = new VendorModel();
        $result = $vendorModelObj2->fetchVendorCategory(func_get_arg(0));
        $i = 0;
        while($row[$i]=mysqli_fetch_array($result))
        {
            $i++;
        }
        return $row;
    }
	
}
?>