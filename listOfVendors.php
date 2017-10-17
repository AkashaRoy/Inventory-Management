
    
        
        
		<script type="text/javascript" src="Vendor.js"></script>
		<link rel="stylesheet" href="Vendor.css" type="text/css">
    
    <body>
<?php

    include_once 'Vendor.php';
	include_once'VendorUI.php';
	$vendor_catUIObj=new VendorUI();
	
	    echo  $vendor_catUIObj->displayVendorList();    
	

?>
    </body>
</html>