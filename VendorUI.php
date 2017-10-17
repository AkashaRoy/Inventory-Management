<?php
include_once 'VendorController.php';
include_once 'CategoryController.php';
include_once 'StockController.php';
include_once 'ItemController.php';
include_once 'IndentItemController.php';
include_once 'POController.php';
include_once 'Vendor_CategoryController.php';
class VendorUI {
    
    function addVendorForm()
    {
	    $db1=new CategoryController();
	    $row=$db1->getAllCategories();
	    $form='
			<div align=center>
			
		    <form action="addVendor.php" method="post"onsubmit="return addVendorFormValidate(this);"><h1 align=center>Add Vendor Details Form</h1>
		    <table align=center>
		        <tr><td>Name<font color="red">*</font></td><td><input type="text" placeholder="Ex:-Ram Singh" size=30 name="vdname"  onchange=validateName(this) required /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor name.Only alphabets and spaces are allowed."/></td><td><span style="color:Red;" id="nameError"> </span></td></tr>
		        <tr><td>Address</td><td><table><tr><td>Line1<font color="red">*</font></td><td><input type="text" name="vdline1" size=30 placeholder="Ex:-Big Bazaar" onchange=validateLine(this,"line1Error") required /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor business address."/></td><td><span style="color:Red;" id="line1Error"> </span></td></tr>
			        <tr><td>Line2</td><td><input type="text" name="vdline2" size=30  placeholder="Ex:-KIIT Square,Patia"  onchange=validateLine(this,"line2Error") /></td><td><span style="color:Red;" id="line2Error"> </span></td></tr>
			        <tr><td>Street<font color="red">*</font></td><td><input type="text"  size=30 name="vdstreet" placeholder="Ex:-Street No-12"  onchange=validateLine(this,"streetError") required /></td><td><span style="color:Red;" id="streetError"> </span></td></tr>
			        <tr><td>City<font color="red">*</font></td><td><input type="text" name="vdcity" size=30 placeholder="Ex:-Bhubaneswar" onchange=validateCity(this) required /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for city name.Only alphabets and spaces are allowed."/></td><td><span style="color:Red;" id="cityError"> </span></td></tr>
			        <tr><td>PinCode<font color="red">*</font></td><td><input type="text" name="vdpincode" size=30 placeholder="Ex:-751024"  onchange=validatePincode(this) required /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for the pincode.Only digits are allowed."/></td><td><span style="color:Red;" id="pincodeError"> </span></td></tr></table></td></tr>
                <tr><td>Email</td><td><input type="text" name="vdemail" placeholder="Ex:-ram@gmail.com" size=30 onchange=validateEmail(this) /></td><td><span style="color:Red;" id="emailError"></span></td></tr>
		        <tr><td>Phone 1<font color="red">*</font></td><td><input type="text" name="vdphone1" size=30 placeholder="Ex:-9898989898" onchange=validatePhone(this,"phoneError1") required /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for phone no.Only digits are allowed."/></td><td><span style="color:Red;" id="phoneError1"></span></td></tr>
		        <tr><td>Phone 2</td><td><input type="text" name="vdphone2" placeholder="Ex:-9898989898" size=30 onchange=validatePhone(this,"phoneError2") /></td><td><span style="color:Red;" id="phoneError2"> </span></td></tr>
		    <tr><td>Category<font color="red">*</font></td><td><select style="width:70%" id="vdcategory" size=8 name="vdcategory[]" multiple required>';
		    foreach ($row as $value)
		    {
			    $form = $form."<option value = '".$value['category_id']."'>".$value['name']."</option>";
		    }
		    
			$form = $form.
		    '</select><img src="1.png" height="15.5" width="11.5" title="This field has been provided to select category of a vendor.More than one category can be selected.To select multiple categories double click and drag the mouse."/></td><td><span style="color:Red;" id="categoryError"> </span></td></tr>
		    <tr><td></td><td><input type="submit" value="Save Details" />
			<input type="reset" value="New Form" /></td></td><td></tr>
		    
		</table>
	    </form>
		</div>';
       return $form; 
   }
   
	function onAddVendorFormSubmit()
	{
	    $name=$_POST['vdname'];
	    $address=$_POST['vdline1']." ".$_POST['vdline2'].",".$_POST['vdstreet'].",".$_POST['vdcity']."   PinCode:".$_POST['vdpincode'];
	    $email=$_POST['vdemail'];
	    $phone1=$_POST['vdphone1'];
        $phone2 = NULL;
        $category = NULL;
        if(isset($_POST['vdphone2']) && $_POST['vdphone2']!="Ex:-9898989898")
	        $phone2 = $_POST['vdphone2'];
        else
            $phone2 = "";
	    if(isset($_POST['vdcategory']))
		    $category=$_POST['vdcategory'];
	    $cntobj1=new VendorController();
	    $res=$cntobj1->addVendor($name, $address, $email, $phone1, $phone2, $category);
		
		if($res==2)
		{
			return "<h1>Vendor Already Exists!!</h1>";
		}
	    else if($res==3){
            return $this->displayVendorPersonalDetails(NULL, $name, $address, $email, $phone1, $phone2, $category,"Vendor has been successfully added with the following details:",1);
	    }
	    else 
		    return "<h1>Vendor Details could not be added!</h1>";
	}
	
    function displayVendorPersonalDetails()
    {
        $vendorControllerObj = new VendorController();
        $catControllerObj = new CategoryController();
        $vendorID = func_get_arg(0);
        $vendorName = func_get_arg(1);
        $vendorAddress = func_get_arg(2);
		$vendorEmail = func_get_arg(3);
		$vendorPhone = func_get_arg(4);
        $vendorPhone2 = func_get_arg(5);
        $categoryID = func_get_arg(6);
        $string = func_get_arg(7);
		//$string1 = func_get_arg(8);
		$arg8 = func_get_arg(8);
        $args = func_get_args();
        $i = 0;
		$opt="";
        foreach($categoryID as $value)
        {
            $category[$i] = $catControllerObj->getCategoryName($value);
            $i++;
        }
        $vendorDetails = $vendorControllerObj->getSavedVendorDetails(NULL, $vendorName, $vendorAddress, $vendorEmail, $vendorPhone, $vendorPhone2);
//        echo "<pre>";var_dump($details);echo "</pre>";
$size = sizeof($vendorDetails)/2;
		for($i=0;$i<$size;$i++)
		{
//		echo "<pre>".$i."<br/>Size".sizeof($vendorDetails)."</pre>";
			if(is_null($vendorDetails[$i]) || is_bool($vendorDetails[$i]) || empty($vendorDetails[$i])){
				$vendorDetails[$i] = "N/A";
			}
		}
        $table = "<div id='personal' style='display:block;'>
                <h3>$string</h3>
			    <table align=center border=2 cellpadding=10 style='border:solid;'>
                    <tr><td>ID:</td><td>$vendorDetails[0]</td></tr>
                    <tr><td>NAME:</td><td>$vendorDetails[1]</td></tr>
                    <tr><td>ADDRESS:</td><td>$vendorDetails[2]</td></tr>
                    <tr><td>EMAIL:</td><td>$vendorDetails[3]</td></tr>
                    <tr><td>PHONE1:</td><td>$vendorDetails[4]</td></tr>
                    <tr><td>PHONE2:</td><td>$vendorDetails[5]</td></tr>
                    <tr><td>CATEGORY:</td><td>";
	    for($i=0;$i<sizeOf($category);$i++){
	        if($i%2==0)
			{
				$table.="<font color='green'>".$category[$i][0]."</font><br/>";
			}
			else
			{
				$table.="<font color='blue'>".$category[$i][0]."</font><br/>";
			}
	    }
		$table.="</td></tr></table>";
		if($arg8==1)
		{
		    $opt.="<h3 style='text-align:center;'>Do you want to add another vendor?</h3><a  href='addVendor.php'><button>YES</button></a><a href='index.php'><button>NO</button></a></div>";
		}
		else
		{
		    $opt.="<h3 style='text-align:center;'>Do you want to edit another vendor's details?</h3><a href='editVendor.php'><button>YES</button></a><a href='index.php'><button>NO</button></a></div>";
		}
		$opt.="<button onclick='printPage()'>Print</button>";
        return $table.$opt;
    }

	function editVendorForm()
    {
	    $form='<h1>Edit Vendor</h1>
		<form action="" method="post" onsubmit="return editFormValidate(this)">
		<table align=center>
		    <tr><td>Enter Id:</td><td><input type="number" name="vdid" size=25 onchange="validateID(this)" placeholder="Ex:-12" /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor ID.Only digits are allowed"/><span style="color:Red;" id="idError"></td><td> </span></td></tr>
            <tr><td colspan=2 >If you do not remember the ID,fill in the following details:</td></tr>
            <tr><td>Enter Name:</td><td><input type="text" size=25 name="vdname" placeholder="Ex:-Ram Singh" onchange=validateName(this,false) /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor name.Only alphabets and spaces are allowed."/></td><td><span style="color:Red;" id="nameError"> </span></td></tr>
            <tr><td>Enter Phone:</td><td><input type="number" size=25 name="vdphone" placeholder="Ex:-9898989898" onchange=validatePhone(this,"phoneError") /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for phone no.Only digits are allowed."/></td><td><span style="color:Red;" id="phoneError"> </span></td></tr>
		    <tr><td></td><td><input type="submit" value="Submit" /></td></tr>
		</table>
		</form>';
	    return $form;
	}

	function onEditVendorFormSubmit()
	{
        $gotDetails = FALSE;
        if((isset($_REQUEST['vdid']) && !empty($_REQUEST['vdid'])) && $_REQUEST['vdid']!="Ex:-12")
        {
            $vendorID=$_REQUEST['vdid'];
        }
        else
        {
            $vendorName=$_POST['vdname'];
            $vendorPhone=$_POST['vdphone'];
            $vendorControllerObj = new VendorController();
            $vendorDetails=$vendorControllerObj->getVendorDetail(NULL, $vendorName, $vendorPhone);
            $gotDetails = TRUE;
            $vendorID = $vendorDetails[0]['vendor_id'];
        }
        $phoneError1 = "'phoneError1'";
        $phoneError2 = "'phoneError2'";
	    $vendorControllerObj=new VendorController();
	    $categoryControllerObj=new Categorycontroller();
        if(!$gotDetails)
	        $vendorDetails=$vendorControllerObj->getVendorDetail($vendorID);
	    $allVendorCategory=$categoryControllerObj->getAllCategories();
        $vendorCategory = $categoryControllerObj->getVendorCategory($vendorID);
	    if($vendorDetails && $allVendorCategory)
	    {
		$vendorDetails = $vendorDetails[0];
		
		$form='
		<div align=center>
		    <form action="editVendor.php?form=submit&vendorID='.$vendorID.'" method="post" onsubmit="return editVendorFormValidate(this)">
			<br><br>
			<table><tr><td><h3 style="text-align:center;"><font color="black">Fields which are marked <font color="red">*</font> are mandatory.</font></h3></td></tr></table>
			<h1>Edit Vendor Details Form</h1>
		    <table align=center>
			<tr><td>Name<font color="red">*</font></td><td><input type="text" size=30  name="vdname" value="'.$vendorDetails[1].'" onchange=validateName(this,"nameError") /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor name.Only alphabets and spaces are allowed."/></td><td><span style="color:Red;" id="nameError"> </span></td></tr>
			<tr><td>Address<font color="red">*</font></td><td><textarea rows=5 cols=23 onchange=validateAddress(this) name="vdaddress">'.$vendorDetails[2].'</textarea><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor business address."/></td><td><span style="color:Red;" id="addressError"> </span></td></tr>
			<tr><td>Email</td><td><input type="text" name="vdemail" size=30 value="'.$vendorDetails[3].'" onchange=validateEmail(this) /></td><td><span style="color:Red;" id="emailError"></span></td></tr>
			<tr><td>Phone 1<font color="red">*</font></td><td><input type="number"  size=30 name="vdphone1" value="'.$vendorDetails[4].'" onchange=validatePhone(this,'.$phoneError1.') /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for phone no.Only digits are allowed."/></td><td><span style="color:Red;" id="phoneError1"></span></td></tr>
			<tr><td>Phone 2</td><td><input type="number" name="vdphone2" size=30 value="'.$vendorDetails[5].'" onchange=validatePhone(this,'.$phoneError2.') /></td><td><span style="color:Red;" id="phoneError2"> </span></td></tr>
			<tr><td>Category<font color="red">*</font></td><td><select style="width:70%" id="vdcategory" size=8 name="vdcategory[]" multiple>';

		    foreach($allVendorCategory as $value)
		    {
			    $form = $form."<option value = '".$value[0]."'";
                foreach($vendorCategory as $opted)
                {
                    if($value['category_id'] == $opted['category_id'])
                        $form.=" selected=selected ";
                }
                $form.= ">".$value[1]."</option>";
		    }
		    $form=$form.'</select><img src="1.png" height="15.5" width="11.5" title="This field has been provided to select category of a vendor.More than one category can be selected.To select multiple categories double click and drag the mouse."/></td><td><span style="color:Red;" id="categoryError"> </span></td></tr></td><td><span style="color:Red;" id="categoryError"> </span></td></tr>
			    <tr><td></td><td><input type="submit" value="Update"></td></tr>
				</table>
				<input type="text" name="vendorID" value="$vendorID" hidden=hidden />
				

				</form></div>';
		    return $form;
	    }
	    else
	    {
		    return "<h3>Vendor Details Editing Form could not be created as the given Vendor does not exist!</h3>";
	    }
	}
	
	function editVendor()
	{
	    $vendorControllerObj = new VendorController();
	    $name=$_POST['vdname'];
	    $address=$_POST['vdaddress'];
	    $email=$_POST['vdemail'];
	    $phone1=$_POST['vdphone1'];
        if(isset($_POST['vdphone2']) || !empty($_POST['vdphone2']))
	        $phone2=$_POST['vdphone2'];
        else
            $phone2=NULL;
	    if(isset($_POST['vdcategory']))
		    $category=$_POST['vdcategory'];
	    else
		    $category=NULL;
	    $vendorID=$_GET['vendorID'];
		
	    $res=$vendorControllerObj->editVendorData($name,$address,$email,$phone1,$phone2,$category,$vendorID);
	    if($res)
			
		
		    return $this->displayVendorPersonalDetails($vendorID, $name, $address, $email, $phone1, $phone2, $category,"Vendor Details have been updated to the following values:",2);

			else {
		    return "<h1>Vendor Details could not be updated!</h1>";
	    }
	}

	function displayVendorForm()
	{	
	//	$catControllerObj = new CategoryController();
        //$allCategories = $catControllerObj->getAllCategories();

	    $form='<h1>Vendor Details</h1>
		<form action="" method="post" onsubmit="return vendorDetailsFormValidate(this)">
		<table align=center>
		    <tr><td>Enter Id:</td><td><input type="number" size=25 name="vdid" id="vdid" placeholder="Ex:-12" onchange=validateID(this) /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor ID.Only digits are allowed"/></td><td><span style="color:Red;" id="idError"> </span></td></tr>
            <tr><td colspan=2><strong>If you do not remember the ID,fill in the following details:</strong></td></tr>
            <tr><td>Enter Name:</td><td><input type="text" size=25 name="vdname" placeholder="Ex:-Ram Singh" onchange=validateName(this,false) /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for vendor name.Only alphabets and spaces are allowed."/></td><td><span style="color:Red;" id="nameError"> </span></td></tr>
            <tr><td>Enter Phone:</td><td><input type="number" size=25 name="vdphone" placeholder="Ex:-9898989898" onchange=validatePhone(this,"phoneError") /><img src="1.png" height="15.5" width="11.5" title="This field has been provided for phone no.Only digits are allowed."/></td><td><span style="color:Red;" id="phoneError"> </span></td></tr>
            <tr><td></td><td><input type="submit" value="Submit" /></td></tr>
		</table>
		</form>';
         // $catForm = $this->displayCategoryForm();
	    return $form; 
	}

	
	function onDisplayVendorFormSubmit()
	{
            $vendorID = NULL;
            $vendorName = NULL;
            $vendorPhone = NULL;
            $vendorControllerObj=new VendorController();
            $catControllerObj=new CategoryController();
            if((isset($_REQUEST['vdid']) && !empty($_REQUEST['vdid'])) && $_REQUEST['vdid']!="Ex:-12")
            {
                $vendorID=$_REQUEST['vdid'];
                $vendorDetails=$vendorControllerObj->getVendorDetail($vendorID, NULL, NULL);
            }
            else
            {
                $vendorName=$_POST['vdname'];
                $vendorPhone=$_POST['vdphone'];
                $vendorDetails=$vendorControllerObj->getVendorDetail(NULL, $vendorName, $vendorPhone);
            }
            if($vendorDetails==false)
                return "<h1>Vendor not found as for the provided details!</h1>";
            if(sizeof($vendorDetails) <= 1)
            {
                $vendorID = $vendorDetails[0]['vendor_id'];
                $vendorDetails = $vendorDetails[0];
                $categoryID=$vendorControllerObj->getVendorCategory($vendorID);
                for($i=0;$i<sizeOf($categoryID)/2;$i++)
                {
                        $category[$i]=$catControllerObj->getCategoryName($categoryID[$i][0]);
                }
                $purchase_orderControllerObj=new POController();
               // $stockControllerObj=new StockController();
                $itemControllerObj=new ItemController();
                $indentItemControllerObj=new IndentItemController();
                $purchase_orderID=$purchase_orderControllerObj->getPurchase_orderForVendor($vendorID);
                if(!is_null($purchase_orderID))
                {
                    $index=0;
                    for($index=0;$index<sizeOf($purchase_orderID);$index++)
                    {
                            $temp=$indentItemControllerObj->getItemDetailsAgainstPO($purchase_orderID[$index][0]);
                            if($temp!=false)
                                    $deliveryDetails[$index] = $temp;
                            else
                                    $deliveryDetails[$index] = false;
                    }
                }
                $size = sizeof($vendorDetails)/2;
                for($i=0;$i<$size;$i++)
                {
                    if(is_null($vendorDetails[$i]) || is_bool($vendorDetails[$i]) || empty($vendorDetails[$i])){
                            $vendorDetails[$i] = "N/A";
                    }
                }
                $table="<div id='personal' style='display:block;'>
                    <h1>Personal Details</h1>
                <table align=center border=2 cellpadding=10 style='border:solid;'>
                    <tr><td>ID:</td><td>$vendorDetails[0]</td></tr>
                    <tr><td>NAME:</td><td>$vendorDetails[1]</td></tr>
                    <tr><td>ADDRESS:</td><td>$vendorDetails[2]</td></tr>
                    <tr><td>EMAIL:</td><td>$vendorDetails[3]</td></tr>
                    <tr><td>PHONE1:</td><td>$vendorDetails[4]</td></tr>
                    <tr><td>PHONE2:</td><td>$vendorDetails[5]</td></tr>
                    <tr><td>CATEGORY:</td><td>";
                for($i=0;$i<sizeOf($category);$i++){
                if($i%2==0)
                {
                            $table.="<font color='green'>".$category[$i][0]."</font><br/>";
                    }
                    else
                    {
                            $table.="<font color='blue'>".$category[$i][0]."</font><br/>";
                    }
                }
                $table.="</td></tr></table>
                <br><br><p align=center><font style='font-size:larger;'><a style='text-decoration:none;'  href='vendorUpdate.php?vdid=".$vendorDetails[0]."'><button>Edit Details</button></a></font><button onclick='printPage()'>Print</button>
</p></div>";
                $table1="<div id='po' style='display:none;'>
                        <h1>Purchase Order Details</h1>";
                if(!is_null($purchase_orderID))
                {
                    $table1.="<table align=center border=2 border=2 cellpadding=10 style='border:solid;'><tr><td><strong>ORDER NO:</strong></td><td><strong>STATUS</strong></td><td><strong>ITEM NAME(QUANTITY)</strong></td></tr>";
                    for($i=0;$i<sizeOf($purchase_orderID);$i++)
                    {
                        $table1.= "<tr><td width=200 rowspan=".sizeof($deliveryDetails[$i]).">";
                        $table1.= "Purchase Order #".$purchase_orderID[$i][0]."</td><td>";
                        $j = 0;
                        if(!is_bool($deliveryDetails[$i]))
                        {
                                foreach($deliveryDetails[$i] as $value)
                                {
                                        if($j>0)
                                                $table1 .= "<tr><td>";
                                        if($value!=false)
                                        {
                                                $table1 .= $value['status']."</td><td>".$value['name']." (".$value['quantity'].")</td></tr>";
                                        }
                                        else
                                        {
                                                $table1 .= "N/A"."</td><td>"."No Items Found</td></tr>";
                                        }
                                        $j++;
                                }
                        }
                        else {
                                $table1 .= "N/A</td><td>No items found</td></tr>";
                        }
                    }
                    $table1 .= "</table>
</div><button onclick='printPage()'>Print</button>";
                }
                else
                {
                    $table1.= "<h3 style='text-align:center;'>No Purchase Orders found for the given Vendor.</h3></div>";
                }
                $options = '<div align="center">
                            <input type="button" class="head-link" value="Personal" onclick="displayPersonal()" />
                            <input type="button" class="head-link" value="PO" name="editVendor" onclick="displayPO()" />
                        </div>';
                return $options.$table.$table1."</div>";
            }
            else
            {
                $table="<h1>List of Vendors</h1></legend><div>
                        <filter></filter>
                        <table align=center border=2>
                                                <tr><td width=150>Vendor ID</td><td width=150>Vendor Name</td></tr>";
                foreach($vendorDetails as $value){
                            $table.="<tr><td align=center><a style='text-decoration:none;' href='vendorDetails.php?vdid=".$value['vendor_id']."'>".$value['vendor_id'].
                                    "</a></td><td>".$value['name']."</td></tr>";
                        }
                $table.="</table>
                    <br/>
                    <a href='vendorReport.php?report=listOfVendorsAgainstIDNamePhone&vendorID=$vendorID&vendorName=$vendorName&vendorPhone=$vendorPhone'><button>Download</button></a>
                    <button onclick=printPage()>Print</button>
                    </div>";
                return $table;
            }
    }


	function displayCategoryForm()
	{
        $catControllerObj = new CategoryController();
        $allCategories = $catControllerObj->getAllCategories();
         $itemControllerObj = new ItemController();
        $allItems = $itemControllerObj->getAllItems();
	    $form='<h1>Display list of Vendors</h1>
		<form action="" method="post" onsubmit="return vendorListFormValidate(this)" name="f2">
		<table align=center>
		    <tr><td width=100>Choose Category:</td>
                <td><select name="catId">';
            $form.="<option value='select'>--SELECT CATEGORY--</option>";
                        foreach($allCategories as $value){
                            $form.="<option value=".$value['category_id'].">".$value['name']."</option>";
                        }
        $form.='</select><img src="1.png" height="15.5" width="11.5" title="Select and submit a category to get list of vendors."/></td></tr>
		<tr><td></td><td><strong>OR</strong></td></tr>';
		$form.='<tr><td width=100>Choose Item:</td>
           <td><select name="itemId" >
            <option value="select">--SELECT ITEM--</option>';
                        foreach($allItems as $value){
                            $form.="<option value=".$value['item_id'].">".$value['name_brand']."</option>";
                        }
              $form.='</select><img src="1.png" height="15.5" width="11.5" title="Select and submit an item to get list of vendors."/></td></tr>
		    ';
        
        $form.=' <tr><td></td><td><input type="submit" value="Submit" /></td></tr>
			
                </form>
		</table>
                <br/>
                <table>
		<tr><td align=center><a href="listOFVendors_Category.php">Display List Of Vendors Category Wise</a></td></tr>
                <tr><td align=center><a href="listOFVendors_Item.php">Display List Of Vendors Item Wise</a></td></tr></table>';
		
	    return $form; 
	}

    function onDisplayCategoryFormSubmit()
    {
        $categoryID=$_POST['catId'];
        $itemID= $_REQUEST['itemId'];
        $catName = NULL;
        $itemName = NULL;
        if($categoryID == "select")
            $categoryID = NULL;
        if($itemID == "select")
            $itemID = NULL;
        $catControllerObj=new CategoryController();
        $itemControllerObj= new ItemController();
        $vendor_catControllerObj=new Vendor_CategoryController();
       // $vendorControllerObj=new VendorController();
        if(!is_null($categoryID))
        {
            $catName=$catControllerObj->getCategoryName($categoryID);
            if($catName==FALSE)
            {
                return "<font color='red'>Category Not Found!</font>";
            }
            $catName = $catName[0];
        }
        if(!is_null($itemID))
        {
            $itemName=$itemControllerObj->getItemName($itemID);
            if($itemName==FALSE)
            {
                return "<font color='red'>Item Not Found!</font>";
            }
            $itemName = $itemName[0];
        }
        if(!is_null($categoryID))
            $vendor=$vendor_catControllerObj->getVendorInfo($categoryID);
        if(!is_null($itemID))
            $vendorInfo=$vendor_catControllerObj->getVendorInformation($itemID);
        $table=" ";
        $table1=" ";
        if($catName)
        {
            $table="<h1>List of Vendors (".ucwords($catName).")</h1></legend><div>
                    <filter></filter>
                    <table align=center border=2>
					    <tr><td width=150>Vendor ID</td><td width=150>Vendor Name</td></tr>";
	        for($i=0;$i<sizeOf($vendor)-1;$i++){
		        $table1.="<tr><td align=center><a style='text-decoration:none;' href='vendorDetails.php?vdid=".$vendor[$i][0]."'>".$vendor[$i][0]."</a></td><td>".$vendor[$i][1]."</td></tr>";
		    }
		    $table1.="</table>
                    <br/>
                    <a href='vendorReport.php?report=listOfVendorsAgainstCategoryItem&catID=$categoryID&itemID=$itemID'><button>Download</button></a>
                   <button onclick='printPage()'>Print</button> </div>";
        }
        else if($itemName)
        {
            $table="<h1>List of Vendors ($itemName)</h1></legend><div>
            <filter></filter>
                    <table align=center border=2>
					    <tr><td width=150>Vendor ID</td><td width=150>Vendor Name</td></tr>";
	        for($i=0;$i<sizeOf($vendorInfo)-1;$i++){
		        $table1.="<tr><td align=center><a style='text-decoration:none;' href='vendorDetails.php?vdid=".$vendorInfo[$i][0]."'>".$vendorInfo[$i][0]."</a></td><td>".$vendorInfo[$i][1]."</td></tr>";
		    }
		    $table1.="</table>
                        <br/>
                        <a href='vendorReport.php?report=listOfVendorsAgainstCategoryItem&catID=$categoryID&itemID=$itemID'><button>Download</button></a>
                        <button onclick='printPage()'>Print</button></div>";
        }
        return $table.$table1;
    
    }
	function displayVendor_CategoryList()
	{
		 $vendor_catControllerObj=new Vendor_CategoryController();
		 
		  $vendor=$vendor_catControllerObj->getVendorList();
                  
                  
	    $table1=" ";
	   
		
		if($vendor)
		{
			 $table="<div><h1>List of Vendors</h1>
             <filter></filter>
                    <table align=center border=2>
					    <tr><td><h3>Vendor ID</h3></td><td ><h3>Vendor Name</h3></td><td><h3>Category ID</h3></td><td><h3>Category Name</h3></td></tr>";
	        for($i=0;$i<sizeOf($vendor)-1;$i++){
		        $table1.="<tr><td><a style='text-decoration:none;' href='vendorDetails.php?vdid=".$vendor[$i][2]."'>".$vendor[$i][2]."</a></td><td>".$vendor[$i][3]."</td><td align=center>".$vendor[$i][0]."</td><td>".$vendor[$i][1]."</td></tr>";
		    }
                    $table1.="</table>
                        <br/>
                        <a href='vendorReport.php?report=listOfVendorsAgainstAllCategory'><button>Download</button></a>
                       <button onclick='printPage()'>Print</button> </div>";
                }
        return $table.$table1;
        }
    function displayVendor_ItemList()
    {
        $vendor_categoryObj= new Vendor_CategoryController();
        $vendorDetails= $vendor_categoryObj->getVendor_ItemList();
        $table=" ";
        $table1=" ";
        if(!is_null($vendorDetails))
        {
             $table="<div><h1>List of Vendors</h1>
             <filter></filter>
                    <table align=center border=2>
                        <tr><td>Vendor ID</td><td>Vendor Name</td><td>Item ID</td><td>Item Name</td></tr>";
	        for($i=0;$i<sizeOf($vendorDetails)-1;$i++){
		        $table1.="<tr><td align=center><a style='text-decoration:none;' href='vendorDetails.php?vdid=".$vendorDetails[$i][2]."'>".$vendorDetails[$i][2]."</a></td><td>".$vendorDetails[$i][3]."</td><td align=center>".$vendorDetails[$i][0]."</td><td>".$vendorDetails[$i][1]."</td><td align=center></td></tr>";
		    }
		    $table1.="</table>
                            <br/>
                            <a href='vendorReport.php?report=listOfVendorsAgainstAllItems'><button>Download</button></a>
                            <button onclick='printPage()'>Print</button></div>";
                
        }
        return $table.$table1;
    }
}
?>