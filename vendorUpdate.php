<!DOCTYPE html>

    
        
        
		
		
		
    
    

	
<?php
	//include_once'vendor.php';
    include_once'VendorUI.php';
	include_once 'template.php';
	
	$vendorUIObj=new VendorUI();
    if(isset($_GET['vdid'])&&!empty($_GET['vdid']))
    {
        echo $vendorUIObj->onEditVendorFormSubmit($_GET['vdid']);
        die();
    }
	if (isset($_POST)&&!empty($_POST))
	{
	    echo  $vendorUIObj->onEditVendorFormSubmit();
	}
	else {
	    echo  $vendorUIObj->editVendorForm(); 
	}
	 include_once 'footer.php';
?>
    
</html>