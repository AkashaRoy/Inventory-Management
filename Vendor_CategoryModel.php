<?php
include_once 'Database.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vendor_CategoryModel
 *
 * @author kiit
 */
class Vendor_CategoryModel extends Database
{
        function fetchVendorInfo()
    {
      $catID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT vendor.vendor_id, vendor.name
FROM vendor
JOIN category_vendor ON category_vendor.vendor_id = vendor.vendor_id
WHERE category_vendor.category_id =$catID
ORDER BY vendor.vendor_id";
		$result=mysqli_query($con,$query);
		return $result;
    }
     function fetchVendorInformation()
    {
      $itemID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT vendor.vendor_id, vendor.name
FROM vendor
JOIN category_vendor ON category_vendor.vendor_id = vendor.vendor_id
JOIN item ON item.category_id = category_vendor.category_id
WHERE item.item_id =$itemID
ORDER BY vendor.vendor_id";
		$result=mysqli_query($con,$query);
		return $result;
    }
	function fetchVendorList()
	{
		 //$catID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT category.category_id, category.name, vendor.vendor_id, vendor.name
        FROM  `category` 
    JOIN  `category_vendor` ON category_vendor.category_id = category.category_id
    JOIN  `vendor` ON category_vendor.vendor_id = vendor.vendor_id
    WHERE 1 
        ORDER BY vendor.vendor_id";
		$result=mysqli_query($con,$query);
		return $result;
	}

      function fetchVendor_ItemList()
{
    
    $con = parent::connectToDB();
    $query="SELECT item.item_id, item.name_brand, vendor.vendor_id, vendor.name
    FROM  `item` 
    JOIN  `category_vendor` ON category_vendor.category_id = item.category_id
    JOIN  `vendor` ON category_vendor.vendor_id = vendor.vendor_id
    WHERE 1 ORDER BY vendor.vendor_id";
     $result=mysqli_query($con,$query);
		return $result;
}
    
}
?>