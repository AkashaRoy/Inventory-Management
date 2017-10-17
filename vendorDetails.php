<script type="text/javascript" src="Vendor.js"></script>
<?php
	//include_once'vendor.php';
    include_once'VendorUI.php';
	include_once 'template.php';
	
	$vendorUIObj=new VendorUI();
    if(isset($_GET['vdid'])&&!empty($_GET['vdid']))
    {
        echo $vendorUIObj->onDisplayVendorFormSubmit($_GET['vdid']);
    }
	else if (isset($_POST)&&!empty($_POST))
	{
	    echo  $vendorUIObj->onDisplayVendorFormSubmit();
	}
	else {
	    echo  $vendorUIObj->DisplayVendorForm(); 
	}
	 include_once 'footer.php';
?>