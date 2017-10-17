<!DOCTYPE html>

    
        
        
		<script type="text/javascript" src="Vendor.js"></script>
		
    
    
<?php

   // include_once 'Vendor.php';
	include_once'VendorUI.php';
	include_once 'template.php';
	
	$vendor_catUIObj=new VendorUI();
	if (isset($_POST)&&!empty($_POST))
	{
	    echo  $vendor_catUIObj->onDisplayCategoryFormSubmit();
	}
	else {
	    echo  $vendor_catUIObj->displayCategoryForm();    
	}
include_once 'footer.php';
?>
    
</html>
