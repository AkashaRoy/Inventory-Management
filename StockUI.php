<script type="text/javascript">
function isValidKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode < 48 || charCode > 57)
             {
			 alert("Invalid Character");
			 return false;
			 }

          return true;
       }
	   
	  function onclick_update()
{

  //var x1=document.forms["recieve_stock"]["price"].value;
  //if(x1==null || x1=="" || isNaN(x1) || x1<0 || x1==0)
  var x1=document.forms["recieve_stock"]["ItemId"].value;
  if(x1=="<--select-->")
      {
	  alert("select item id");
         //alert("price must be filled out correctly");
         return false;
      }
	  //alert("fields should nt be empty");
	 // return false;

}
	   
	   function isValidKey2(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ( charCode != 46 &&(charCode < 48 || charCode > 57))
             {
			 alert("Invalid Character");
			 return false;
			 }

          return true;
       }
	   
	   function testCheck()
	   {
			var id = document.forms["recieve_stock"]["ItemId"].value;	
			var qty = document.forms["recieve_stock"]["quantity"].value;
			var damage_qty = document.forms["recieve_stock"]["damage_quantity"].value;
			var x=parseInt(qty);
			var y=parseInt(damage_qty);
			//alert(damage_qty);
			var number=/^[0-9]+$/;
			//alert(id);
			//return false;
			if(id==0)
			{
				alert("please select a item");
				return false;
			}
			if(!qty.match(number) || qty==null || qty==0)
			{
				alert("enter a valid quantity");
				return false;
			}
		    if(!damage_qty.match(number) || damage_qty==null)
			{
				alert("enter a valid damage quantity");
				return false;
			}
			

			
		
			if(x < y)
			{
				
					
				alert("damage quantity cant be greater then total quantity");
				return false;
			}
			
			return true;
	   }
	function validateForm()
	   {
	   var x=0;
	   var y=0;
	    x=document.forms["recieve_stock"]["quantity"].value;
	    y=document.forms["recieve_stock"]["damage_quantity"].value;
		//alert(x);
		//alert(y);	
			if (x==null || x=="" || x==0 )
			  {
				  alert("enter the quantity");
				  return false;
			 }
			 else if(document.forms["recieve_stock"]["quantity"].value < document.forms["recieve_stock"]["damage_quantity"].value)
			 {
				alert("damage goods can not be greater then quantity");
				return false;
			 }
			 else
			
				return false;
	   }
	   
function validateForm2()
{
var x=document.forms["purchase_order"]["POId"].value;
if (x=="<--select-->")
{
alert("select a purchase order id");
return false;
}
}
function validateForm5()
{
var number=/^[0-9]+$/;
var x=document.forms["stock_form"]["stockid"].value;
if (!x.match(number) || x=="" || x==null)
{
alert("enter a  correct stock id");
return false;
}
}
function validateForm3()
{
var x=document.forms["category_list"]["Category"].value;
if (x=="<--select-->")
{
alert("select a category");
return false;
}
}
function validateForm4()
{
var x=document.forms["date_form"]["date"].value;
if (x=="Click Here To Choose Date")
{
alert("select a date");
return false;
}
}
</script>
<?php
//session_start();
include_once 'POController.php';
include_once 'ItemController.php';
include_once 'StockController.php';
include_once 'CategoryController.php';
include_once 'VendorController.php';
include_once 'IndentController.php';
include_once 'DepartmentController.php';
include_once 'StudentController.php';

class StockUI
{
function requestReceiveForm()
{
$poControllerObj = new POController();
$result4=$poControllerObj->getPOId();
$form="";

        $form.="
			
<h3 align='center'>STOCK RECEIVE</h3>
<form name='purchase_order' action='index_stock.php' method='get' onsubmit='return validateForm2()'>

 <table align='center' border=2>
 <tr>
		<td>enter purchase order id	</td><td><select name='POId' id= 'POId'><option selected='selected'>".'<--select-->'."</option>";
	   while($row=mysqli_fetch_array($result4))
		{
			$form = $form."<option value='".$row[0]."'>".$row[0]."</option>";
	    }
	$form = $form."</td>
	<td><img src='24.jpg' title= 'the  unique id generated when the purchase order is created.numeric value only' height='15' width='15' /></td>
		<tr>
		<td><input type='submit' value='next' size=10/></td>
		<td><input type='reset' value='clear' size=10/></td>
		</tr>
 </table>

</form>
";
	return $form;
	}
							
							
function submitForm($id)
{
$_SESSION['po']=$id;
//echo $po;
$purchaseOrderObj = new POController();
$result1=$purchaseOrderObj->getPurchaseDetails($id);
		if($result1)
		{
		return $result1;
		}
		else
		{
		return false;
		//return "po doesnot exist";
		}
}
	
function getItemDetails($indent)
{
$itemObj = new ItemController();
$result2=$itemObj->getAllItemData2($indent);
		if($result2)
		{
		return $result2;
		}
		else
		{
		return false;
		//return "Sorry! Try again later.";
		}
}
function storeItem()
{
    $stockControllerObj = new StockController();
    $result3=$stockControllerObj->check();
	if($result3)
	{
	    return $result3;
	}
	else
	{
	    return false;
	}
}

function requestCategoryForm()
{
$categoryControllerObj = new CategoryController();
$result4=$categoryControllerObj->getCategory();
$form="";

        $form.="

<h3 align='center'>CATEGORY LIST</h3>
<form  name='category_list' action='view_category.php' method='post' onsubmit='return validateForm3()'>

 <table align='center' border=2>
 <tr>
		<td>select a category	</td><td><select name='Category' id= 'Category'><option selected='selected'>".'<--select-->'."</option>";
	   while($row=mysqli_fetch_array($result4))
		{
			$form = $form."<option value='".$row[0]."'>".$row[0]."</option>";
	    }
	$form = $form."</td>
	<td><img src='24.jpg' title='select the category whose item details are required' height='15' width='15' /></td>
	
		</tr>
		<tr>
		<td><input type='submit' value='get item list' size=10/></td>
		<td><input type='reset' value='clear' size=10/></td>
		</tr>
 </table>
</form>";
	return $form;
}


function requestForm()
{
$temp=$_SESSION['po'];
//echo $temp;
$itemControllerObj = new ItemController();
$result5=$itemControllerObj->getItem($temp);
if($result5)	
{
$form="";
$form.="<h2 align='center'>STOCK RECEIVE FORM</h2>
<form name='recieve_stock' action='database_stock.php' method='post' onsubmit='return testCheck()'>
<h4 align='center'>
<font color='red'> * </font> fields are mandatory</h4>
 <table align='center'>
  <tr>
 <td>purchase order id</td><td><input type='text' name='POId' size=10 disabled='disabled'";
	//$form.="this.value=''";
	
	$form.=" value='".$_SESSION['po']."' /></td>
 </tr>

 <tr>
 <td>item id<font color='red'>*</font></td><td><select name='ItemId' ><option selected='selected' value=0>".'<--select-->'."</option>";
 
	   while($row=mysqli_fetch_array($result5))
		{
			$form = $form."<option value='".$row[1]."'>".$row[1].'('.$row[0].')'."</option>";
	    }

	$form = $form."</td>
	<td><img src='24.jpg' title='ITEM ID THE UNIQUE ID AND IT SHOULD BE NUMBERS ONLY' height='15' width='15' /></td>
	
 </tr>
 <tr >
 <td> total quantity<font color='red'>*</font><br/>(including damaged goods)</td><td><input type='text' name='quantity' size=10 maxlength='9' />
 <img src='24.jpg' title='NUMBER OF GOODS THAT HAVE ARRIVED' height='15' width='15' /></td>
	
 </tr>
  <tr>
 <td>Damaged goods</td><td><input type='text' name='damage_quantity' value='0' size=10  maxlength='9'/>
 <img src='24.jpg' title='NUMBER OF GOODS THAT ARE DAMAGED' height='15' width='15' /></td>
	
 </tr>
 <tr>
 <td>receive date </td>
	<td><input type='text' name='date' value='".date('Y-m-d')."' readonly='readonly'/></td></tr>
 <tr>
 <td></td><td><input type='submit' value='Save' onclick='return onclick_update(this)'/> <input type='reset' value='clear' /></td></tr>
 	</table></form>
	<a href='index_stock.php?POId=$temp'><button>Go Back</button></a> <a href='index.php'><button>Home</button></a>
	
";
	return $form;
}
else 
{
return $this->failurePage();
}
}

function onReceiveFormDataSubmit()
    {
	$form_data['POId']=$_SESSION['po'];
	//echo $form_data['POId'];
	$form_data['ItemId']=$_POST['ItemId'];
	//echo $form_data['POId'];
	$form_data['quantity']=$_POST['quantity'];
	$form_data['damage_quantity']=$_POST['damage_quantity'];
	$form_data['date']=$_POST['date'];
	$itemControllerObj1 = new ItemController();
	$a=$itemControllerObj1->get1($form_data['ItemId']);
    $x=-1;
	while($r5=mysqli_fetch_array($a))
	{
	//echo "@@@@@2######";
	//echo $r5[0];
	$x=$r5[0];
	}
	if($x!=-1)
	{
		//echo "correct in ui";
		$stockControllerObj = new StockController();
		//if($stockControllerObj->check($form_data['POId'],$form_data['ItemId'],$form_data['quantity'],$form_data['price'],$form_data['date'],$form_data['category']))
      $var= $stockControllerObj->check($form_data['POId'],$form_data['ItemId'],$form_data['quantity'],$form_data['damage_quantity'],$form_data['date'],$x);
	   if($var)
	   return $var;
			//return $this->successPage();
			else
			return $this->failurePage2();
			}
		else
		{
		//echo "not correct in ui";
		echo "<h2 align='center'> YOUR ITEM ID DOES NOT EXIST</h2>";
		echo "<br/>";
		return $this->failurePage();
		}

	}
	
    private function successPage()
    {
	return "Data successfully entered!";
    }
    
    private function failurePage()
    {
	return " NO MORE ITEMS TO RECEIVE IN THIS PURCHASE ORDER";
    }		
	private function failurePage2()
    {
	return "   FIELDS SHOULD NOT BE EMPTY </br> Sorry! Try again later.";
    }		
function requestItemForm($Category)
{
$itemControllerObj = new ItemController();
$result4=$itemControllerObj->getItemList($Category);
		if($result4)
		{
		return $result4;
		}
		else
		{
		return false;
		}
	/*$form="";

        $form.="

<h3 align='center'>VIEW CURRENT STOCK</h3>
<form action='view.phpview.php' method='post'>

 <table  align='center' border=2>
 <tr>
		<td>enter item id</td><td><input type='text' name='ItemId' size=10 onkeypress='return isValidKey(event)'/></td>
		</tr>
		<tr>
		<td><input type='submit' value='GET' size=10/></td>
		<td><input type='reset' value='NEW' size=10/></td>
		</tr>
 </table>

</form>";
	return $form;*/
}

function viewStockDetails($id)
{
//echo "@@@@@";
$stockObj = new StockController();
$result2=$stockObj->viewAllStockData($id);
		if($result2)
		{
		return $result2;
		}
		else
		{
		//return "Sorry! Try again later.";
		return false;
		}
}

	
function getVendorDetails($code)
{
$vendorControllerObj = new VendorController();
$result6=$vendorControllerObj->getAllVendorDetails($code);
		if($result6)
		{
		return $result6;
		}
		else
		{
		return false;
		}
}

function getIndentDetails($code)
{
$indentControllerObj = new IndentController();
$result7=$indentControllerObj->getAllIndentDetails($code);
		if($result7)
		{
		return $result7;
		}
		else
		{
		return false;
		}
}
function getItemCurrentStock()
{
$stockObj2 = new StockController();
$result8=$stockObj2->getAllItemCurrentStock();
if($result8)
{
return $result8;
}
else
{
return false;
}
}

function getMinimumItemCurrentStock()
{
$stockObj2 = new StockController();
$result9=$stockObj2->getAllMinimumItemCurrentStock();
if($result9)
{
return $result9;
}
else
{
return false;
}
}

function getDateForm()
{
$form="";

        $form.="<link rel='stylesheet' type='text/css' href='cal.css' media='screen'/><table class='ds_box' cellpadding='0' cellspacing='' id='ds_conclass' style='display: none;'>
	<tr><td id='ds_calclass'>
	</td></tr>
	</table>

<h3 align='center'>EXPECTED DATE WISE STOCK VIEW</h3>
<form name='date_form' action='view_stock_datewise.php' method='post' onsubmit='return validateForm4()'>

 <table align='center' border=2>
 <tr>
<td>enter the expected date</td><td><script type='text/javascript' src='cal.js'></script>
<input name='date' id='date' readonly='readonly' value='Click Here To Choose Date' size =30 style='color:Gray;'  onfocus='fieldFocusGained(this)' onblur='fieldFocusLost(this)' onclick='ds_sh(this)'/>
</td>
</tr>
<tr>
		<td><input type='submit' value='get item list' size=10/></td>
		<td><input type='reset' value='clear' size=10/></td>
		</tr>
 </table>
</form>";
	return $form;
}
function requestItemList($id)
{
$stockObj3 = new StockController();
$result10=$stockObj3->requestAllItemCurrentStock($id);
if($result10)
{
//echo "asdfghj";
return $result10;
}
else
{
//echo "not";
return false;
}
}
function requestStockForm()
{
$form="";

        $form.="

<h3 align='center'>stock view</h3>
<form  name='stock_form' action='view_stockid.php' method='post' onsubmit='return validateForm5()'>

 <table align='center' border=2>
 <tr>
		<td>enter a stock id</td><td><input type='text' name ='stockid' size=10></td>
		</tr>
		<tr>
		<td><input type='submit' value='get details' size=10/></td>
		<td><input type='reset' value='clear' size=10/></td>
		</tr>
</table>
</form>";
	return $form;

}

function requestStock($id)
{
$stockObj3 = new StockController();
$result10=$stockObj3->requestAllStock($id);
if($result10)
{
//echo "asdfghj";
return $result10;
}
else
{
//echo "not";
return false;
}

}
	
	function stockIssueToStudForm()
    {
	    $itemControllerObj=new ItemController();
	    $items=$itemControllerObj->getAllItemData();
        $form = '<div style="padding:20px; text-align:center;">
        <h3><font align=center style="padding-left:10px;">Fields which are marked <font color="red">*</font> are mandatory</font></h3>';
	    if($items==false)
	    {
	        return "<p style='color:red;'> Form could not be created. </p>";
	    }
	    else{
	        $form .= "<h1>Issue To Student</h1>
			    <form action='issue.php?choice=student' method='post' onsubmit='return validateIssueToStudentForm(this)' >
			    <table align=center style='width:55%'>
			    <tr class=noborder >
			    <td style='width:40%' align='left'>Enter Student Id <font color='red'>*</font></td><td style='width:40%'><input type='number' min=1 name='sID' placeholder='Ex:-247' style='width: 200px;' onchange='validateStudentID(this)' required >
                    <img src='images/help.png' height='15.5' width='11.5' title='Enter the student ID here. Only numerics are allowed.'/>
                </td><td style='width:20%'><span id='studentIDError' class=error ></span></td>
			    </tr>
			    <tr>
			    <td style='width:40%' align='left'>Choose Item <font color='red'>*</font></td>
                <td style='width:40%'> <select name='item' style='width: 200px' required>
                    <option value=''>--SELECT ITEM--</option>";
	        for($i = 0; $i < sizeof($items); $i++)
			{
		        $form=$form."<option value='".$items[$i]."'>".ucwords($items[++$i])."</option>";
		    }
	        $form=$form."</select>
                <img src='images/help.png' height='15.5' width='11.5' title='Choose the item form the drop-down list.'/>
		        </td><td style='width:20%'><span id='itemError' class=error ></td>
		    </tr>
		    <tr>
		        <td align='left' style='width:40%' >Quantity <font color='red'>*</font></td><td style='width:40%'>
                <input type='number' min=1 name='quantity' id='quantity' placeholder='Ex:-12' style='width: 200px;'  onchange='validateQuantity(this)' required />
                <img src='images/help.png' height='15.5' width='11.5' title='Mention the quantity of the item to be issued. Only numerics are allowed.'/></td><td style='width:20%' ><span id='quantityError' class=error >
                </span></td>
		    </tr>
		    <tr>
		        <td></td><td><input type='submit' value='Submit'></td>
		    </tr>
            </table>
		    </form>
            </div>";
	        return $form;
    	}
    }
    
    function onStockIssueToStudFormSubmit()
    {
	    $sID=$_POST['sID'];
	    $item=$_POST['item'];
	    $quantity=$_POST['quantity'];
        $studentControllerObj = new StudentController();
        $temp = $studentControllerObj->checkStudentId($sID);
        if(empty($temp) || $temp == 2) {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>The student ID doesn't exist. <br/><br/>
                        <a href='issue.php?choice=student'><button> Try again? </button></a></h3>
                    </div>";
        }
	    $stockControllerObj = new StockController();
	    $result=$stockControllerObj->issueToStud($sID,$item,$quantity);
	    if($result)
	    {
	        $string = "<div align=center style='padding:20px;'><h3 align=center>Successfully Issued to Student ID: $sID!<br/></h3>";
            $itemDetails = $stockControllerObj->getItemInStockDetails($item);
            $string .= "<table width=40%>
                        <th colspan=2><h3>Item Details</h3></th>
                            <tr class=noborder >
                                <td>Item ID</td><td>".$item."</td>
                            </tr>
                            <tr>
                                <td>Item Name</td><td>".ucwords($itemDetails['name_brand'])."</td>
                            </tr>
                            <tr>
                                <td>Current Quantity in Stock</td><td>";
            if(empty($itemDetails['sum']) || $itemDetails['sum'] == 0) {
                $string .= "<font style='color:red'>".$itemDetails['sum']."</font>";
            }
            else
            {
                $string .= $itemDetails['sum'];
            }
            $string .= "</td>
                            </tr>
                        </table>";
            $string .= "<br/><a href=issue.php?choice=dept><button>Issue Another</button></a></p></div>";
            return $string;
	    }
	    else if($result==false){
	        return "<h3 align=center style='color:red'><br/>Stocks may not be available now.<br/><br/>
		    <a href=issue.php?choice=dept><button>Try again?</button></a></h3></div>";
	    }
	    else {
	        return "<h3 align=center style='color:red;'><br/>Sufficient Quantity may not have been issued!</h3></div>";
	    }
    }
    
    function stockIssueToDeptForm()
    {
	    $itemControllerObj=new ItemController();
	    $items=$itemControllerObj->getAllItemData();
	    $deptControllerObj=new DepartmentController();
	    $depts=$deptControllerObj->fetchDepartmentData();
        $form = '<div style="padding:20px; text-align:center;">
        <h3><font color="black">Fields which are marked <font color="red">*</font> are mandatory</font></h3>';
	    if($depts==false || $items==false)
	    {
	        return "<p style='color:red;' align=center> Form could not be created. </p>";
	    }
	    else{
	        $form .= "<h1 align=center>Issue To Department</h1>
		        <form action='issue.php?choice=dept' method='post' >
		        <table align=center style='width:55%'>
		        <tr>
			    <td width='40%' align='left'>Choose Department <font color='red'>*</font></td>
                <td style='width: 40%'> <select name='dept' style='width: 90%' required>
                    <option value=''>--SELECT DEPARTMENT--</option>";
			    for($i = 0; $i < sizeof($depts); $i++)
			    {
			        $form=$form."<option value='".$depts[$i]."'>".ucwords($depts[++$i])."</option>";
			    }
			    $form=$form."</select>
                <img src='images/help.png' height='15.5' width='11.5' title='Choose the department from the drop-down list.'/>
			    </td><td style='width: 20%'><span id='deptError' style='width:50%;color:red;' ></span></td>
		        </tr>
		        <tr>
			    <td align='left'>Choose Item <font color='red'>*</font></td>
                <td> <select name='item' style='width: 90%' required>
                    <option value=''>--SELECT ITEM--</option>";
			    for($i = 0; $i < sizeof($items); $i++)
			    {
			        $form=$form."<option value='".$items[$i]."'>".ucwords($items[++$i])."</option>";
			    }
			    $form=$form."</select>
                    <img src='images/help.png' height='15.5' width='11.5' title='Choose an item from the drop-down list.'/>
                    <td><span id='itemError' style='width:50%;color:red;' ></span></td>
			        </td>
		            </tr>
		            <tr>
			        <td align='left'>Quantity <font color='red'>*</font></td><td><input type='number' min='1' name='quantity' placeholder='Ex:-12' style='width: 90%; color:gray;' onchange='validateQuantity(this)' required>
                        <img src='images/help.png' height='15.5' width='11.5' title='Mention the quantity of the item to be issued. Only numerics are allowed.'/></td><td><span id='quantityError' style='color:red;' >
                    </td>
                    <td><span id='quantityError' style='color:red;' >
                    </td>
		            </tr>
		            <tr>
			        <td></td><td><input type=submit value='Submit'></td>
		            </tr>
                    </table>
		        </form>
                </div>";
	        return $form;
	    }
    }
    
    function onStockIssueToDeptFormSubmit()
    {
	    $dept=$_POST['dept'];
	    $item=$_POST['item'];
	    $quantity=$_POST['quantity'];
	    $stockControllerObj = new StockController();
	    $result=$stockControllerObj->issueToDept($dept,$item,$quantity);
	    if($result)
	    {
	        $string = "<div align=center style='padding:20px;'><h3 align=center>Successfully Issued!</h3><br/>";
            $itemDetails = $stockControllerObj->getItemInStockDetails($item);
            $string .= "<table width=40%>
                        <th colspan=2><h3>Item Details</h3></th>
                            <tr class=noborder >
                                <td>Item ID</td><td>".$item."</td>
                            </tr>
                            <tr>
                                <td>Item Name</td><td>".ucwords($itemDetails['name_brand'])."</td>
                            </tr>
                            <tr>
                                <td>Current Quantity in Stock</td><td>";
            if(empty($itemDetails['sum']) || $itemDetails['sum'] == 0) {
                $string .= "<font style='color:red'>".$itemDetails['sum']."</font>";
            }
            else
            {
                $string .= $itemDetails['sum'];
            }
            $string .= "</td>
                            </tr>
                        </table>";
            $string .= "<br/><a href=issue.php?choice=dept><button>Issue Another</button></a></div>";
            return $string;
	    }
	    else if($result==false){
	        return "<h3 align=center style='color:red'><br/>Stocks may not be available now.<br/><br/>
		    <a href=issue.php?choice=dept><button>Try again?</button></a></h3></div>";
	    }
	    else {
	        return "<h3 style='color:red;' align=center ><br/>Sufficient Quantity may not have been issued!</h3></div>";
	    }
    }

    function itemIssuedToStudentForm()
    {
	    $form = "<div style='padding:20px; text-align:center;'>
                <h1>Items Issued to a Student</h1>
			    <form action='' method='get' onsubmit='return validateItemIssuedToStudentForm(this)' >
			    <table align='center' style='width:45%'>
			    <tr class=noborder >
			    <td style='width:40%'>Enter Student Id <font color='red'>*</font></td><td style='width:40%'><input type='number' min=1 name='sID' placeholder='Ex:-247' onchange='validateStudentID(this)' required >
                    <img src='images/help.png' height='15.5' width='11.5' title='Enter the student ID here. Only numerics are allowed.'/>
                </td><td style='width:20%'><span id='studentIDError' style='color:red;' ></span></td>
		    <tr class=noborder >
		        <td></td><td><input type='submit' value='Submit'></td>
		    </tr>
            </table>
            </form>
            <strong>OR</strong><br/>
            <h3>
                <a style='text-decoration:none;' href=itemStudents.php?all=true>Issue Details of All Students</a>
            </h3>
            </div>";
	    return $form;
    }

    function onItemIssuedToStudentFormSubmit()
    {
        $sID = $_GET['sID'];
        $studentControllerObj = new StudentController();
        $temp = $studentControllerObj->checkStudentId($sID);
        if(empty($temp) || $temp == 2) {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>The student ID doesn't exist. <br/> <a href='itemStudents.php'><button> Try again? </button></a> </h3>
                    </div>";
        }
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstStudent($sID);
        if(empty($row) || is_null($row))
        {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>This student has not been issued any items yet.</h3>
                    </div>";
        }
        $table = "<div style='padding:20px; text-align:center;'>
        <filter></filter>
                <h2>Items issued to a Student</h2>
                <h3>Student ID : $sID <h3/>
                <h3>Student Name : ".ucwords($row[0]['name'])."</h3>
                <br/><br/>
                <table align='center'>
                <tr align=center class=noborder >
                    <td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                </tr>";
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $table .= "<tr align=center>
                        <td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $table .= $value['issue_date']."</td>";
            }
            else {
                $table .= "N/A</td>";
            }
        }
        $table .= "</table>";
        $table .= "<br/><a href='issueReport.php?report=issueDetailsStudent&sID=$sID'><button>Download</button></a>
            <button onclick='printPage()'>Print</button>
            </div>";
        return $table;
    }

    function displayIssueDetailsOfAllStudents()
    {
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstAllStudents();
        if(empty($row) || is_null($row))
        {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>No students have been issued any items yet.</h3>
                    </div>";
        }
        $table = "<div style='padding:20px; text-align:center;'>
        <filter></filter>
        <h2>Items issued to Students</h2>
                <table align='center'>
                <tbody id='fbody'>
                <tr align=center class=noborder >
                    <td><strong>Student ID</strong></td><td><strong>Student Name</strong></td><td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                </tr>";
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $table .= "<tr align=center>
                    <td>".$value['student_id']."</td><td>".ucwords($value['name'])."</td><td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
           if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $table .= $value['issue_date']."</td>";
            }
            else {
                $table .= "N/A</td>";
            }
        }
        $table .= "</tbody></table>
        <br/><a href='issueReport.php?report=issueDetailsAllStudents'><button>Download</button></a>
            <button onclick='printPage()'>Print</button>
            </div>";
        return $table;
    }


    function itemIssuedToDeptForm()
    {
        $deptControllerObj = new DepartmentController();
        $depts = $deptControllerObj->fetchDepartmentData();
	    $form = "<div style='padding:20px; text-align:center;'>
                <h1>Items Issued to a Department</h1>
			    <form action='' method='post' onsubmit='return validateItemIssuedToDepartmentForm(this)' >
			    <table align='center' style='width:50%'>
			    <tr class=noborder >
			        <td style='width:40%'>Enter Department Id <font color='red'>*</font></td>
                    <td style='width:40%'>
                            <select name='deptID' onchange = validateDropdown(this,'deptIDError') required >
                                <option value=''>--SELECT DEPARTMENT--</option>";
        for($i = 0; $i < sizeof($depts); $i++)
	    {
	        $form=$form."<option value='".$depts[$i]."'>".ucwords($depts[++$i])."</option>";
		}

        $form .= "</select><img src='images/help.png' height='15.5' width='11.5' title='Choose the department.'/>
                </td><td style='width:20%'><span id='deptIDError' style='color:red;' ></span></td>
		    <tr class=noborder >
		        <td></td><td><input type='submit' value='Submit'></td>
		    </tr>
            </table>
            </form>
            <strong>OR</strong><br/>
            <h3>
                <a style='text-decoration:none;' href=itemDept.php?all=true>Issue Details of All Departments</a>
            </h3>
            </div>";
	    return $form;
    }

    function onItemIssuedToDeptFormSubmit()
    {
        $deptID = $_POST['deptID'];
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstDept($deptID);
//        echo "<pre>";var_dump($row);echo "</pre>";
        if(empty($row) || is_null($row))
        {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>This department has not been issued any items yet.</h3>
                    </div>";
        }
        $table = "<div style='padding:20px; text-align:center;'>
        <filter></filter>
                <h2>Items issued to a Department</h2>
                <h3>Department ID : $deptID <h3/>
                <h3>Department Name : ".ucwords($row[0]['name'])."</h3>
                <br/><br/>
                <table align='center'>
                <tr align=center class=noborder >
                    <td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                </tr>";
        foreach($row as $value)
        {
            if(is_null($value))
                break;
            $table .= "<tr align=center>
                        <td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
            if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $table .= $value['issue_date']."</td>";
            }
            else {
                $table .= "N/A</td>";
            }
        }
        $table .= "</table>
        <br/><a href='issueReport.php?report=issueDetailsDepartment&deptID=$deptID'><button>Download</button></a>
            <button onclick='printPage()'>Print</button>
            </div>";
        return $table;
    }

    function displayIssueDetailsOfAllDepartments()
    {
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getItemsIssuedAgainstAllDepts();
        if(empty($row) || is_null($row))
        {
            return "<div style='padding:20px; text-align:center;'>
                        <h3>No department has been issued any items yet.</h3>
                    </div>";
        }
        $table = "<div style='padding:20px; text-align:center;'><br/>
            <filter></filter>
        <h2>Items issued to Departments</h2>
                <table align='center' class=report>
                <tr align=center class=noborder>
                    <td><strong>Department ID</strong></td><td><strong>Department Name</strong></td><td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                </tr>";
                $i=0;
        foreach($row as $value)
        {
            
            if(is_null($value))
                break;
            $table .= "<tr align=center id=".++$i.">
                    <td>".$value['department_id']."</td><td>".ucwords($value['name'])."</td><td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
           if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                $table .= $value['issue_date']."</td>";
            }
            else {
                $table .= "N/A</td>";
            }
        }
        $table .= "</table>
        <br/><a href='issueReport.php?report=issueDetailsAllDepartments'><button>Download</button></a>
            <button onclick='printPage()'>Print</button>
            </div>";
        return $table;
    }

    function getIssueDetailsForm()
    {
        $catControllerObj = new CategoryController();
        $categories = $catControllerObj->getAllCategories();
        $itemControllerObj = new ItemController();
        $items = $itemControllerObj->getAllItemData();
	    $form = "<div style='padding:20px; text-align:center;'>
                <h1>Issue Details</h1>
			    <form action='' method='post' onsubmit='return validateGetIssueDetailsForm(this)' >
			    <table align='center' style='width:50%'>
			    <tr class=noborder >
			        <td style='width:40%'>Choose Item </td>
                    <td style='width:40%'>
                            <select name='itemID' >
                                <option value='select'>--SELECT ITEM--</option>";
        for($i = 0; $i < sizeof($items); $i++)
		{
			$form=$form."<option value='".$items[$i]."'>".ucwords($items[++$i])."</option>";
		}

        $form .= "</select><img src='images/help.png' height='15.5' width='11.5' title='Choose an item.'/>
                </td><td style='width:20%'><span id='itemIDError' style='color:red;' ></span></td></tr>
                <tr><td></td><td><strong>OR</strong></td></tr>
                <tr>
			        <td style='width:40%'>Choose Category </td>
                    <td style='width:40%'>
                            <select name='categoryID' >
                                <option value='select'>--SELECT CATEGORY--</option>";
        foreach($categories as $value)
        {
            $form .= "<option value='".$value['category_id']."'>".ucwords($value['name'])."</option>";
        }

        $form .= "</select><img src='images/help.png' height='15.5' width='11.5' title='Choose the category.'/>
                </td><td style='width:20%'><span id='categoryIDError' style='color:red;' ></span></td></tr>
                <tr><td></td><td><strong>OR</strong></td></tr>
                <tr>
			        <td style='width:40%'>Choose Date </td>
                    <td style='width:40%'>
                            <select name='day' >
                                <option value='select'>--SELECT DAY--</option>";
        for($i=1; $i<32; $i++)
        {
            $form .= "<option value='".$i."'>".$i."</option>";
        }
		
        $form .= "</select>
                <select name='month' onchange = validateDropdown(this,'deptIDError') >
                    <option value='select'>--SELECT MONTH--</option>";
        for($i=1; $i<13; $i++)
        {
            $form .= "<option value='".$i."'>".$i."</option>";
        }
        $form .= "</select>
                    <select name='year' onchange = validateDropdown(this,'deptIDError') >
                    <option value='select'>--SELECT YEAR--</option>";
        for($i=2010; $i<=date("Y"); $i++)
        {
            $form .= "<option value='".$i."'>".$i."</option>";
        }
        $form .= "</select></td><td style='width:20%'><span id='dateError' style='color:red;' ></span></td>";
        $form .= "<tr class=noborder >
		        <td></td><td><input type='submit' value='Submit'></td>
		    </tr>
            </table>
            </form>
            </div>";
	    return $form;
    }

    function onGetIssueDetailsFormSubmit()
    {
        $itemID = $_POST['itemID'];
        $categoryID = $_POST['categoryID'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        if($itemID == 'select')
            $itemID = NULL;
        if($categoryID == 'select')
            $categoryID = NULL;
        if($day == 'select')
            $day = NULL;
        if($month == 'select')
            $month = NULL;
        if($year == 'select')
            $year = NULL;
        $stockControllerObj = new StockController();
        $row = $stockControllerObj->getIssueDetails($itemID, $categoryID, $day, $month, $year, "department");
        $firstRow = $row;
        $table = "";
//        echo "<pre>";var_dump($row);echo "</pre>";
        if(empty($row) || is_null($row))
        {
            $table .= "<div style='padding:20px; text-align:center;'>
                        <h3>No department has been issued any items with the provided combination.</h3>
                    </div>";
        }
        else {
            $table .= "<div style='padding:20px; text-align:center;'><br/>
            <filter></filter>
            <h2>Items issued to Departments</h2>
                    <table align='center' >
                    <tr align=center class=noborder>
                        <td><strong>Department ID</strong></td><td><strong>Department Name</strong></td><td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                    </tr>";
            foreach($row as $value)
            {
                if(is_null($value))
                    break;
                $table .= "<tr align=center >
                        <td>".$value['department_id']."</td><td>".ucwords($value['name'])."</td><td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
               if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                    $table .= $value['issue_date']."</td></tr>";
                }
                else {
                    $table .= "N/A</td></tr>";
                }
            }
            $table .= "</table>";
        }
        $row = $stockControllerObj->getIssueDetails($itemID, $categoryID, $day, $month, $year, "student");
        if(empty($row) || is_null($row))
        {
            $table .= "<h3>No students have been issued any items with the provided combination.</h3>";
        }
        else {
            $table .= "<h2>Items issued to Students</h2>
                    <table align='center'>
                    
                    <tr align=center class=noborder >
                        <td><strong>Student ID</strong></td><td><strong>Student Name</strong></td><td><strong>Item ID</strong></td><td><strong>Item Name</strong></td><td><strong>Quantity</strong></td><td><strong>Issue Date</strong></td>
                    </tr>";
            foreach($row as $value)
            {
                if(is_null($value))
                    break;
                $table .= "<tr align=center>
                        <td>".$value['student_id']."</td><td>".ucwords($value['name'])."</td><td>".$value['item_id']."</td><td>".ucwords($value['name_brand'])."</td><td>".$value['quantity']."</td><td>";
               if(!empty($value['issue_date']) && !is_null($value['issue_date'])) {
                    $table .= $value['issue_date']."</td></tr>";
                }
                else {
                    $table .= "N/A</td></tr>";
                }
            }
            $table .= "</table>";
        }
        if((!empty($firstRow) && !is_null($firstRow)) || (!empty($row) && !is_null($row)))
            $table .= "<br/><a href='issueReport.php?report=issueDetailsMixed&itemID=$itemID&categoryID=$categoryID&day=$day&month=$month&year=$year'><button>Download</button></a>
                    <button onclick='printPage()'>Print</button>
            </div>";
        else
            $table .= "</div>";
        return $table;
    }
}
?>