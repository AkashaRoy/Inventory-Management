<?php
	session_start();
	include_once 'template.php';
	//include_once 'item.php';
	//include_once 'stock_help.php';
	    include_once 'StockUI.php';
	    $StockUIobj=new StockUI();
	    //if(empty($_POST) || !isset($_POST))
	    if(empty($_GET) || !isset($_GET))
		{
		$res=$StockUIobj->requestReceiveForm();
		echo $res;
	    }
	    else
	    {
		//$id=$_POST['POId'];
		//$_SESSION['po']=$_POST['POId'];
		$id=$_GET['POId'];
		$_SESSION['po']=$_GET['POId'];
		//echo $_SESSION['po'];
		$result=$StockUIobj->submitForm($id);
		//$row=mysqli_fetch_array($result);
		//var_dump($row);
		$count=0;
		$indent=-1;
		if($result)
		{
	while($row=mysqli_fetch_array($result))
	{
	$date1=$row[5];
	//echo $date1;
$date2=date('Y-m-d');
$secTotalDate1=strtotime($date1);
$secTotalDate2=strtotime($date2);
if($secTotalDate1 >= $secTotalDate2)
{
    //echo "sdas";
	$count++;
	echo "<h3 align='center'>DETAILS OF PURCHASE ORDER</h3>
	<table align='center' border=2><tr></tr>
			<tr>
	<td>purchase order id</td>
	<td>vendor id</td>
	<td>indent id</td>
	<td>release date</td>
	<td>amount</td>
	<td>expected date</td>
	<td>current date</td>
</tr>";
	echo"<tr>
	<td><a href='indexPO.php?id=4&code=$row[0]' target='_blank'>$row[0]</a></td>
	<td><a href='viewVendorDetails.php?id=$row[1]'target='_blank'>$row[1]</a></td>
	<td><a href='viewIndentDetails.php?id=$row[2]'target='_blank'>$row[2]</a></td>
	<td>$row[3]</td>
	<td>$row[4]</td>
	<td><font color='#009900'>$row[5]</font></td>
	<td><input type='text' name='date' value='".date('Y-m-d')."' readonly='readonly'/></td>
	</tr>";
	echo "</table>";
	$indent=$row[0];
	}
	else if($secTotalDate1 < $secTotalDate2)
	{
	$count++;
	echo "<h3 align='center'>DETAILS OF PURCHASE ORDER</h3>
	<table align='center' border=2>
			<tr>
	<td><h4>purchase order id</h4></td>
	<td><h4>vendor id</h4></td>
	<td><h4>indent id</h4></td>
	<td><h4>release date</h4></td>
	<td><h4>amount</h4></td>
	<td><h4>expected date</h4></td>
	<td><h4>current date</h4></td>
</tr>";
	echo"<tr>
	<td>$row[0]</td>
	<td><a href='viewVendorDetails.php?id=$row[1]' target='_blank'>$row[1]</a></td>
	<td><a href='viewIndentDetails.php?id=$row[2]'target='_blank'>$row[2]</a></td>
	<td>$row[3]</td>
	<td>$row[4]</td>
	<td><font color='red'>$row[5]</font></td>
	<td><input type='text' name='date' value='".date('Y-m-d')."' readonly='readonly'/></td>
	</tr>";
	echo "</table>";
	$indent=$row[0];
	}
	}
	$a=-1;
	$b=-1;
		if($indent!=-1)
		{
		$result1=$StockUIobj->getItemDetails($indent);
		//$StockUIobj2=new StockUI();
		//$StockUIobj2->pass($result1);
		if($result1)
		{
		echo "<h3 align='center'>ITEM LIST</h3>
		<table  align='center' border=2><tr></tr>
		<tr>
		<td><h4>item name</h4></td>
		<td><h4>item id</h4></td>
		<td><h4>ordered quantity</h4></td>
		<td><h4>received quantity</h4></td>
		<td><h4>damaged quantity</h4></td>
		<td><h4>quantity to be received</h4></td>
		</tr>";						
		while($row=mysqli_fetch_array($result1))
		{
		$a=0;
		$b=0;
		$b=$row[3]-$row[4];
		$a=$row[2]-$b;
		echo"<tr>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>$row[2]</td>
		<td>$row[3]</td>
		<td>$row[4]</td>
		<td>$a</td>
		</tr>";
		
		}
		echo "</table>";
		}
		//echo" <a href='item.php'>get item details</a>";
		echo"<br/>";

		echo"
		<br/>
	
	<div align='center'>
	<a href='database_stock.php' ><button>enter the received order</button></a></br>
 <a href='index_stock.php'><button>Go Back</button></a></td>
 
 </div>
		";
		

		}
if($count==0)
{

echo "<table  align='center'><tr><td><font color=red>"."THIS PURCHASE ORDER ID DOES NOT EXIST</br> PLEASE ENTER A CORRECT PURCHASE ORDER ID"."</font></td></tr></table>";
echo"<br/>";
echo"<table  align='center'><tr><td><a href='index_stock.php'>back</a></td></tr></table>";
}		
}
else
{
echo "<table  align='center'><tr><td><font color=red>"."FIELDS SHOULD NOT BE EMPTY </br>ENTER A PURCHASE ORDER ID"."</font></td></tr></table>";
echo "<br/>";
echo"<table  align='center'><tr><td><a href='index_stock.php'>back</a></td></tr></table>";
}
//if($count==0)
//{
//echo "<font color=red>"."THIS PURCHASE ORDER ID DOES NOT EXIST"."</font>";
//echo"<br/>";
//echo"<a href='index_stock.php'>back</a>";
//}		
}
include_once "footer.php";
	?>