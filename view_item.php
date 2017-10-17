<?php
include_once 'template.php';
include_once 'StockUI.php';
$StockUIobj=new StockUI();
$result=$StockUIobj->getItemCurrentStock();
if($result)
{
echo "<filter></filter><h3 align='center' >ITEM LIST</h3>
<table align='center' border=2><tr></tr>
			<tr>
	<td><h4>item id</h4></td>
	<td><h4>item name</h4></td>
	<td><h4>category</h4></td>
	<td><h4>current stock</h4></td>
</tr>";

while($row=mysqli_fetch_array($result))
{
echo"<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	<td>$row[3]</td>
	</tr>";
}
echo "</table>";
}
echo"</br><a href='view.php'><button>back</button></a>";
echo"<a href='view_item_download.php'><button>download</button></a>";
echo "</br><button onclick='printPage()'>Print</button>";
include_once 'footer.php';
?>