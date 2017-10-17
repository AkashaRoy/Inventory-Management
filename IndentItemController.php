<?php
include_once 'IndentItemModel.php';
class IndentItemController
{
	function getItemDetailsAgainstPO()
	{
		$indentItemModelObj=new IndentItemModel();
		$result=$indentItemModelObj->fetchDeliveryDetails(func_get_arg(0));
		$index=0;
		$array="";
		while($row=mysqli_fetch_array($result))
		{
			$array[$index] = $row;
			$index++;
		}
		if($array=="")
			return false;
		else
			return $array;
	}
}
?>