<?php
include_once 'template.php';

?>
<h2> VIEW STOCK DETAILS</h2>	
	    
	<table align="center">
 <tr>
 <td>category wise</td><td><a href="view_category.php" ><button>View</button></a></td></tr>
 <tr>
 <td>all item list </td><td><a href="view_item.php"><button>View</button></a></td>
 </tr>
<tr>
 <td>mimimum quantity</td><td><a href="view_minimun_item.php"><button>View</button></a></td>
 </tr>
 <tr>
 <td>expected date wise</td><td><a href="view_stock_datewise.php"><button>View</button></a></td>
 </tr>
 <tr>
 <td>stock id</td><td><a href="view_stockid.php"><button>View</button></a></td>
 </tr>
</table>
<?php
include_once 'footer.php';
?>