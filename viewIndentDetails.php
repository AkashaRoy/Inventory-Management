<?php session_start(); ?>

<body bgcolor="#b0b0b0">

<?php
include_once 'template.php';
include_once 'StockUI.php';
$code=$_GET['id'];
$temp=$_SESSION['po'];
//echo $temp;
//echo $code;
$StockUIobj=new StockUI();
$a=$StockUIobj->getIndentDetails($code);
if($a)
{		
echo "<h3 align='center' >INDENT DETAILS<h3>";
while($row=mysqli_fetch_array($a))
{
echo"
<table  align='center' border=2><tr></tr>
		<tr>
<td>indent id</td><td>$row[0]</td></tr>
<tr><td>department name</td><td>$row[1]</td></tr>
<tr><td>raise date</td><td>$row[2]</td></tr>
<tr><td>status</td><td>$row[3]</td>
</tr>";			
}
echo "</table>";
}
echo "</br>";
echo"<table  align='center'><tr><td><a href='index_stock.php?POId=$temp'>back</a></td></tr></table>";
include_once 'footer.php';
?>
</body>
</html>