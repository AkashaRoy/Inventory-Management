<script type="text/javascript" src="Vendor.js"></script>
<?php

    //include_once 'Vendor.php';
	include_once'VendorUI.php';
	include_once 'template.php';
	$vendorUIObj=new VendorUI();
	
	    echo  $vendorUIObj->displayVendor_ItemList();    
	
include_once 'footer.php';
?>
   
</html>