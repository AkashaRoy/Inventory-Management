<?php
include_once 'template.php';
include_once 'StockUI.php';
$StockUIobj=new StockUI();
if(empty($_POST) || !isset($_POST))
	    {
		$res=$StockUIobj->requestStockForm();
		echo $res;
	    }
	    else
	    {
		$id=$_POST['stockid'];
		$result1=$StockUIobj->requestStock($id);
		$count=0;
		if($result1)
		{
		
echo "<h3 align='center' >STOCK DETAILS</h3>
<table  align='center' border=2><tr></tr>
		<tr>
<td>stock id</td>
<td>purchase_order id</td>
<td>item id</td>
<td>quantity</td>
<td>current stock</td>
<td>receive date</td>
<td>category</td>
<td>damaged goods</td>
</tr>";			
while($row=mysqli_fetch_array($result1))
{
echo"<tr>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[4]</td>
<td>$row[5]</td>
<td>$row[7]</td>
<td>$row[8]</td>
<td>$row[9]</td>
</tr>";

}
echo "</table>";
echo "<br/><button onclick='printPage()'>Print</button>";
}
else
{
echo "<table  align='center'><tr><td><font color=red>THIS STOCK ID DOES NOT EXIST. PLEASE ENTER A VALID STOCK ID.</font></td></tr></table>";
}
}
echo"<br/><a href='view.php' ><button>back</button></a>";
include_once 'footer.php';
?>

