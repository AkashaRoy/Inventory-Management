<?php
include_once 'Database.php';

class IndentModel extends Database
{
	function checkIndentIdForUpdateIndentForm()
	{
		$para=func_get_args();
		$link = parent::connectToDB();
		$query1="select count(*) from indent_item where status='pending' and indent_id=$para[0]" ;
		$res1=mysqli_query($link,$query1);
		$resultArray1=mysqli_fetch_array($res1);
		$query2="select count(*) from indent_item where indent_id=$para[0]";
		$res2=mysqli_query($link,$query2);
		$resultArray2=mysqli_fetch_array($res2);
		if($resultArray2[0]==$resultArray1[0])
		return true;
		else 
		return false;
	}
	function getDataForReport()
    {
        $para=  func_get_args();
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
		
		if($para[0]=="item")
		{
			$query = "select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
					indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id 
					and indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and item.item_id=$para[1]";		
		}
		else if($para[0]=="year")
		{
			$query="select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
					indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and 
					indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and indent.raise_date like '$para[1]%'";
		}
		else if($para[0]=="department")
		{
			$query="select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
					indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and 
					indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and indent.dept_id=$para[1]";
		}
		else if($para[0]=="month")
		{
			$query="select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
					indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and indent_item.item_id=item.item_id and indent.dept_id=department.department_id
					and item.category_id=category.category_id and indent.raise_date like '_____$para[1]___'";
		}
		else if($para[0]=="category")
		{
			$query="select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
						indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and 
						indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and category.category_id=$para[1]";
		}
		else if($para[0]=="date")
		{
			
			$query= "select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
						indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and 
						indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and indent.raise_date='$para[1]'";
		}
		else if($para[0]=="status")
		{
			$query = "select indent.indent_id,department.name,indent.raise_date,indent.status,item.name_brand,category.name,indent_item.quantity,indent_item.status,
						indent_item.purchase_order_id from indent,indent_item,item,department,category where indent_item.indent_id=indent.indent_id and 
						indent_item.item_id=item.item_id and indent.dept_id=department.department_id and item.category_id=category.category_id and indent.status ='$para[1]';";
		}
		 $res=  mysqli_query($link, $query);
		if($res)
			return $res;
		else
			return false;
    }
		

   function createIndentItem()
   {
	  $args=func_get_args();
	  /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
	  $query="INSERT INTO `indent_item` VALUES (NULL,$args[0],$args[1],$args[2],'$args[3]',NULL)";
	  //echo $query;
	  $result=mysqli_query($con,$query);
	  
   }
   function createIndent()
   {
      $args=func_get_args();
	  /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
	  $query="insert into indent values(NULL,'$args[0]','$args[1]','pending')";
	  $result=mysqli_query($con,$query);
		  if($result)
		  {
				$query1="SELECT MAX(`indent_id`) FROM `indent`";
				$result=mysqli_query($con,$query1);
		   $row=mysqli_fetch_array($result);
		   return $row[0];
		  }
		  else
		      return false;
   }
   function updateIndent()
   {
       $args=func_get_args();
	   /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
	   $query="update indent set name='$args[1]',department='$args[2]',status='$args[3]' where indent_id=$args[0])";
	   $result=mysqli_query($con,$query);
		  if($result)
		      return true;
		  else
		      return false;
   }
   function getIndentList()
   {
       $args=func_get_args();
	   /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
	   $index=0;
	   if($args)
	    {
			$query1="select * from indent where indent_id=$args[0] and status='pending'";
			$result1=mysqli_query($con,$query1);
			$arr;
			if(mysqli_num_rows($result1)==1)
			{
				$index=0;
				while($row=mysqli_fetch_array($result1))
				{
					$arr[$index]=$row[0];
					$index++;
					$arr[$index]=$row[1];
					$index++;
					$arr[$index]=$row[2];
					$index++;
					$arr[$index]=$row[3];
					$index++;
				}
				$query2="select * from indent_item where indent_id=$args[0] and status='pending'";
				$result2=mysqli_query($con,$query2);
				while($row=mysqli_fetch_array($result2))
				{
					$arr[$index]=$row[0];
					$index++;
					$arr[$index]=$row[1];
					$index++;
					$arr[$index]=$row[2];
					$index++;
					$arr[$index]=$row[3];
					$index++;
					$arr[$index]=$row[4];
					$index++;
				}
			}
			if(isset($arr) && !empty($arr))
			  return $arr;
			 else
			 {
				 $_SESSION['errMsg']="<script type='text/javascript'>alert('The indent with this id does not exist OR has been cancelled')</script>
				                      
									  </html>";
				 
					//header('location:indent_index.php?id=2');
			 }				
	   }
	   else
	   {
		$query1="select * from indent where status='pending'";
		$result1=mysqli_query($con,$query1);
		$arr;
		$index=0;
		while($row=mysqli_fetch_array($result1))
		{
		
			$arr[$index]=$row[0];
			$index++;
			$arr[$index]=$row[1];
			$index++;
			$arr[$index]=$row[2];
			$index++;
			$arr[$index]=$row[3];
			$index++;
		}
		if(isset($arr) && !empty($arr))
                return $arr;
	}
}
	function cancelIndent()
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
		$query1="UPDATE `indent_item` SET `status`='cancelled' WHERE `indent_id`=$arg[0]";
		$result1=mysqli_query($con,$query1);
	}
	function updateIndentItem()
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
		$query="UPDATE `indent_item` SET `status`='pending' WHERE `item_id`=$arg[0] and `indent_id`=$arg[1] and`quantity`=$arg[2]";
		$result=mysqli_query($con,$query);
		return($result);
	}
	function checkRowsIndentItem()
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
		$query="SELECT `item_id`, `indent_id`, `quantity`, `status` FROM `indent_item` WHERE `item_id`=$arg[0] and `indent_id`=$arg[1] and `quantity`=$arg[2]";
		$result=mysqli_query($con,$query);
		$num=mysqli_num_rows($result);
		return $num;
	}
	function cancelAll()
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
		$query1="UPDATE `indent_item` SET `status`='cancelled' WHERE `indent_id`=$arg[0]";
		$result=mysqli_query($con,$query1);
		$date=date("Y-m-d");
		$query2="UPDATE `indent` SET `raise_date`='$date',`status`='cancelled' WHERE `indent_id`=$arg[0]";
		$result2=mysqli_query($con,$query2);
		
	}
	
	function getIndentDetails()
	{
       $args=func_get_args();
	   /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
	   $index=0;
	   if($args)
	    {
			$query1="select * from indent where indent_id=$args[0]";
			$result1=mysqli_query($con,$query1);
			$arr;
			if(mysqli_num_rows($result1)==1)
			{
				$index=0;
				while($row=mysqli_fetch_array($result1))
				{
					$arr[$index]=$row[0];
					$index++;
					$arr[$index]=$row[1];
					$index++;
					$arr[$index]=$row[2];
					$index++;
					$arr[$index]=$row[3];
					$index++;
				}
				$query2="select * from indent_item where indent_id=$args[0]";
				//echo '</br>'.$query2;
				$result2=mysqli_query($con,$query2);
				while($row=mysqli_fetch_array($result2))
				{
					$arr[$index]=$row[0];
					$index++;
					$arr[$index]=$row[1];
					$index++;
					$arr[$index]=$row[2];
					$index++;
					$arr[$index]=$row[3];
					$index++;
					$arr[$index]=$row[4];
					$index++;
				}
			}
			else
			 {
				/*$_SESSION['errMsg']="<script type='text/javascript'>
                                                      alert('The indent with the given id does not exist.Kindly re-enter.');
                                                      </script>";
					//header('location:indent_index.php?id=5');*/
			 }		
			if(isset($arr) && !empty($arr))
			  return $arr;
			 		
	   }
          else 
              {
                  $query="select * from indent where status='pending'";
                  
         
				$index=0;
				while($row=mysqli_fetch_array($result1))
				{
					$arr[$index]=$row[0];
					$index++;
					$arr[$index]=$row[1];
					$index++;
					$arr[$index]=$row[2];
					$index++;
					$arr[$index]=$row[3];
					$index++;
				}

			if(isset($arr) && !empty($arr))
			  return $arr;
               }
	}
    function showIndent()
	{
	    $args=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $con = parent::connectToDB();
		
		if($args[1]==1)
		{
		    $query="SELECT * from indent WHERE dept_id=$args[0]";
			$res=mysqli_query($con,$query);
	    }
		if($args[1]==2)
		{
		    $query="SELECT * from indent WHERE raise_date='$args[0]'";
	
			$res=mysqli_query($con,$query);
	        }
                if($args[1]==3)
		{
		    $query="SELECT * from indent WHERE raise_date like'_____$args[0]___'";
			
			$res=mysqli_query($con,$query);
	        }
                if($args[1]==4)
		{
		    $query="SELECT * from indent WHERE raise_date like'$args[0]%'";
		
			$res=mysqli_query($con,$query);
	        }
		return $res;
			
		
	}
	function selectParticularIndentRecord()
    {
        $para=  func_get_args();
     /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
     $query="select * from indent where indent_id=".$para[0]." and status!='cancelled'";
     $res=  mysqli_query($link, $query);
     if($res)
         return $res;
     else
         return false;
    }
    function updateIndentStatusOnCancellation()
    {
     $para=  func_get_args();
     /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
     $query="update indent set status='pending' where status='approved' and indent_id=".$para[0];
     $res=  mysqli_query($link, $query);
     if($res)
         return $res;
     else
         return false;
    }
    function updateIndent_ItemStatusOnCancellation()
    {
        $para=  func_get_args();
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
        $query="update indent_item set status='pending' where status='approved' and indent_id=".$para[0]." and purchase_order_id=".$para[1];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else
            return false;
    }
    function changeIndentStatus()
    {
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
        $query1="select count(*) from indent_item where status='pending' and indent_id=".$_SESSION['selectedIndentId'];
        $res1=  mysqli_query($link, $query1);
        $rowCount=  mysqli_fetch_array($res1);
        if($rowCount[0]==0)
        {
            $query2="update indent set status='approved' where indent_id=".$_SESSION['selectedIndentId'];
            $res2=  mysqli_query($link, $query2);
            
            if($res2)
                return true;
            else
            {
                $_SESSION['errMsg']="unable to make changes in the database";
                return false;
            }
        }
        else
            {
                return false;
            }
    }
    function countCategory()
    {
        
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
        $query="select distinct item.category_id from indent_item,item 
        where indent_item.item_id=item.item_id and status='pending' and indent_id=".$_SESSION['selectedIndentId'];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
    }
    function getItemUsingCategory()
    {
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
		$para = func_get_args();
        $link = parent::connectToDB();
        $query="select indent_item.item_id from indent_item,item where indent_item.status='pending' 
            and indent_item.item_id=item.item_id and item.category_id=".$para[0]." and indent_item.indent_id=".$_SESSION['selectedIndentId'];
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else 
            return false;
    }
    function selectIndentList()
    {
        
        $para=  func_get_args();
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
         
        if($para[0]=='pending')
        {
            
        $query="select * from indent where status='pending'";
        $res=  mysqli_query($link, $query);
        if($res)              
            return $res;
        else 
            return false;
        }
        else if($para[0]=='approved')
        {
            
            $query="select * from indent where status='approved'";
            $res=  mysqli_query($link, $query);
            if($res)              
            return $res;
        else 
            return false;
        }
        else if($para[0]=='cancelled')
        {
            
            $query="select * from indent where status='cancelled'";
            $res=  mysqli_query($link, $query);
            if($res)              
            return $res;
        else 
            return false;
        }
        else if($para[0]=='all')
        {
            $query="select * from indent";
            $res=  mysqli_query($link, $query);
            if($res)
                return $res;
            else
                return false;
        }
        }
        function selectIndent_ItemList()
    {
        $para=  func_get_args();
        /*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
        if(func_num_args()==3)
        {
        if($para[0]=='IndentId' && $para[1]=='pending')
        {
            $query="select * from indent_item where status='pending' and indent_id=".$para[2];
        }
        else if($para[0]=='IndentId' && $para[1]=='approved')
        {
            $query="select * from indent_item where status='approved' and indent_id=".$para[2];
        }
        elseif($para[0]=='PurchaseOrderId' && $para[1]=='approved')
        {
            $query="select * from indent_item where status='approved' and purchase_order_id=".$para[2];
        }
        else if($para[0]=='PurchaseOrderId' && $para[1]=='pending')
            {
            $query="select * from indent_item where status='pending' and purchase_order_id=".$para[2];
        }
        }
        else
        {
            $query="select * from indent_item where purchase_order_id=".$para[0];
        }
        $res=  mysqli_query($link, $query);
        if($res)
            return $res;
        else
            return false;
    }
    
	
	function fetchAllIndentData($code)
{
/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
	$query= "select indent.indent_id,department.name,indent.raise_date,indent.status from indent,department where indent.dept_id=department.department_id and indent.indent_id=$code";
	$res = mysqli_query($link, $query);
	if($res)
	{
	    return $res;
		}
	else
	{
	    return false;
	}

}
function fetchStatusReport()//function to be added in IndentModel
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
		$query = "SELECT DISTINCT indent_id,raise_date FROM indent WHERE status='".$arg[0]."'";
		$result=mysqli_query($link,$query);
		return $result;
	}
function fetchItemReport()//function to be added in IndentModel
	{
		$arg=func_get_args();
		/*        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'vocational_training';
        $link = parent::connectToDB();
*/
        $link = parent::connectToDB();
		$query = "SELECT DISTINCT indent_item.indent_id,indent.raise_date,indent_item.status  FROM indent_item,indent WHERE indent_item.item_id='".$arg[0]."' and indent.indent_id=indent_item.indent_id";
		$result=mysqli_query($link,$query);
		return $result;
	}
function fetchCategoryIndent()                //function to be added in IndentModel
	{
		$arg=func_get_args();
		$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'vocational_training';
		$link = parent::connectToDB();
		$query = "SELECT DISTINCT `indent_id` FROM `indent_item` WHERE item_id=".$arg[0];
		$result=mysqli_query($link,$query);
               
		return $result;
		
	}		


		

		
}

?>