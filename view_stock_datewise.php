<?php
include_once 'template.php';
include_once 'StockUI.php';
$StockUIobj=new StockUI();
if(empty($_POST) || !isset($_POST))
{
$result=$StockUIobj->getDateForm();
//echo "sdfghj";
echo $result;
}		
else
{
//echo "qwertyuasdfghj";
$id=$_POST['date'];
		$result1=$StockUIobj->requestItemList($id);
		$count=0;
		if($result1)
		{		
echo "<filter></filter><h3 align='center' > STOCK RECEIVING DETAILS</h3>
<table  align='center' border=2><tr></tr>
		<tr>
<td><h4>expected date</h4></td>
<td><h4>purchase order id</h4></td>
<td><h4>status</h4></td>
<td><h4>item id</h4></td>
<td><h4>quantity received</h4></td>
<td><h4>receive date</h4></td>
</tr>";		
//$result1=$StockUIobj->viewStockDetails();
//echo $result1;	
while($row=mysqli_fetch_array($result1))
{
//$count++;

echo"<tr>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[3]</td>
<td>$row[4]</td>
<td>$row[5]</td>
</tr>";

}
echo "</table>";
}
else 
{
echo "NO PURCHASE HAS BEEN MADE HAVING  THIS EXPECTED DATE";
}
echo"</br><a href='view.php'><button>back</button></a>";
echo"<a href='date_download.php ?id=$id'><button>download</button></a></br>";
echo "<button onclick='printPage()'>Print</button>";
}
include_once 'footer.php';
?>