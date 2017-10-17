<?php
include_once 'template.php';
include_once 'StockUI.php';
$StockUIobj=new StockUI();
if(empty($_POST) || !isset($_POST))
	    {
		$res=$StockUIobj->requestCategoryForm();
		echo $res;
		echo"<a href='view.php' ><button>back</button></a>";
	    }
	    else
	    {
		$id=$_POST['Category'];
		$result1=$StockUIobj->requestItemForm($id);
		$count=0;
		if($result1)
		{
			echo "<filter></filter><h3 align='center' >ITEM DETAILS</h3>
			<table  align='center'>
					<tr>
			<td>item id</td>
			<td>name</td>
			<td>current stock</td>
			</tr>";			
			while($row=mysqli_fetch_array($result1))
			{
			echo"<tr>
			<td>$row[0]</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			</tr>";
			}
			echo "</table>";
			
}
else
{
echo "<table  align='center'><tr><td><font color=red>NO ITEM OF THIS CATEGORY EXISTS IN STOCK</font></td></tr></table>";
}
echo "<br/>";
echo"<table  align='center'><tr><td><a href='view_category.php'><button>view again</button></a></td><td><a href='view_download.php ?id=$id' ><button>download</button></a></td><td><button onclick='printPage()'>Print</button></td></tr></table>";
//echo"<table  align='center'><tr><td><a href='view_download.php ?id=$id' ><button>download</button></a></td></tr></table>";
}
echo "<br/>";
//echo"<table  align='center'><tr><td><a href='view.php' ><button>back</button></a></td></tr></table>";

include_once 'footer.php';
?>
