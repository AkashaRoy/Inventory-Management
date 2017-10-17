<script src="import1.js" type="text/javascript"></script>
<style type='text/css'></style>
<?php
        session_start();
       /* if(isset($_SESSION['errMsg']))
        {  
		    echo "</br></br></br><h3 align='center'><font color='red'>".$_SESSION['errMsg']."</font></h3>";
            unset($_SESSION['errMsg']);
           
          
        }*/
		include_once 'template.php';
		
        include_once 'POUI.php';
        include_once 'POController.php';
        include_once 'POModel.php';
        include_once 'IndentController.php';
        include_once 'IndentModel.php';
        include_once 'ItemController.php';
        include_once 'ItemModel.php';
        include_once 'CategoryController.php';
        include_once 'CategoryModel.php';
        include_once 'VendorController.php';
        include_once 'VendorModel.php';
        include_once 'DepartmentController.php';
        include_once 'DepartmentModel.php';
        $obj=new POUI();
        if(!empty($_SESSION['errMsg']) && isset($_SESSION['errMsg']))
        {
            
            //echo "</br></br></br><h3 align='center'><font color='red'>".$_SESSION['errMsg']."</font></h3>";
            unset($_SESSION['errMsg']);
        }
        if(isset($_GET) && !empty($_GET))
        {
            if(isset($_GET['place_order']) && !empty($_GET['place_order']))
            {
                /*echo "category id";
                var_dump($_GET['category_id']);
                echo "category name";
                var_dump($_GET['category_name']);
                echo "Item_Id list";
                var_dump($_GET['item_id_list']);
                echo "Amount";
                var_dump($_GET['Amount']);
                echo "Vendor id";
                var_dump($_GET['VendorList']);
                 */
        //var_dump($_GET['expected_date']);
               if(isset($_GET['category_id']) && !empty($_GET['category_id']) && isset($_GET['category_name']) && !empty($_GET['category_name']) && isset($_GET['item_id_list']) && !empty($_GET['item_id_list']) && isset($_GET['Amount']) && !empty($_GET['Amount']) && isset($_GET['VendorList']) && !empty($_GET['VendorList']) && isset($_GET['expected_date']) && !empty($_GET['expected_date']))
			   {
			    
                echo $obj->displayCreatedPurchaseOrder($_GET['category_id'],$_GET['category_name'],$_GET['item_id_list'],$_GET['Amount'],$_GET['VendorList'],$_GET['expected_date']);
				}
				else
				{
				echo "<script type='text/javascript'> alert('The mandatory fields are not filled.Kindly fill in the necessary data to place a purchase order');</script>";    
                //$_SESSION['errMsg']="The mandatory fields are not filled!Kindly try again!";
				echo $obj->createPurchaseOrderEntry();
				}
				
            }
            else if(isset($_GET['backFromCreatePurchaseOrder']) && !empty($_GET['backFromCreatePurchaseOrder']))
            {
            echo $obj->createPurchaseOrder();    
            }
            else if(isset ($_GET['searchStatusButton']) && !empty($_GET['searchStatusButton']))
            {
                if(isset($_GET['statusPO']) && !empty($_GET['statusPO']))
                {$res=$obj->searchByStatus($_GET['statusPO']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the status');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }
            }
            else if(isset ($_GET['searchYearButton']) && !empty($_GET['searchYearButton']))
            {
                if(isset($_GET['YearPO']) && !empty($_GET['YearPO']))
                {
                    
                    $res=$obj->searchByYear($_GET['YearPO']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the year');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }
            }
             else if(isset ($_GET['searchMonthButton']) && !empty($_GET['searchMonthButton']))
            {
                if(isset($_GET['MonthPO']) && !empty($_GET['MonthPO']))
                {
                    $res=$obj->searchByMonth($_GET['MonthPO']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the month');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }
            }
             else if(isset ($_GET['searchDateButton']) && !empty($_GET['searchDateButton']))
            {
                if(isset($_GET['year']) && !empty($_GET['year']) && isset($_GET['month']) && !empty($_GET['month']) && isset($_GET['day']) && !empty($_GET['day']))
                {
                    $res=$obj->searchByDate($_GET['year'],$_GET['month'],$_GET['day']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the date');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }
            }
             else if(isset ($_GET['searchCategoryButton']) && !empty($_GET['searchCategoryButton']))
            {
                if(isset($_GET['CategoryPO']) && !empty($_GET['CategoryPO']))
                {
                    $res=$obj->searchByCategory($_GET['CategoryPO']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the category');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }
            }
            else if(isset ($_GET['searchItemButton']) && !empty($_GET['searchItemButton']))
            {
                if(isset($_GET['ItemPO']) && !empty($_GET['ItemPO']))
                {$res=$obj->searchByItem($_GET['ItemPO']);
                    if($res==FALSE)
                    {
                        echo "<script type='text/javascript'> alert('There are no Purchase Order details to be displayed corresponding to the item');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    echo $res;
                }                    
                
            }
            else if(isset($_GET['searchIndentButton'])&&!empty ($_GET['searchIndentButton']))
            {
                if(isset($_GET['Indentid']) && !empty($_GET['Indentid']))
                {
                    $res=$obj->searchByIndentIdCheck($_GET['Indentid']);
                    if($res==false)
                    {
                        echo "<script type='text/javascript'> alert('Indent Id you are searching for is unavailable in the database records.Kindly enter a valid Purchase Order Id');</script>";    
                        echo $obj->getDetails();
                    }
                    else
                    {
                        
                        echo $res;
                    }
                }
                else
                {
                     echo "<script type='text/javascript'> alert('Indent Id you are searching for is unavailable in the database records.Kindly enter a valid Purchase Order Id');</script>";    
                        echo $obj->getDetails();
                }
                    
            }
            else if(isset($_GET['searchPurchaseOrderButton']) && !empty ($_GET['searchPurchaseOrderButton']))
            {
                if(isset($_GET['Pid']) && !empty($_GET['Pid']))
                {   $res=$obj->searchByPurchaseOrderCheck ($_GET['Pid']);
                if($res==false)
                {
              echo "<script type='text/javascript'> alert('Purchase Order you are searching for is unavailable in the database records.Kindly enter a valid Purchase Order Id');</script>";    
              echo $obj->getDetails();
                }
                else
                {
                    echo $res;
                }
            }
            else
            {
                 echo "<script type='text/javascript'> alert('Purchase Order you are searching for is unavailable in the database records.Kindly enter a valid Purchase Order Id');</script>";    
                        echo $obj->getDetails();
            }
            
            }
            else if(isset($_GET['searchVendorNameButton']) && !empty ($_GET['searchVendorNameButton']))
            {
                if (isset($_GET['Vname']) && !empty($_GET['Vname']))
                $res=$obj->searchByVendorName($_GET['Vname']);
                if($res==false)
                {
                     echo "<script type='text/javascript'> alert('No purchase orders have been given to the selected vendor.Kindly select another vendor.');</script>";    
                     echo $obj->getDetails();
                }
                else
                {
                    echo $res;
                }
                
            }
             else if(isset($_GET['proceed']) && !empty ($_GET['proceed']))
            {
                if(isset($_GET['indentId']) && !empty($_GET['indentId']))
                {
                   
               $res=$obj->checkValidIndentId($_GET['indentId']);
              if($res==false)
              {
              echo "<script type='text/javascript'> alert('Purchase Orders cannot be create against the given indent because either the indent status is approved or else it is cancelled');</script>";    
              echo $obj->createPurchaseOrder();
              }
              else
                    
                    
              echo $obj->createPOForIndent($_GET['indentId']);
                }
                else if(isset($_GET['IndentIdPending']) && !empty($_GET['IndentIdPending']))
                {
                   
                echo $obj->createPOForIndent($_GET['IndentIdPending']);
                }
            }
            else if(isset($_GET['proceedWithCancel']) && !empty ($_GET['proceedWithCancel']))
            {
                
                if(isset($_GET['indentIdCancel']) && !empty($_GET['indentIdCancel']))
                {
                        
               $res=$obj->checkValidIndentIdForCancellation($_GET['indentIdCancel']);
    
               if($res==false)
               {
                 echo "<script type='text/javascript'> alert('Purchase Orders cannot be cancelled against the given indent because the indent may not have any purchase orders to be cancelled ');</script>";
                 echo $obj->cancelPurchaseOrder();
               }
              else
              {
                    $_SESSION['selectedIndentIdCancel']=$_GET['indentIdCancel'];
                    echo $obj->cancelPurchaseOrderDisplay($_GET['indentIdCancel']);
                }
                }
                else if(isset($_GET['IndentIdCancelDropDown']) && !empty($_GET['IndentIdCancelDropDown']))
                {
                    
                    $res=$obj->checkValidIndentIdForCancellation($_GET['IndentIdCancelDropDown']);
    
                   if($res==false)
                   {
                      echo "<script type='text/javascript'> alert('Purchase Orders cannot be cancelled against the given indent because the indent may not have any purchase orders to be cancelled');</script>";
                      echo $obj->cancelPurchaseOrder();
                    }
                   else
                   {
                        $_SESSION['selectedIndentIdCancel']=$_GET['IndentIdCancelDropDown'];
                       echo $obj->cancelPurchaseOrderDisplay($_GET['IndentIdCancelDropDown']);
                    }
                }
            }
            else if(isset($_GET['createPurchaseOrder']) && !empty ($_GET['createPurchaseOrder']))
            {
                echo $obj->createPurchaseOrderEntry();
            }
            else if(isset ($_GET['id']) && !empty($_GET['id']))
            {
             if($_GET['id']==1)
            {             
                echo $obj->createPurchaseOrder();
            }
            else if($_GET['id']==2)
            {
                //echo "<br>cancel purchase order</br>";
                echo $obj->cancelPurchaseOrder();
            }
            else if($_GET['id']==3)
            {
                
                echo $obj->getDetails();
            }
            else if($_GET['id']==4)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                echo $obj->displayPurchaseOrderDetails($_GET['code']);
            }
             else if($_GET['id']==5)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                echo $obj->displayVendorDetails($_GET['code']);
            }
            else if($_GET['id']==6)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                {
                    
                echo $obj->displayItemDetails ($_GET['code']);
                }
            }
            else if($_GET['id']==7)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                echo $obj->displayDepartmentDetails ($_GET['code']);
            }
             else if($_GET['id']==8)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                echo $obj->displayIndentDetails ($_GET['code']);
            }
             else if($_GET['id']==9)
            {
                if(isset($_GET['code']) && !empty($_GET['code']))
                echo $obj->displayCategoryDetails($_GET['code']);
            }
			else if($_GET['id']==10)
			{
			echo $obj->displayHelp();
			}
            }
            else if(isset($_GET['cancelPOId']) && !empty ($_GET['cancelPOId']))
            {
                
               
                echo $obj->cancelPurchaseOrderDisplay($_SESSION['selectedIndentIdCancel'],$_GET['cancelPOId']);
            }
           
        }
        else
        {
            
            echo "</br></br></br></br></br><h3 align=center><font color='black'>Welcome to Home Page</font></h3>
                  <font color='black' size=5>Guidelines For Use</b></font> 
				<h4 align=center><font  color='red'>* </font><font color='black'>Create Purchase Order : option to create purchase orders against indents that are pending</font></h4>
				<h4 align=center><font  color=red>* </font><font color=black>Cancel Purchase Order : option to cancel existing purchase orders against indents</font></h4>
				<h4 align=center><font  color=red >* </font><font color=black>Search : option to search for purchase orders provided the user knows the purchase order id or the vendor</font></h4> ";
        }
           
	include_once 'footer.php';
?>