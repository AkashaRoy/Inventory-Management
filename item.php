<?php
include_once 'template.php';
include_once 'StockUI.php';
$StockUIobj=new StockUI();

$result1=$StockUIobj->getItemDetails();
//echo $result1;		
	echo "<table border=2><tr><h3>ITEM LIST<h3></tr>
		<tr>
<td>item id</td>

<td>name</td>

</tr>";
						
while($row=mysqli_fetch_array($result1))
{
echo"<tr>
<td>$row[0]</td>
<td>$row[1]</td>
</tr>";

}
echo "</table>";

 include_once 'footer.php';



?>

</br>
<a href="database.php">enter the received order</a></br>
<a href="index.php">back</a></br>