<?php
   session_start();
   include_once('template.php');
   include_once('IndentModel.php');
   include_once('IndentUI.php');
   include_once('IndentController.php');
   include_once('DepartmentController.php');
   include_once('DepartmentModel.php');
   include_once('ItemController.php');
   include_once('ItemModel.php');
   include_once('POController.php');
   include_once('POModel.php');
   include_once('CategoryController.php');
   include_once('CategoryModel.php');
   $x=1;
   echo "<script src='function.js'></script>";
   if(isset($_SESSION['errMsg']))
   {
      echo "<br><br>".$_SESSION['errMsg'];
	  $x=0;
	 unset($_SESSION['conMsg']);
	 unset($_SESSION['upMsg']);
	 unset($_SESSION['errMsg']);
	 
	}
	if(isset($_SESSION['search']) && !empty($_SESSION['search']))
	{
	  if(isset($_POST['Vname']))
	  {
		$DId=$_POST['Vname'];
	    $obj=new IndentUI();
		$temp=$obj->searchIndent($DId,1);
		$dept=$obj->getDepartment($DId);
		$cnt= mysqli_num_rows($temp);
		
		echo "<div><br/>";
		echo "<h2>Indents raised by Department :  ".ucwords($dept[0])."</h2>";
		echo "<h3>Number of indents : ".$cnt."</h3>";
		if($cnt>0)
		{
			echo "<h3 align='center'><a href='indentReportUsingDepartment.php?id=".$DId."'><button>Download</button></a></h3>";
			echo "<table>";
			while($row=mysqli_fetch_array($temp))
			{
			   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
			   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[2]."</td></tr></tr>";
			   echo "<tr><tr><td><font color=black>Status</font></td><td>".$row[3]."</td></tr></table></tr><br>";
			   
			}
			echo "<a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button> 
</div>";
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('given Indent ID do not exist . Try again !');
			</script>";
		}
	  }
	  else if(isset($_POST['Pid']))
	   {
	     $PId=$_POST['Pid'];
		 $obj=new IndentUI();
		 $temp=$obj->showIndent($PId,3);
		 echo $temp;
	   }
	   else if(isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']))
	   {
	      if($_POST['month']>10 && $_POST['day']>10)
		      $date=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
		  else if($_POST['month']<10 && $_POST['day']>10)
		      $date=$_POST['year']."-0".$_POST['month']."-".$_POST['day'];
		  else if($_POST['month']>10 && $_POST['day']<10)
		      $date=$_POST['year']."-".$_POST['month']."-0".$_POST['day'];
		  else
		      $date=$_POST['year']."-0".$_POST['month']."-0".$_POST['day'];
		   
		  $obj=new IndentUI();
		  $temp=$obj->searchIndent($date,2);
		 
		  $cnt= mysqli_num_rows($temp);
		
		echo "<br>";
		echo "<h2>Indents raised on date :  <font color=black>".$date."</font></h2>";
		echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
		if(mysqli_num_rows($temp)!=0)
			echo "<h3 align='center'><a href='indentReportUsingDate.php?id=".$date."'><button>Download</button></a></h3>";
		while($row=mysqli_fetch_array($temp))
		{
		  
		   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[2]."</td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Status</font></td><td>".$row[3]."</td></tr></table></tr><br>";
		   
		}
		echo "<a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";
	}
        else if(isset($_POST['month1']))
        {
            $m=$_POST['month1'];
            $obj=new IndentUI();
		  $temp=$obj->searchIndent($m,3);
		  $cnt= mysqli_num_rows($temp);
		
		echo "<br>";
		echo "<h2>Indents raised in the month :  ".$m."</h2>";
		echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
		if(mysqli_num_rows($temp)!=0)
			echo "<h3 align='center'><a href='indentReportUsingMonth.php?id=".$m."'><button>Download</button></a></h3>";
		while($row=mysqli_fetch_array($temp))
		{
		  
		   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[2]."</td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Status</font></td><td>".$row[3]."</td></tr></table></tr><br>";
		   
		}
		echo "<a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";

	}
         else if(isset($_POST['year1']))
        {
            $y=$_POST['year1'];
            $obj=new IndentUI();
		  $temp=$obj->searchIndent($y,4);
		  $cnt= mysqli_num_rows($temp);
		
		echo "<br>";
		echo "<h2>Indents raised in the year :  <font color=black>".$y."</font></h2>";
		echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
		if(mysqli_num_rows($temp)!=0)
			echo "<h3 align='center'><a href='indentReportUsingYear.php?id=".$y."'><button>Download</button></a></h3>";
		while($row=mysqli_fetch_array($temp))
		{
		  
		   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[2]."</td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Status</font></td><td>".$row[3]."</td></tr></table><br>";
		   
		}
		echo "<br><a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";
	}
        else if(isset($_POST['search_status']))
        {
            $s=$_POST['search_status'];
            $obj=new IndentUI();
            $temp=$obj->getStatusIndent($s);
              $cnt= mysqli_num_rows($temp);
		
		echo "<br>";
		echo "<h2>Indents having status :  <font color=black>".$s."</font></h2>";
		echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
		if(mysqli_num_rows($temp)!=0)
			echo "<h3 align='center'><a href='indentReportUsingStatus.php?id=".$s."'><button>Download</button></a></h3>";
		while($row=mysqli_fetch_array($temp))
		{
		  
		   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr>";
		   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[1]."</td></tr></tr></table></tr>";
                   echo "<br>";   
		}
		echo "<br><a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";
		
        }
        else if(isset($_POST['item']))
        {
            $i=$_POST['item'];
            $obj=new IndentUI();
            $temp=$obj->getItemIndent($i);
              $cnt= mysqli_num_rows($temp);
		
		echo "<br>";
		echo "<h2>Indents having Item :  <font color=black>".$i."</font></h2>";
		echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
		if(mysqli_num_rows($temp)!=0)
			echo "<h3 align='center'><a href='indentReportUsingItem.php?id=".$i."'><button>Download</button></a></h3>";
		
		while($row=mysqli_fetch_array($temp))
		{
		  
		   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
		   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$row[1]."</td></tr></tr>";
                   echo "<tr><tr><td><font color=black>Status</font></td><td>".$row[2]."</td></tr></table></tr>";
                   echo "<br>";
		  
		   
		}
		echo "<a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";
        }
         else if(isset($_POST['category']))
        {
            $c=$_POST['category'];
           
            $obj=new IndentUI();
            $temp=$obj->getCategoryIndentList($c);
            if($temp)
            {
              $cnt= mysqli_num_rows($temp);

			echo "<br>";
			
			echo "<h3>Number of indents = <font color=black>".$cnt."</font></h3>";
			if(mysqli_num_rows($temp)!=0)
				echo "<h3 align='center'><a href='indentReportUsingCategory.php?id=".$c."'><button>Download</button></a></h3>";
			while($row=mysqli_fetch_array($temp))
			{
			  
			   echo "<tr><table border=1 align='center'><tr><td><font color=black>Indent id</font></td><td><a href='indent_index.php?id=6&indent=".$row[0]."'>".$row[0]."</a></td></tr></tr>";
					   $obj=new IndentUI();
					   $r=$obj->getSearchDetails($row[0]);
					  
			   echo "<tr><tr><td><font color=black>Raise Date</font></td><td>".$r[2]."</td></tr></tr>";
					   echo "<tr><tr><td><font color=black>Status</font></td><td>".$r[3]."</td></tr></table></tr>";
					   echo "<br>";
			  
			   
			}
			echo "<a href='indent_index.php?id=5'><button>Go Back</button></a><button onclick='printPage()'>Print</button>";
				}
				else
				{
					echo "<br><br><b>There are no indents containing items belonging to the chosen category</b>";	
				}
		} 
	  unset($_SESSION['search']);
	}

   

   	if((!empty($_POST['id']) && isset($_POST['id'])) && ($_GET['id']==3) && empty($_SESSION['search']) &&!isset($_SESSION['search']))
			{
				$id=$_POST['id'];
				$_SESSION['id']=$id;
				$obj=new IndentUI();
				$obj->showIndent($id);
                               
			}
		
		else if((!empty($_POST) && isset($_POST)))
		{
			
			if(!empty($_POST['id']) && isset($_POST['id']))
			{
				$id=$_POST['id'];
				$_SESSION['id']=$id;
				$obj=new IndentUI();
				echo($obj->showUpdateIndentForm($id));
			}
			else if(isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_POST['status']))
			{	
			    $id=$_SESSION['id'];
				unset ($_SESSION['id']);
				$item1=$_POST['item1'];
				$item2=$_POST['item2'];
				$item3=$_POST['item3'];
				$item4=$_POST['item4'];
				$qty1=$_POST['quantity1'];
				$qty2=$_POST['quantity2'];
				$qty3=$_POST['quantity3'];
				$qty4=$_POST['quantity4'];
				$status=$_POST['status'];
				$obj=new IndentUI();
				$temp=$obj->updateIndent($id,$item1,$qty1,$item2,$qty2,$item3,$qty3,$item4,$qty4,$status);	
                                if($temp!="0")//change in code
                                {
									
                                    echo "The indent has been updated!";
                                    $obj=new IndentUI();
                                    $details=$obj->viewData($id,2);
								
									echo $details;
                                    
                                }
			}
			else if(isset($_POST['dept']))
			{
				$dept=$_POST['dept'];
				$item1=$_POST['item1'];
				$item2=$_POST['item2'];
				$item3=$_POST['item3'];
				$item4=$_POST['item4'];
				$qty1=$_POST['quantity1'];
				$qty2=$_POST['quantity2'];
				$qty3=$_POST['quantity3'];
				$qty4=$_POST['quantity4'];
				$obj=new IndentUI();
				$temp=$obj->addIndent($dept,$item1,$qty1,$item2,$qty2,$item3,$qty3,$item4,$qty4);
                                if($temp!=0)
                                {
                                    echo "Your indent has been created with indent id : ".$temp;
                                    $details=$obj->viewData($temp,1);
			            echo $details;
                                }
                                else 
                                    echo "A database error has occured.";
			}
		}
		else if(empty($_GET['id'])&&!isset($_GET['id'])&&($x!=0)  && !isset($_SESSION['search']) && empty($_SESSION['search']))
		{
		   echo "<br><br>
					<font color='black'>
					<h3 align='center'><font color='black'>GUIDELINES FOR USE</font></h3>
					<br>
					<b><font color=red>*</b></font>&nbsp&nbsp Click on the Raise Indent tab to place a new indent.</br>
					<b><font color=red>*</b></font>&nbsp&nbsp The department ,which wishes to raise the indent, needs to be specified. <br>
					<b><font color=red>*</b></font>&nbsp&nbsp A maximum of <font color=black>FOUR</font> items can be ordered using a single indent.<br>
					<b><font color=red>*</b></font>&nbsp&nbsp The quantity has to be valid(only numbers).<br>
					<b><font color=red>*</b></font>&nbsp&nbsp After an indent is placed ,an indent id is assigned to it.<br>
					<b><font color=red>*</b></font>&nbsp&nbsp If the items/quantity specified in an indent need to be changed or the indent <br>needs to be cancelled,
				     click on the Update Indent tab.<br>
					<b><font color=red>*</b></font>&nbsp&nbsp To view the details and status of an indent<br>click on the Get Details tab and enter the indent id<br><br>"; 
		}
		else if(!isset($_SESSION['search']) && empty($_SESSION['search']))
		{
			if(isset($_GET['id'])&&!empty($_GET['id']))
			{
				if($_GET['id']==1)
				{
					$obj=new IndentUI();
					$form=$obj->showCreateIndentForm();
					echo $form;
				}	
				else if($_GET['id']==2)
				{
					$obj=new IndentUI();
					$form=$obj->updateForm();
					echo $form;	
				}
//				else if($_GET['id']==3)
//				{
//					$obj=new IndentUI();
//					$form=$obj->detailForm();
//					echo $form;	
//				}
//				else if($_GET['id']==4)
//				{
//				   $obj=new IndentUI();
//				   $help=$obj->showHelp();
//				   echo $help;
//				    
//				}
				else if($_GET['id']==5)
				{
				   $obj=new IndentUI();
				   $search=$obj->searchForm();
				   echo $search;
		          	}
				else if($_GET['id']==6 && isset($_GET['indent']))
				{
				    $obj=new IndentUI();
					$out=$obj->showIndent($_GET['indent'],3);
					echo $out;
				}
				else if($_GET['id']==7 && isset($_GET['indent']))
				{
				    $obj=new IndentUI();
					$id=$_GET['indent'];
				    $_SESSION['id']=$id;
					$res=$obj->showUpdateIndentForm($id);
					echo $res;
				}
			}
	    }
	
	//$home=ob_get_contents();
	//ob_clean();
	include 'footer.php';
?>