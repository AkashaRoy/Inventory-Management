<?php
include_once 'Database.php';

class POModel extends Database
{

    function fetchDetailsToDisplayForIndentId()
	{
		$para=func_get_args();
		$host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
		$query="select indent.indent_id,department.department_id,department.name,indent.status,indent.raise_date,purchase_order.purchase_order_id,purchase_order.status 
		from indent,department,purchase_order 
		where indent.indent_id=purchase_order.indent_id and 
		indent.dept_id=department.department_id and indent.indent_id=$para[0]";
		$res=mysqli_query($link,$query);
		if($res)
		return $res;
		else
		return false;
	}
    function indentIdsForCancellationOfPurchaseOrders()
    {
        
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="select distinct indent.indent_id from purchase_order,indent,indent_item 
            where purchase_order.purchase_order_id=indent_item.purchase_order_id and 
            indent.indent_id=purchase_order.indent_id and 
            purchase_order.indent_id=indent_item.indent_id and 
            indent.indent_id=indent_item.indent_id and purchase_order.status='pending'
            and indent.status!='cancelled'";
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else
            return false;
    }

    function getDataForReport()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $releaseDateForPO="";
        if($para[0]=="vendor")
        {
            $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.vendor_id=".$para[1];
        }
    else if($para[0]=="indent")
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.indent_id=".$para[1];
    }
    else if($para[0]=="status")
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.status='".$para[1]."'";
    }
    else if($para[0]=="item")
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and indent_item.item_id=$para[1]";
        //echo $query;
           }
    else if($para[0]=='category')
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and category_vendor.category_id=$para[1]";
         //echo $query;
        
    }
    else if($para[0]=="year")
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.expected_date like '$para[1]-%'";
    }
    else if($para[0]=="month")
    {
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.expected_date like '%-$para[1]-%'";
    }
    else if($para[0]=="release date")
    {
        $releaseDateForPO=$para[1]."-".$para[2]."-".$para[3];
        $query="select purchase_order.purchase_order_id,purchase_order.indent_id,department.name 'department_name',
purchase_order.vendor_id,vendor.name 'vendor_name',vendor.email,vendor.phone1,indent.raise_date,indent.status 'indent_status',
purchase_order.release_date,purchase_order.amount,purchase_order.expected_date,purchase_order.status 'purchase_order_status',
indent_item.item_id,item.name_brand ,item.category_id,category.name 'category_name',indent_item.quantity 
from department,purchase_order,indent,indent_item,item,vendor,category,category_vendor 
where department.department_id=indent.dept_id and indent.indent_id=indent_item.indent_id and
indent_item.purchase_order_id=purchase_order.purchase_order_id and purchase_order.vendor_id=category_vendor.vendor_id and
category_vendor.category_id=category.category_id and item.category_id=category.category_id and item.item_id=indent_item.item_id and
purchase_order.vendor_id=vendor.vendor_id and category_vendor.vendor_id=vendor.vendor_id and purchase_order.indent_id=indent.indent_id 
and purchase_order.release_date='$releaseDateForPO'";
//        echo $query;
    }
    $res=  mysqli_query($link, $query);
    if($res)
        return $res;
    else
        {
    return false;
    }
    }
    function selectPORecords()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="select * from purchase_order where purchase_order_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
        
    }
    function cancelPO()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="update purchase_order set status='cancelled' where purchase_order_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else
            return false;
    }


    function checkPO()
    {
       
        $para=  func_get_args();
       // var_dump($para);
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        $query="select count(*) from purchase_order where vendor_id=".$para[0]." and release_date='".date("Y-m-d")."' and expected_date='".$para[1]."' and status='pending' and indent_id=".$_SESSION['selectedIndentId'];
        $res=  mysqli_query($link, $query);
        $records=  mysqli_fetch_array($res);
        //echo "records".$records[0];
        if($records[0]!=0)
        {
            $query2="select * from purchase_order where vendor_id=".$para[0]." and release_date='".date("Y-m-d")."' and expected_date='".$para[1]."' and status='pending' and indent_id=".$_SESSION['selectedIndentId'];
            $res2=  mysqli_query($link, $query2);
            $poArray=  mysqli_fetch_array($res2);
            $query1="update purchase_order set amount=amount+".$para[2]." where purchase_order_id=".$poArray[0];
            $res1=  mysqli_query($link,$query1);
            if($res1)
            {
                
            return $poArray[0];
            }
            else
                return false;
        }
        else
        {                 
        $query1="insert into purchase_order(vendor_id,indent_id,release_date,expected_date,amount,status) values(".$para[0].",".$_SESSION['selectedIndentId'].",'".date("Y-m-d")."','".$para[1]."',".$para[2].",'pending')" ; 
        $res1=  mysqli_query($link,$query1);
        $query2="select * from purchase_order where vendor_id=".$para[0]." and indent_id=".$_SESSION['selectedIndentId']." and expected_date='".$para[1]."' and status='pending'";
        $res2=  mysqli_query($link, $query2);
        if($res1 && $res2)
        {
           
        $poArray=  mysqli_fetch_array($res2);
        return $poArray[0];
        }
        else
            return false;
        }
        
    }
    function makeEntries()
    {
        
        $para=  func_get_args();
        
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        
       for($i=0;$i< $_SESSION['available_categories'] ;$i++)
       {
           $sum=0;
           if($para[4][$i][0]!='0')//checking if vendor not equal to zero
           {
            for($j=0;$j< sizeof($para[3][$i]);$j++)  
            {
               if($para[3][$i][$j]!=NULL)
               {
                 $sum=$sum+$para[3][$i][$j];
               }
            }
        
        $poNumber=$this->checkPO($para[4][$i][0],$para[5][$i],$sum);

        //echo "vendor ".$para[4][$i][0];
        //echo "expected date".$para[5][$i];
            /*
        $query1="insert into purchase_order(vendor_id,indent_id,release_date,expected_date,amount,status) values(".$para[4][$i][0].",".$_SESSION['selectedIndentId'].",'".date("Y-m-d")."','".$para[5][$i]."',".$sum.",'pending')" ; 
        $res1=  mysqli_query($link,$query1);
        $query2="select * from purchase_order where vendor_id=".$para[4][$i][0]." and indent_id=".$_SESSION['selectedIndentId']." and expected_date='".$para[5][$i]."' and status='pending'";
        $res2=  mysqli_query($link, $query2);
        $poArray=  mysqli_fetch_array($res2);
        $poNumber=$poArray[0];
             
             */
            for($j=0;$j<sizeof($para[2][$i]);$j++)  
            {
              
               if($para[2][$i][$j]!=NULL)
               {
                 $query3="update indent_item set purchase_order_id=".$poNumber.", status='approved' where indent_id=".$_SESSION['selectedIndentId']." and item_id=".$para[2][$i][$j]." and status='pending'";
                 $res3=  mysqli_query($link, $query3);
                 
               }
            }//for
        
            if(!$res3 )
            {
                $_SESSION['errMsg']="unable to make changes in the database";
                return FALSE;
            }
        
           }//if vendor check
       }//for i loop
       
       //$_SESSION['errMsg']="changes made in the database";
       return true;
    }
    function selectPurchaseOrderList()
    {
        $para=  func_get_args();
        $host='localhost';
        $user='root';
        $password='';
        $database='vocational_training';
        $link = parent::connectToDB();
        
        if($para[0]=='IndentId')
        {
            $query="select * from purchase_order where indent_id=".$para[1];
        }
        else if($para[0]=='All')
        {
            $query="select * from purchase_order";
        }
        $res= mysqli_query($link, $query);
        if($res)
            return $res;
        else
            return false;
    }
	
	
	
function fetchPurchaseDetails($ui)
{
$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	$query = "SELECT * FROM `purchase_order` where(purchase_order_id = $ui)";
	//echo $query;
	$res = mysqli_query($link, $query);
	//var_dump($res);
	if($res)
	{
	return $res;
	}
	else
	{
	return false;
	}
}


function fetchPOId()
{
    $host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'vocational_training';
	$link = parent::connectToDB();
	$query = "SELECT purchase_order_id from purchase_order where status=\"pending\" or status=\"partial\"";
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
 function fetchPurchase_orderForVendor()
    {
        $vendorID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT `purchase_order_id`,`status` FROM `purchase_order` WHERE `vendor_id`=$vendorID";
		$result=mysqli_query($con,$query);
		return $result;

	}
	
	 function update_PO()
    {
    $para=  func_get_args();
    $link=mysqli_connect('localhost','root','','vocational_training');
    $query="update purchase_order set amount='".$para[0]."',expected_date='".$para[1]."' where purchase_order_id=".$_SESSION['selected_purchase_order_id'];
    $res=  mysqli_query($link, $query);
    if($res)
        return TRUE;
    else
        return FALSE;
    }
    function cancel_PO()
    {
        $para=  func_get_args();
        $host='localhost';
	$user='root';
	$password='';
	$database="vocational_training";
	$link=mysqli_connect($host, $user, $password, $database);
        $query="update purchase_order set status='cancelled' where purchase_order_id=".$para[0];
        $res=  mysqli_query($link, $query);
        if($res)
            return true;
        else 
            return false;
    }
    function fetch_PO_details()
    {
      
         $host='localhost';
	$user='root';
	$password='';
	$database="vocational_training";
	$link=mysqli_connect($host, $user, $password, $database);
        if(func_num_args()!=0)
        {
            $para=  func_get_args();
            if($para[0] == 'all')
            {
             $query="select * from purchase_order";
            }
            else
            {
            $query="select * from purchase_order where purchase_order_id=".$para[0];
            }
        }
        else
        $query="select * from purchase_order where indent_id=".$_SESSION['selected_indent_id'];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
        
    }
   
    function add_to_POdb()
    {
        $para=  func_get_args();
        //var_dump($para);
        $host='localhost';
	$user='root';
	$password='';
	$database="vocational_training";
	$link=mysqli_connect($host, $user, $password, $database);
      //mysqli_autocommit($link,false);
        //mysqli_query("start transaction");
        $date=  date("Y-m-d");
        $query1= "INSERT INTO `vocational_training`.`purchase_order` (`purchase_order_id`, `vendor_id`, `indent_id`, `release_date`, `amount`, `expected_date`, `status`) VALUES (NULL,".$para[0].",".$_SESSION['selected_indent_id'].",'$date','".$para[1]."','".$para[2]."','created')";
       // echo $query1;
        $res1=  mysqli_query($link, $query1);
        //var_dump($res1);
        //$query2="update purchase_order set";
        //$res2=  mysqli_query($link, $query2);
        if($res1) //&& $res2)
        {   
            //mysqli_commit($link);
           // mysqli_autocommit($link, true);
            return "entered into db";
        }
        else
        {   
            //mysqli_rollback($link);
            //mysqli_autocommit($link, true);
            return "unable to enter into db";
        }
        /*
        $query= "INSERT INTO `vocational_training`.`purchase_order` (`purchase_order_id`, `vendor_id`, `indent_id`, `release_date`, `amount`, `expected_date`, `status`) VALUES (NULL,".$para[0].",".$_SESSION['selected_indent_id'].",'".date("Y-m-d")."',".$para[1]."','".$para[2]."','created')";
        $res=  mysqli_query($link, $query);
        if($res)
            return "Entered into database";
        else
            return "Unable to enter into database";*/
    }
}

?>