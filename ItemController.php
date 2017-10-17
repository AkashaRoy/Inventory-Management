<?php
include_once "ItemModel.php";
class ItemController
{
function selectAlItem()
    {
        $objItem=new ItemModel();
        return $objItem->selectAllItem();
    }
    function getItemDetails()
    {
         $obj=new ItemModel();
        if(func_num_args()==1)
        {
            $para=  func_get_args();
            return $obj->getItemDetails($para[0]);
        }
    }
	
	function getAllItemData2($indent)
{
	$itemModelObj=new ItemModel();
	$result=$itemModelObj->fetchAllItemData2($indent);
	if($result)
	{
	   
	    return $result;
	}
	else
	{
	    return false;
	}
}
	
function get1()
{
	$args=func_get_args();
	$itemModelObj1=new ItemModel();
	//$r3=$itemModelObj1->fetchItem($args[0],$args[1]);
	$r3=$itemModelObj1->fetchItem($args[0]);
	
	if($r3)
	{
	//echo "correct in controller";
	//var_dump($r3);
	return $r3;
	//echo "correct in controller";
	}
	
}

function getItemList($Category)
{
$itemModelObj2=new ItemModel();
$r4=$itemModelObj2->fetchItemStock($Category);
		if($r4)
		{
		return $r4;
		}
		else
		{
		//echo "controller wrong";
		return false;
		}
}
function getItem($temp)
{
$itemModelObj3=new ItemModel();
	$result=$itemModelObj3->fetchItemData($temp);
	if($result)
	{
	    return $result;
	}
	else
	{
	//echo "in controller wrong";
	    return false;
	}

}
 function getItemName()
    {
        $itemModelObj= new ItemModel();
        $result=$itemModelObj->fetchItemName(func_get_arg(0));
        $row=  mysqli_fetch_array($result);
        return $row;
    }
	
	
	
	function getAllItemData()
    {
	 $arg=func_get_args();
	$itemModelObj=new ItemModel();
	$arr;
	 $i=0;
	 if($arg)
	 {
		$result=$itemModelObj->fetchAllItemData($arg[0]);
		$item=mysqli_fetch_array($result);
		$arr[0]=$item[0];
	}
	else
	{
		$result=$itemModelObj->fetchAllItemData();
	    while($item=mysqli_fetch_array($result))
	    {
			$arr[$i]=$item[0];
			$i++;
			$arr[$i]=$item[2];
			$i++;
	    }
	   
	}
	 return $arr;
    }
   function getAllItems()
	{
		$itemModelObj=new ItemModel();
		$result=$itemModelObj->fetchAllItems();
		$index=0;
		$array="";
		while($row=mysqli_fetch_array($result))
		{
			$array[$index] = $row;
			$index++;
		}
		return $array;
	}
function getOneItemName()
    {
        $itemModelObj=new ItemModel();
        $result=$itemModelObj->fetchItemName(func_get_arg(0));
		//var_dump($result);
	$row=mysqli_fetch_array($result);
		//var_dump($row);
		return $row[0];
    } 

}
?>