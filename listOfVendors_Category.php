<script type="text/javascript" src="Vendor.js"></script>
<?php

    //include_once 'Vendor.php';
	include_once'VendorUI.php';
	include_once 'template.php';
	$vendor_catUIObj=new VendorUI();
    echo  $vendor_catUIObj->displayVendor_CategoryList();    	
    include_once 'footer.php';
?>