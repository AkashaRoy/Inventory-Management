<?php
include_once 'Database.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class VendorModel extends Database
{
    function getCategory_VendorList()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="select * from category_vendor where category_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
       
        
    }
    function getCategoryDetailsFromCategory_Vendor()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="select * from category_vendor where vendor_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
    }
    
    function getVendorDetails()
    {
      $para=  func_get_args();
      $num=  func_num_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();   
        if($num==1)
            $query="select * from vendor where vendor_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
        {
            
            return $res;
        }
        else
            return false;
        
    }
    function getCompleteVendorDetails()
    {
        
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();   
        $query="select * from vendor";
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else {
            return false;
        }
               
    }
	function insertVendor()
    {
        $arg = func_get_args();
		//var_dump($arg);die();
		//echo "jkhjkhkhkh";
        $con = parent::connectToDB();
        $query="SELECT count(*) FROM `vendor` WHERE `address`='$arg[1]' && `email`='$arg[2]'&& `phone1`='$arg[3]' ";
		$res=mysqli_query($con,$query);
		$arr=mysqli_fetch_array($res);
		//var_dump($arr);
		if($arr[0]!=0)
		{
			return 2;
		}
		else
		{
        $query1 = "INSERT INTO `vendor`(`name`, `address`, `email`, `phone1`,`phone2`) VALUES ('$arg[0]','$arg[1]','$arg[2]','$arg[3]','$arg[4]')";
	    if(mysqli_query($con, $query1))
	    {	
	        $query2="SELECT MAX(`vendor_id`) FROM `vendor`";
	        $result= mysqli_query($con,$query2);
	        $array=mysqli_fetch_array($result);
	        if($array)
	        {
		    foreach($arg[5] as $value)
		    {
		        $query3="INSERT INTO `category_vendor`(`category_id`,`vendor_id`) VALUES ($value,$array[0]);";
		        $newResult=mysqli_query($con,$query3);
		    }
		    if($newResult)
		    {
		        return 3;
		    }
		    else
		    {
		        return FALSE;
		    }
	        }
		}
	        else
	        {
		    return FALSE;
	        }
	    }
	}
    
    
    function updateVendorData()
    {
        $args=func_get_args();
	    $host = 'localhost';
	    $user = 'root';
	    $password = '';
	    $database = 'vocational_training';
	    $link = parent::connectToDB();
	    $query = "UPDATE `vendor` SET `name`='$args[0]', `address`='$args[1]', `email`='$args[2]', `phone1`='$args[3]', `phone2`='$args[4]' WHERE `vendor_id`=$args[6]";
	    $result = mysqli_query($link, $query);
        if($result)
        {
            $newCategories = $args[5];
            $oldCategoriesQuery = "SELECT * FROM `category_vendor` WHERE `vendor_id`=$args[6]";
            $oldCategoriesResult = mysqli_query($link,$oldCategoriesQuery);
            $i = -1;
            $oldCategories = "";
            while($row = mysqli_fetch_array($oldCategoriesResult))
            {
                $oldCategories[++$i] = $row;
            }
            if($oldCategories != "") {
                for($i=0;$i<sizeof($oldCategories);$i++)
                    $oldCategoriesID[$i] = $oldCategories[$i]['category_id'];
            }
            else{
                $oldCategoriesID = NULL;
            }
            $new = "";
            $deleted = "";
            $i = -1;
            $FLAG_FOUND = FALSE;
            if(!is_null($oldCategoriesID)) {
                foreach($oldCategoriesID as $value)
                {
                    $FLAG_FOUND = FALSE;
                    foreach($newCategories as $value1)
                    {
                        if($value==$value1)
                        {
                            $FLAG_FOUND = TRUE;
                            break;
                        }
                    }
                    if(!$FLAG_FOUND)
                    {
                        $deleted[++$i] = $value;
                    }
                }
                $i = -1;
                $FLAG_FOUND = FALSE;
                foreach($newCategories as $value)
                {
                    $FLAG_FOUND = FALSE;
                    foreach($oldCategoriesID as $old)
                    {
                        if($value==$old)
                        {
                            $FLAG_FOUND = TRUE;
                            break;
                        }
                    }
                    if(!$FLAG_FOUND)
                    {
                        $new[++$i] = $value;
                    }
                }
            }
            else {
                $new = $newCategories;
            }
            if($deleted != "" && sizeof($deleted) > 0){
                foreach($deleted as $value)
                {
                    $query = "DELETE FROM `category_vendor` WHERE `vendor_id`=$args[6] AND `category_id`=$value";
                    if(is_null(mysqli_query($link, $query))) {
                        return FALSE;
                    }
                }
            }
            if($new != "" && sizeof($new) > 0){
                foreach($new as $value)
                {
                    $query = "INSERT INTO `category_vendor` VALUES (NULL,$value,$args[6])";
                    if(is_null(mysqli_query($link, $query))) {
                        return FALSE;
                    }
                }
            }
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }

	function fetchSavedVendorDetails()
	{
    	$args = func_get_args();
        $vendorID = func_get_arg(0);
        $vendorName = func_get_arg(1);
        $vendorAddress = func_get_arg(2);
        $vendorEmail = func_get_arg(3);
        $vendorPhone = func_get_arg(4);
        $vendorPhone2 = func_get_arg(5);
        $query = "SELECT `vendor_id`, `name`, `address`, `email`, `phone1`, `phone2` FROM `vendor` WHERE";
        $i = 0;
        $count = 0;
        foreach($args as $value)
        {
            if(!is_null($value) && !empty($value))
            {
                if($count!=0) {
                    $query .= " AND ";
                }
                switch($i)
                {
                    case 0: $query.=" `vendor_id` = $value";
                        break;
                    case 1: $query.=" `name` = '$value'";
                        break;
                    case 2: $query.=" `address` = '$value'";
                        break;
                    case 3: $query.=" `email` = '$value'";
                        break;
                    case 4: $query.=" `phone1` = '$value'";
                        break;
                    case 5: $query.=" `phone2` = '$value'";
                        break;
                }
                $count++;
            }
            $i++;
        }
        $con = parent::connectToDB();
       $result=mysqli_query($con,$query);
		return $result;
    
	}
   function fetchVendorDetails()
    {
        $vendorID=func_get_arg(0);
        $vendorName=func_get_arg(1);
        $vendorPhone=func_get_arg(2);
        $con = parent::connectToDB();
        if(!is_null($vendorID) || !empty($vendorID))
            $query="SELECT `vendor_id`, `name`, `address`, `email`, `phone1`, `phone2` FROM `vendor` WHERE `vendor_id`=$vendorID";
        else {
            $query="SELECT `vendor_id`, `name`, `address`, `email`, `phone1`, `phone2` FROM `vendor` ";
            $count = 0;
            if(!empty($vendorName) && isset($vendorName))
            {
                $query .= "WHERE name='$vendorName' ";
                $count++;
            }
            if(!empty($vendorPhone) && isset($vendorPhone))
            {
                if($count>0)
                    $query .= " AND ";
                else {
                    $query .= " WHERE ";
                }
                $query .= " (`phone1`= $vendorPhone || `phone2`=$vendorPhone) ";
            }
        }
        $result=mysqli_query($con,$query);
		return $result;
    }

    function fetchVendorCategory()
    {
        $vendorID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT `category_id` FROM `category_vendor` WHERE `vendor_id`=$vendorID";
		$result=mysqli_query($con,$query);
		return $result;
    }
	function fetchVendorName()
    {
		$vendorID=func_get_arg(0);
        $con = parent::connectToDB();
        $query="SELECT `name` FROM `vendor` WHERE `vendor_id`=$vendorID";
        $result=mysqli_query($con,$query);
		return $result;
    }
	
	function fetchAllVendorData($code)
{
$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	$query="select * from vendor where vendor_id=$code";
	$res = mysqli_query($link, $query);
	if($res)
	{
	    return $res;
		}
	else
	{
	    return false;
	}

}

}
?>