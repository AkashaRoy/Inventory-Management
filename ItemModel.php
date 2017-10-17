<?php
include_once 'Database.php';

class ItemModel extends Database
{
function selectAllItem()
    {
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();   
        $query="select * from item";
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else {
        return FALSE;    
        }
    }
function getItemDetails()
    {
         $para=  func_get_args();
      $num=  func_num_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();   
        if($num==1)
            $query="select * from item where item_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
        {
            
            return $res;
        }
        else
            return false;
     
    }
	
	function fetchAllItemData2($indent)
    {
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	//$query = "SELECT item_id,name_brand FROM `item`";
	//$query="select item_id,quantity from indent_item where indent_id=$indent";
	//$query= "select item.name_brand,indent_item.item_id,indent_item.quantity from indent_item,item where indent_item.item_id=item.item_id and indent_item.indent_id=$indent";
	//$query= "select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and purchase_order.purchase_order_id=$indent\n"
    //. " LIMIT 0, 30 ";
	//echo $query;
	//$query="select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and indent_item.status=\"approved\" and purchase_order.purchase_order_id=$indent\n"
    //. "";
	//$query="select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and (indent_item.status=\"approved\" or indent_item.status=\"partial\") and purchase_order.purchase_order_id=$indent";
	
	//$query="select item.name_brand,indent_item.item_id,indent_item.quantity,sum(stock.quantity),sum(stock.damaged_goods) from item,indent_item,purchase_order,stock where\n"
    //. "purchase_order.purchase_order_id=stock.purchase_order_id and item.item_id=stock.item_id and purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and (indent_item.status=\"approved\" or indent_item.status=\"partial\") and purchase_order.purchase_order_id=$indent group by stock.item_id";
	//echo "$query";
	/*$query= "select i.name_brand, i.item_id,ii.quantity,(select sum(quantity) from stock s where s.item_id=ii.item_id and s.purchase_order_id=$indent ) as recieved,(select sum(damaged_goods) from stock s where s.item_id=ii.item_id and s.purchase_order_id=$indent ) as damaged from item i, indent_item ii \n"
    . "where\n"
    . "i.item_id=ii.item_id\n"
    . "and\n"
    . "ii.purchase_order_id=$indent";*/
	$query="select i.name_brand, i.item_id,ii.quantity,(select sum(quantity) from stock s where s.item_id=ii.item_id and s.purchase_order_id=$indent ) as recieved,(select sum(damaged_goods) from stock s where s.item_id=ii.item_id and s.purchase_order_id=$indent ) as damaged from item i, indent_item ii  where i.item_id=ii.item_id and ii.purchase_order_id=$indent and (ii.status=\"approved\" or ii.status=\"partial\")";
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
	
	
	function fetchItem()
	{
	$args=func_get_args();
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	//$query = "select item.item_id,category.name from item,category where item.category_id = category.category_id and category.name='$args[1]' and item.item_id=$args[0] LIMIT 0, 30 ";
	//$query = "select item.item_id,category.name from item,category where item.category_id = category.category_id and category.name='$args[1]' and item.item_id=$args[0] LIMIT 0, 30 ";
	//$query="SELECT item.item_id,category.name from item,category where category.category_id=item.category_id and item.item_id=$args[0]";
	$query="SELECT category.name from category,item where item.item_id=$args[0] and item.category_id=category.category_id";
	$r4 = mysqli_query($link, $query);
	//return $r4;
	
	 $count=0;
	 if($r4)
	 {
	 //echo "gdkjf";
	 return $r4;
	}
	}
	
	function fetchItemStock($Category)
	{
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	/*$query="SELECT item.item_id, item.name_brand,sum(stock.quantity)\n"
    . "FROM item, category,stock\n"
    . "WHERE item.category_id = category.category_id\n"
    . "and stock.item_id=item.item_id\n"
    . "AND category.name = '$Category' GROUP BY stock.item_id";
	//echo $query;
	//echo $query;*/
	$query="SELECT item.item_id, item.name_brand,sum(stock.current_stock) FROM item, category,stock WHERE item.category_id = category.category_id and stock.item_id=item.item_id AND category.name = '$Category' GROUP BY stock.item_id";
	//echo $query;
	$res = mysqli_query($link, $query);
	if(mysqli_num_rows($res)!=0)
	
	//if($res)
	{
	//var_dump($res);
	//echo "right model";
	return $res;
	}
	else 
	{
	//echo "model wrong";
	return false;
	}
	}
	
	function fetchItemData($temp)
	{
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();

	//$query="SELECT indent_item.item_id, indent_item.quantity, item.name_brandFROM indent_item, purchase_order, item WHERE item.item_id = indent_item.item_idAND indent_item.indent_id = purchase_order.indent_idAND purchase_order.purchase_order_id =$temp";
			//$query=$query= "select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and purchase_order.purchase_order_id=$temp\n". " LIMIT 0, 30 ";
//$query="select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and indent_item.status=\"approved\" and purchase_order.purchase_order_id=$temp\n"
//    . "";	
$query="select item.name_brand,indent_item.item_id,indent_item.quantity from item,indent_item,purchase_order where purchase_order.purchase_order_id=indent_item.purchase_order_id and indent_item.item_id=item.item_id and purchase_order.indent_id=indent_item.indent_id and (indent_item.status=\"approved\" or indent_item.status=\"partial\") and purchase_order.purchase_order_id=$temp";
	
	//echo $query;
	$res = mysqli_query($link, $query);
		//if($res)
		$count=0;
		$a=mysqli_num_rows($res);
//if(mysqli_num_rows($res)!=0)
if($a!=0)
{
$count++;		
	return $res;
}
else
{
$query3= "UPDATE purchase_order SET status=\"received\" WHERE purchase_order_id=$temp;";
	
	$temp=mysqli_query($link,$query3);
	//echo $query3;
//echo "not in model";
return false;
}			
	}


function fetchItemName()
    {
        $arg=func_get_arg(0);
		$itemID=$arg[0];
        $con = parent::connectToDB();
        $query="SELECT `name_brand` FROM `item` WHERE `item_id`=$itemID";
        $result=mysqli_query($con,$query);
		return $result;
    }


 function fetchAllItemData()
    {
		$arg=func_get_args();
		$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'vocational_training';
		$link = parent::connectToDB();
		$query = "SELECT * FROM `item`";
		if($arg)
		{
			$query2="SELECT `name_brand` FROM `item` WHERE `item_id`='$arg[0]'";
			$res = mysqli_query($link, $query2);
		}
		else
		{
			$res = mysqli_query($link, $query);
		}
		return $res;
	} 
function fetchAllItems()
	{
		$con = parent::connectToDB();
		$query="SELECT `item_id`,`name_brand` FROM `item`";
		$result=mysqli_query($con,$query);
		return $result;
	}	
}
?>