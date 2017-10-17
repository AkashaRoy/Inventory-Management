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
$a=$StockUIobj->getVendorDetails($code);
if($a)
{		
echo "<h3 align='center' >VENDOR DETAILS<h3>";
while($row=mysqli_fetch_array($a))
{
echo"
<table  align='center' border=2><tr></tr>
		<tr>
<td>vendor id</td><td>$row[0]</td></tr>
<tr><td>name</td><td>$row[1]</td></tr>
<tr><td>address</td><td>$row[2]</td></tr>
<tr><td>email</td><td>$row[3]</td></tr>
<tr><td>phone1</td><td>$row[4]</td></tr>
<tr><td>phone2</td><td>$row[5]</td>
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