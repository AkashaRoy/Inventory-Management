<?php
include_once 'Vendor_CategoryModel.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VendorController
 *
 * @author kiit
 */
class Vendor_CategoryController {
    
    
   
	function getVendorInfo()
	{
		$vendor_catModelObj = new Vendor_CategoryModel();
        $result = $vendor_catModelObj->fetchVendorInfo(func_get_arg(0));
		$i=0;
        while($row[$i]=mysqli_fetch_array($result))
		{
			$i++;
		}
		
        return $row;
    
	}
        function getVendorInformation()
	{
		$vendor_catModelObj = new Vendor_CategoryModel();
        $result = $vendor_catModelObj->fetchVendorInformation(func_get_arg(0));
		$i=0;
        while($row[$i]=mysqli_fetch_array($result))
		{
			$i++;
		}
		
        return $row;
    
	}
function getVendorList()
{
	$vendor_catModelObj = new Vendor_CategoryModel();
        $result = $vendor_catModelObj->fetchVendorList();
		$i=0;
        while($row[$i]=mysqli_fetch_array($result))
		{
			$i++;
		}
		
        return $row;
}
function getVendor_ItemList()
{
	$vendor_catModelObj = new Vendor_CategoryModel();
        $result = $vendor_catModelObj->fetchVendor_ItemList();
		$i=0;
        while($row[$i]=mysqli_fetch_array($result))
		{
			$i++;
		}
		
        return $row;
}

 

}
?>