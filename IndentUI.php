<?php
include_once 'IndentController.php';
class IndentUI
{    
	function getIndentDetailsForReport()
	{
		$para =  func_get_args();
        $obj=new IndentController();
        return $obj->getDataForReport($para[0],$para[1]);
	}
    function viewData()
	{
	   $args=func_get_args();
	   $obj=new IndentController();
	   $temp=$obj->showIndentDetails($args[0]);
	   
			$obj2=new DepartmentController();
			$dept=$obj2->fetchDepartmentData($temp[1]);
			$obj3=new ItemController();
			
			$existing_item;
			$qty;
			$item=0;
			$count=0;
			$res="";
			
			for($i=5,$j=7;$i<count($temp);$i+=5,$j+=5)
			{
				$name=$obj3->getAllItemData($temp[$i]);
				$existing_item[$count]=$name[0];
				$qty[$count]=$temp[$j];
				$count++;
			}
			$res.= "<h3 align='center'>Details of Indent</h3>
				</br></br></br><table cellspacing=10 align=center cellpadding=8 >	
				<tr><td colspan=2>Indent ID  :</td><td colspan=4>".$temp[0]."</td></tr>
				<tr><td colspan=2>Department :</td><td colspan=4>".$dept[0]."</td></tr>			
				<tr><td colspan=2>Raise date :</td><td colspan=4>".$temp[2]."</td></tr>";
            $res .= "</td></tr>			
				<tr><td colspan=2>Raise date :</td><td colspan=4>".$temp[2]."</td></tr>";
                        if($temp[3]=='pending')
				$res.="<tr><td colspan=2>Indent status :</td><td colspan=4>".$temp[3]."</td></tr>";
                        if($temp[3]=='cancelled')
				$res.="<tr><td colspan=2>Indent status :</td><td colspan=4><font color=red>".$temp[3]."</font></td></tr>";
                        if($temp[3]=='approved')
				$res.="<tr><td colspan=2>Indent status :</td><td colspan=4><font color=green>".$temp[3]."</font></td></tr>";
			for($i=0,$j=8;$i<$count;$i++,$j+=5)
			{
				$res.= "<tr><td>Item :</td><td>".$existing_item[$i]."</td><td><font color=black>Quantity:</font></td><td>".$qty[$i];
                                if($temp[$j]=='cancelled')
                                       $res.="</td><td><font color=black>Status:</font></td><td><font color='red'>".$temp[$j]."</font></td></tr>";
                                if($temp[$j]=='pending')
                                       $res.="</td><td><font color=black>Status:</font></td><td>".$temp[$j]."</td></tr>";
                                if($temp[$j]=='approved')
                                       $res.="</td><td><font color=black>Status:</font></td><td><font color='green'>".$temp[$j]."</font></td></tr>"; 
                        }
			if($args[1]==1)
			{
				$res.= "</table>
				<br><br><br><p><font color='black'>Do you want to raise another indent?</font></p></font>
												<div align='center'>
												
											 <a href=indent_index.php?id=1><button>Yes</button></a>
                                                                                         
											 <a href=index.php><button>No</button></a>
											<br><br><br><br><br>";
				return $res;

			}
		    if($args[1]==2)
			{
				$res.="</table></br></br></br><p><font color='black'>
					Do you want to update another indent ??
					<div align='center'>
					
					 <a href=indent_index.php?id=2><button>Yes</button></a>
					<a href=index.php><button>No</button></a>
					<br><br><br><br><br>";
				return $res;

			}
			if($args[1]==3)
			{
                            if($temp[3]=='cancelled')
                            {
                                $res.="</table><br><font color=black>This indent has already been cancelled and hence cannot be updated</font> 
                                        <div align='center'>
						
						 <a  href=indent_index.php?id=5><button>Search</button></a>
                                                <br><br><br><br><br></div>";
                                return $res;
                            }
                            if($temp[3]=='approved')
                            {
                                $res.="</table><br><font color=black>This indent has already been approved and hence cannot be updated</font>
                                        <div align='center'>
						
						 <a  href=indent_index.php?id=5><button>Search</button></a>
                                                <br><br><br><br><br></div>";
                                return $res;
                            }
                            else
                            {
                                $res.="</table></br></br></br><p><font color='black'>
						
						<div align='center'>
						
						 <a href=indent_index.php?id=5><button>Search</button></a>
						 <a href='indent_index.php?id=7&indent=".$args[0]."'><button>Update</button></a></div>
					    ";
				return $res;
                            }
			}			
				
	}
	function showCreateIndentForm()
	{
		$obj=new DepartmentController();
		$arr=$obj->fetchDepartmentData();
		$obj1=new ItemController();
		$result=$obj1->getALLItemData();
		$dept=0;
		$item=" ";
		for($i=0;$i<count($result);$i++)
		{ 
			$item=$item."<option value=".$result[$i].">".$result[++$i]."</option>";
		}
		for($i=0;$i<count($arr);$i+=2)
		{
			$dept=$dept."<option value=".$arr[$i].">".$arr[$i+1]."</option>";
		}
	
		$form='';
		$form="<h1 align=center><font color=black>&nbsp&nbsp  Indent Creation Form  &nbsp&nbsp</font></h1>
		</br></br><font color=black size=5><b><i>All<font color=red>*</font> fields are mandatory</b></i></font>
		<form action='' method='post' name='create_indent' onsubmit='return checkIndent()'>
		
		 <table align=center cellspacing='10'>
		 <tr><td>Select Department<font color=red>*</font> :</td><td>
		 <select name='dept'><option value='0'>-select-</option>".$dept."</select>&nbsp<img src='24.jpg' title='Select a Department' height=13 width=15></td></tr>
		 <tr><td>Date :</td><td><input type='text' value=".date("Y-m-d")." size='10' name=date disabled=disabled>&nbsp<img src='24.jpg' title='You cannot change this field' height=13 width=15></td></tr>
		 <tr><td>Select Item 1<font color=red>*</font>:</td><td align='left'><select name='item1' id='item1'><option value='0'>-none-</option>".$item."</select></td>
		 <tr><td>Enter Quantity of Item 1<font color=red>*</font>:</td><td><input type='text' maxlength='5' name='quantity1'  size='3' value='0' onclick='resetAddFields(this)'><span style='color:Red;' id='Q1'> </span></td>
		 <tr><td>Select Item 2<font color=red>*</font>:</td><td align='left'><select name='item2' id='item2'><option value='0'>-none-</option>".$item."</select></td>
		 <tr><td>Enter Quantity of Item 2<font color=red>*</font>:</td><td><input type='text' maxlength='5' name='quantity2'  size='3' value='0' onclick='resetAddFields(this)'><span style='color:Red;' id='Q2'> </span></td>
		 <tr><td>Select Item 3<font color=red>*</font>:</td><td align='left'><select name='item3' id='item3'><option value='0'>-none-</option>".$item."</select></td>
		 <tr><td>Enter Quantity of Item 3<font color=red>*</font>:</td><td><input type='text' maxlength='5' name='quantity3'  size='3' value='0' onclick='resetAddFields(this)'><span style='color:Red;' id='Q3'> </span></td>
		 <tr><td>Select Item 4<font color=red>*</font>:</td><td align='left'><select name='item4' id='item4'><option value='0'>-none-</option>".$item."</select></td>
		 <tr><td>Enter Quantity of Item 4<font color=red>*</font>:</td><td><input type='text' maxlength='5' name='quantity4'  size='3' value='0' onclick='resetAddFields(this)'><span style='color:Red;' id='Q4'> </span></td>
		 <tr><td>Status :</td><td><input type='text' maxlength='15' value='pending' disabled='disabled'>&nbsp<img src='24.jpg' title='The status cannot be changed' height=13 width=15></td></tr>
		 <tr><td></td><td><input type='submit' value='raise indent'><input type='reset' value='reset'></td></tr>
		 </table>
		 </form>";
		return $form;
	}
	
	function updateForm()
	{
		$obj=new IndentController();
        $temp=$obj->fetchIndentList();
             
		$form='';
		$form.="<form name='updateForm' action='' method='post' onsubmit='return validate()'>
		<br><br>
		<h3 align=center><font color=black>Update Indent Form</font></h3>
		<table align=center>	
		<tr><td>Enter Indent ID :</td><td><select name='id'><option>-select-</option>";
                    $res=count($temp);
                    for($i=0;$i<$res;$i+=4)
                    {
						$result=$obj->getIndentIdForUpdateIndentForm($temp[$i]);
						if($result==true)
                       $form.="<option>".$temp[$i]."</option>";  
                    }
              
             
		$form.="</select><img src='24.jpg' title='Enter the id of the indent that you wish to update.It is the number that was assigned when the indent was placed' height=13 width=15></td>
		<td><span style='color:Red;' id='Error'></span></td></tr>
		<tr><td></td><td><input type='submit' value='update'>
		<input type='reset' value='Reset'></td></tr>
		</table>";
		return $form;
	}
	function detailForm()
	{
	   $form='';
		$form="<form name='updateForm' action='' method='post' onsubmit='return validate()'>
		<br><br>
		<h3 align=center><font color=black>Indent Details form</font></h3>
		<table align=center>	
		<tr><td>Enter Indent ID :</td><td><input type='text' name='id' maxlength='5'></td>
		<td><img src='24.jpg' title='Enter the id of the indent whose details you need.It is the number that was assigned when the indent was placed' height=13 width=15></td>
		<td><span style='color:Red;' id='Error'></span></td></tr>
		<tr><td></td><td><input type='submit' value='submit'>
		<input type='reset' value='Reset'></td></tr>
		</table>";
		return $form;
	}
	function showUpdateIndentForm()
	{
		$arg=func_get_args();
		$id=$arg[0];
		{
			$obj1=new ItemController();
			$result=$obj1->getALLItemData();
			$obj=new IndentController();
			$arr=$obj->fetchIndentList($id);
			
			$existing_item;
			$qty;
			$item[0]="";
			$item[1]="";
			$item[2]="";
			$item[3]="";
			$count=0;
			
			$obj2=new DepartmentController();
			$dept=$obj2->fetchDepartmentData($arr[1]);
			
			for($i=5,$j=7;$i<count($arr);$i+=5,$j+=5)
			{
				$name=$obj1->getAllItemData($arr[$i]);
				$existing_item[$count]=$name[0];
				$qty[$count]=$arr[$j];
				$count++;
			}
			if($count<4)
			{
				while($count<=4)
				{
					$qty[$count]=0;
					$existing_item[$count]="none";
					$count++;
				}
			}
			for($j=0;$j<4;$j++)
			{
				for($i=0;$i<count($result);$i++)
				{
					if($existing_item[$j]==$result[$i+1])
					{
						$item[$j] = $item[$j]."<option value=".$result[$i]." selected='selected'>".$result[++$i]."</option>";
					}
					else
					{
						$item[$j] = $item[$j]."<option value=".$result[$i].">".$result[++$i]."</option>";
					}
				}
			}
			
			$form='';
			$form= "</br></br></br><form action='' method='post' name='update_indent' onsubmit='return validateUpdateIndent()'>
                                <h3 align='center'>Update Indent Form</h3>
				<table align='center' cellspacing=10>
				<tr><td>Indent ID :</td><td><input type='text' disabled='disabled' value='".$id."' size='5'></td></tr>
				<tr><td>Department :</td><td><input type='text' disabled='disabled' value='".$dept[0]."'></td></tr>
				<tr><td>Raised date :</td><td><input type='text' disabled='disabled' value='".$arr[2]."' size='10'></td></tr>
				<tr><td>Update date :</td><td><input type='text' disabled='disabled' value=".date("Y-m-d")." size='10'></td></tr>
				<tr><td></td><td align=center><font color=black>Existing Indent Data</font></td><td align=center><font color=black>Enter new data below</font></td>
				<tr><td align='right'>Item 1:</td><td><input type='text' disabled='disabled' value='".$existing_item[0]."'></td><td><select name='item1'><option value='0'>none</option>".$item[0]."</select></td></tr>
				<tr><td align='right'>Quantity :</td><td><input type='text' disabled='disabled' value='".$qty[0]."'></td><td><input type='text' name='quantity1' value=".$qty[0]." size='3'><span style='color:Red;' id='Q1'> </span></td></tr>
				
				<tr><td align='right'>Item 2:</td><td><input type='text' disabled='disabled' value='".$existing_item[1]."'></td><td><select name='item2'><option value='0'>none</option>".$item[1]."</select></td></tr>
				<tr><td align='right'>Quantity :</td><td><input type='text' disabled='disabled' value='".$qty[1]."'></td><td><input type='text' name='quantity2' value=".$qty[1]." size='3'><span style='color:Red;' id='Q2'> </span></td></tr>
				
				<tr><td align='right'>Item 3:</td><td><input type='text' disabled='disabled' value='".$existing_item[2]."'></td><td><select name='item3'><option value='0'>none</option>".$item[2]."</select></td></tr>
				<tr><td align='right'>Quantity :</td><td><input type='text' disabled='disabled' value='".$qty[2]."'></td><td><input type='text' name='quantity3' value=".$qty[2]." size='3'><span style='color:Red;' id='Q3'> </span></td></tr>
				
				<tr><td align='right'>Item 4:</td><td><input type='text' disabled='disabled' value='".$existing_item[3]."'></td><td><select name='item4'><option value='0'>none</option>".$item[3]."</select></td></tr>
				<tr><td align='right'>Quantity :</td><td><input type='text' disabled='disabled' value='".$qty[3]."'></td><td><input type='text' name='quantity4' value=".$qty[3]." size='3'><span style='color:Red;' id='Q4'> </span></td></tr>
				
				<tr><td>Status :</td><td><select name='status'><option value='1'>pending</option>
								<option value='0'>cancelled</option></select></td></tr>
				<tr><td></td><td><input type='submit' value='update'></td></tr>
				</table></form>";

			return($form);
		}
		
	}
	function addIndent()
	{
		
                $x="0";
		$args=func_get_args();
		$obj=new IndentController();
		$id=$obj->checkIndentDetails($args[0],$args[1],$args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8]);
		if($id)
		{
            return $id;	  
		}
		else 
		   return $x;
		
	}
	function updateIndent()
	{
		$args=func_get_args();
		$obj=new IndentController();
		$id=$obj->updateIndentDetils($args[0],$args[1],$args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8], $args[9]);
        return $id;
		
	}
	function showHelp()
	{
	   $help="  <h3 align='center'><font color=black><b>STEP BY STEP INSTRUCTION MANUAL</font></h3>
                         <table cellpadding=10>
			 <tr><td><font color=black size=5>Raise Indent</font></td></tr><tr></tr>
			 <tr bgcolor=grey><td><font color=black>1.To raise an indent,click here</td></tr><tr><td align=center><img src='indent/raise1.png' align='center'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>2.The following page appears after clicking on 'Raise Indent'</td></tr><tr><td><img src='indent/raise2.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>3.After submission the following page appears</td></tr><tr><td align='center'><img src='indent/raise4.png'></td></tr><tr></tr>
			 <br><br>
			 <tr><td><h3 align=left><font color=black>Update Indent</font></h3></td></tr>
			
			 <tr bgcolor=grey><td>4.To change the details of an indent , click on the following tab</td></tr><tr><td align='center'><img src='indent/update1.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>5.After clicking the 'Update Indent' tab the following page appears</td></tr><tr><td align='center'><img src='indent/update2.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>6.The following page appears if the indent id is invalid</td></tr><tr><td><img src='indent/update3.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>7.The following page appears if the indent id is valid but the indent with that id does not exist</td></tr><tr><td><img src='indent/update4.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>8.If the indent exists then the following page appears.Follow the instructions and proceed</td></tr><tr><td><img src='indent/update5.png'></td></tr><tr><td><hr color='black' align=center shade='black'></td></tr><tr><td><img src='indent/update6.png'></td></tr>
			 <tr><td><hr color='black' align=center height=2></td></tr>
		
			 <tr><td><h3 align=left><font color=black>Get Indent Details</font></h3></td></tr>

			 <tr bgcolor=grey><td>9.To view the details of an indent click on this tab</td></tr><tr><td align='center'><img src='indent/details1.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>10.The following page appears after clicking on the tab.Follow instructions and proceed.</td></tr><tr><td align='center'><img src='indent/details2.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>11.If the indent id is valid but the indent does not exixt,then the following page appears</td></tr><tr><td align='center'><img src='indent/details3.png'></td></tr><tr></tr>
			 <tr bgcolor=grey><td>11.If the indent id is valid and the indent exixts,then the following page appears</td></tr><tr><td align='center'><img src='indent/details4.png'></td></tr><tr></tr>
			
			  <tr><td><hr color='black' align=center height=2></td></tr>
			   <tr><td><hr color='black' align=center height=2></td></tr>
			  </table>";
	   return $help;
	}
	function searchForm()
	{
	   $_SESSION['search']="exists";
	   $obj=new DepartmentController();
	   $dep=$obj->fetchDepartmentData();
		
		$search="
			 <script src='import.js' type='text/javascript'>
			 </script>
			  
		  
		  <body align='center'>
		  <h3>Search an Indent</h3>
                  <br/>
				  
		  <table align='center'>
		  <tr><td>Search by :
		  <select id='search' onChange='return showForm1(this)'>
			   <option>--SELECT--</option>
			   <option>Indent Id</option>
			   <option>Department</option>
			   <option>Date</option>
			   <option>Month</option>
			   <option>Year</option>
			   <option>Item</option>
			   <option>Status</option>
			   <option>Category</option>
			</select></td></tr>
			
			
		
			<tr id='IdForm' style='display:none'>
			<form action='' method='post' name='PForm' onSubmit='return checkInput1(3)'>
			<td>Enter Indent id : </td><td><input type=text name='Pid' id='Pid'></td>
			<tr id='def1' style='display:none'><td></td><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
			</form>
		
			
		
			<tr id='DepForm' style='display:none' >
			<form action='indent_index.php' method='post' onSubmit='return checkInput1(1);' name='VForm'>
			<td>Choose Department Name : </td><td><select id='Vname' name='Vname' ><option>--SELECT--</option>";
			 for($i=1;$i<count($dep);$i+=2)
			 {
				$search.="<option value=".$dep[$i-1].">".$dep[$i]."</option>";
			 }
			$search.="</select></td><tr id='def2' style='display:none'><td></td><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
			</form>
		
			<!-- <table class='ds_box' cellpadding='0' cellspacing='0' id='ds_conclass' style='display: none;'>
			<tr><td id='ds_calclass'>
			</td></tr>
		   </table>-->
		   
			<tr id='DateForm' style='display:none' align='center'>
					<form action='' method='post' name='DForm' onSubmit='return checkInput1(2)'>
					<td align=center>Day:</td><td align=center><select name='day'><option>--SELECT--</option>";
					for($i=1;$i<32;$i++)
					{
					   $search.="<option>".$i."</option>";
					}
		              $search.="  </select></td><td align=center>Month:</td><td align=center><select name='month'><option>--SELECT--</option>";
					  for($i=01;$i<13;$i++)
					  {
					      $search.="<option>".$i."</option>";
					  }
		              $search.="</select></td><td>Year:</td><td align=center><select name='year'><option>--SELECT--</option>";
					  for($i=2013;$i<2050;$i++)
					  {
					      $search.='<option>'.$i.'</option>';
					  }
					  $search.="</select></td></tr>
					  <tr id='def3' style='display:none'><td></td><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
				      </form>
					  
					 
                    <tr id='MonthForm' style='display:none'>
					<form action='' method='post' name='MonthForm' onSubmit='return checkInput1(4)'>
					<td> Choose a month:</td><td><select name='month1'><option>--SELECT--</option>";
					
					$search.="<option value=01>Jan</option><option value=02>Feb</option><option value=03>Mar</option><option value=04>Apr</option>
                              <option value=05>May</option><option value=06>Jun</option><option value=07>Jul</option><option value=08>Aug</option>
                              <option value=09>Sep</option><option value=10>Oct</option><option value=11>Nov</option><option value=12>Dec</option>
                              </select></td></tr>
                              <tr id='def4' style='display:none'><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
                              </form>
							  
					<tr id='YearForm' style='display:none'>
					<form action='' method='post' name='YearForm' onSubmit='return checkInput1(5)'>
					<td>Choose a year:</td><td><select name='year1'><option>--SELECT--</option>";
                      for($i=2013;$i<2050;$i++)
					  {
					      $search.='<option>'.$i.'</option>';
					  }
					  $search.="</select></td></tr>
					  <tr id='def5' style='display:none'><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
				      </form>
					  ";
                                          
                    $search.="<tr id='StatusForm' style='display:none'>
								<form action='' method='post' name='StatusForm' onSubmit='return checkInput1(6)'>
                                 <td>Select status:</td><td><select name='search_status'><option>--SELECT--</option>
                                 <option>pending</option><option>cancelled</option><option>approved</option></select>
                                 </tr>
								 <tr id='def6' style='display:none'><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
                                 </form>";
                              $item=" ";
		$obj1=new ItemController();
		$result=$obj1->getALLItemData();
		for($i=0;$i<count($result);$i++)
		{ 
			$item=$item."<option value=".$result[$i].">".$result[++$i]."</option>";
		}
		$search.=" <tr id='ItemForm' style='display:none' > 
                        <form action='' method='post' name='ItemForm' onSubmit='return checkInput1(7)'>
				
				<td>Item Id : </td><td><select name='item'><option>--SELECT--</option>".$item."</select></td></tr>
				<tr id='def7' style='display:none'><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
				</form>";
                                           
		$dept="";
		$obj=new CategoryController();
		$arr=$obj->getAllCategories();
		$i=0;
		for($i=0;isset($arr[$i][0]);$i++)
		{
			$dept=$dept."<option value=".$arr[$i][0].">".$arr[$i][1]."</option>";
		}
		$search.="<tr id='CategoryForm' style='display:none' > 
                        <form action='' method='post' name='CategoryForm' onSubmit='return checkInput1(8)'>
				<td>Select Category : </td><td><select name='category'><option>--SELECT--</option>".$dept."</select></td>
				<tr id='def8' style='display:none'><td><input type=submit value='search'><input type='reset' value='clear'></td></tr>
				</table>";			
		            
		return $search;

	}
	
	function searchIndent() //error
	{
	    $args=func_get_args();
		$obj=new IndentController();
		if($args[1]==1)
		{
		  $temp=$obj->displayIndent($args[0],1);
		}
		if($args[1]==2)
		{
		   $temp=$obj->displayIndent($args[0],2);
		}
		if($args[1]==3)
		{
		   $temp=$obj->displayIndent($args[0],3);
		}
		if($args[1]==4)
		{
		   $temp=$obj->displayIndent($args[0],4);
		}
		return $temp;
	}
	function getDepartment()
	{
	   $args=func_get_args();
	   $obj=new DepartmentController();
	   $dep=$obj->fetchDepartmentData($args[0]);
	   return $dep;
	 }
    function showIndent()
	{
		$args=func_get_args();	
		{	
			$_SESSION['selected_indent_id']=$args[0];
			$row="";
			
			$obj=new IndentController();
			$temp=$obj->showIndentDetails($args[0]);
			if($temp)
			{
					$obj2=new DepartmentController();
					$dept=$obj2->fetchDepartmentData($temp[1]);
					
					$obj3=new ItemController();
					
			
					$existing_item;
					$qty;
					$i=0;
					$item=0;
					$count=0;
					$poid="";
					
					
					$ret= "</br></br></br><table cellspacing=10 align=center cellpadding=8 >	
						<tr><td><font color=black>Indent ID  :</font></td><td>".$args[0]."</td></tr>
						<tr><td><font color=black>Department :</font></td><td>".$dept[0]."</td></tr>			
						<tr><td><font color=black>Raise date :</font></td><td>".$temp[2]."</td></tr>
						<tr><td><font color=black>Indent status :</font></td><td>".$temp[3]."</td></tr>";
						
					
					for($i=5,$j=7;$i<count($temp);$i+=5,$j+=5)
					{
						$name=$obj3->getAllItemData($temp[$i]);
						$existing_item[$count]=$name[0];
						$qty[$count]=$temp[$j];
						$count++;
					}
					for($i=0,$j=8;$i<$count;$i++,$j+=5)
					{
						$ret.= "<tr><td><font color=black>Item :</font></td><td>".$existing_item[$i]."</td><td><font color=black>Quantity:</font></td><td>".$qty[$i]."</td><td><font color=black>Status:</font></td><td>".$temp[$j]."</td></tr>";
					}
					$i=0;
					$obj=new POController();
					$po=$obj->fetch_PO_details();
					$total_no=  mysqli_num_rows($po);
					if($total_no!=0)
					{
						while($row=mysqli_fetch_array($po))
						{
							 $rowid[$i] = $row[0];
							 $i++;
						}
						$row="";
						$test = new IndentController();
						$obj4 = new POController();
						
						$ret.= "<tr><td><font color=black>Total no of purchase order created:</font></td><td>".$total_no."</td></tr></table>";
						for($i=0;$i<$total_no;$i++)
						{
							$podetails = $obj4->selectPORecords($rowid[$i]);
							$po=mysqli_fetch_array($podetails);
							
							$res = $test-> selectIndent_ItemList($rowid[$i]);
							
							$ret.=  "<br/><table cellspacing='2' cellpadding='3'>
									<tr class=noborder><td><font color=black>Purchase order id :</font></td><td>".$rowid[$i]."</td></tr>
									<tr><td><font color=black>Vendor id :</font></td><td>".$po[1]."</td></tr>
									<tr><td><font color=black>Release date :</font></td><td>".$po[3]."</td></tr>
									<tr><td><font color=black>Expected date :</font></td><td>".$po[5]."</td></tr>
									<tr><td><font color=black>Amount </td><td></font>Rs. ".$po[4]."</td></tr>
									<tr><td><font color=black>Purchase order status :</font></td><td>".$po[6]."</td></tr>";
							while($testres = mysqli_fetch_array($res))//use code here
							{
								$name=$obj3->getAllItemData($testres[1]);
								$ret.= "<tr><td><font color=black>Item :</font></td><td>".$name[0]."</td><td><font color=black>Quantity:</font></td><td>".$testres[3]."</td><td><font color=black>Status:</font></td><td>".$testres[4]."</td></tr>";
							}
							$ret.= " </table>";
						}
					}
					if($temp[3]=='cancelled')
									{
										$ret.="</table><br><font color=black>This indent has already been cancelled and hence cannot be updated</font> 
												<div align='center'>
								
								 <a  href=indent_index.php?id=5><button>Go Back</button></a>
														";
										return $ret;
									}
									if($temp[3]=='approved')
									{
										$ret.="</table><br><font color=black>This indent has already been approved and hence cannot be updated</font>
												<div align='center'>
								
								 <a  href=indent_index.php?id=5><button>Search</button></a>
														";
										return $ret;
									}
									else
									{
										$ret.="</table></br></br></br><p><font color='black'>
								
								<div align='center'>
								
								 <a  href=indent_index.php?id=5><button>Search</button></a>
								 <a  href='indent_index.php?id=7&indent=".$args[0]."'><button>Update</button></a>
								 <a href='indent_index.php?id=5'><button>Go Back</button></a></div>
								 </div>
								";
						return $ret;
						}
				}
				else
				{
					echo "<h3 align='center'>The Indent Id    '".$args[0]."'    entered by you doesn't exist</h3>";
					 echo "</br></br><a  href=indent_index.php?id=5><button>Go Back</button></a>";
				}
			
		}		
		
		
	}
    function getStatusIndent()//to be added in IndentUI
	{
		$arg = func_get_args();
                $obj=new IndentController();
		$result = $obj->getStatusReport($arg[0]);
		
		return $result;
	}
        function getItemIndent()//to be added in IndentUI
	{
		
		$arg = func_get_args();
                $obj=new IndentController();
		$result = $obj->getItemReport($arg[0]);
		
		return $result;
	}
        function getCategoryIndentList()
	   {
	
		$arg = func_get_args();
                $obj=new CategoryController();
		$item = $obj->getCategoryReport($arg[0]);
		$obj1=new IndentController();
		$result = $obj1->getCategoryIndent($item);
		return $result;
	    }
        function getSearchDetails()
        {
            $args=  func_get_args();
            $obj=new IndentController();
            $res=$obj->showIndentDetails($args[0]);
            return $res;
        }
}
?>