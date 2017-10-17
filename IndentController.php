<?php
include_once 'IndentModel.php';
    class IndentController
	{
		function getIndentIdForUpdateIndentForm()
		{
			$para=func_get_args();
			$obj=new IndentModel();
			return $obj->checkIndentIdForUpdateIndentForm($para[0]);
		}
		function getDataForReport()
		{
			$para=  func_get_args();
			$obj=new IndentModel();
			if(func_num_args($para)==2)
			return $obj->getDataForReport($para[0],$para[1]);
			else
				return $obj->getDataForReport($para[0],$para[1],$para[2],$para[3]);
		}
function getAllIndentDetails($code)
{
$indentModelObj=new IndentModel();
	$result=$indentModelObj->fetchAllIndentData($code);
	if($result)
	{
	   
	    return $result;
	}
	else
	{
	    return false;
	}

}


	
	     function checkIndentDetails()
		 {
			$args=func_get_args();
					
			$arr[0]=$args[0];
			$index=1;
			$count=0;
			$cnt=0;
		
				for($i=1,$j=2;$i<9;$i+=2,$j+=2)
				{
					if($args[$i]!=0 && $args[$j]!=0)
					{
						$arr[$index]=$args[$i];
						$index++;
						$arr[$index]=$args[$j];
						$index++;
						$count++;
					}
					else
					{
					   $cnt++;  
					}
				}
				
				for($i=1;$i<=(2*$count);$i+=2)
				{
					for($j=$i+2;$j<=(2*$count);$j+=2)
					{
						if($arr[$i]==$arr[$j])
						{
							$arr[$i+1]=$arr[$i+1]+$arr[$j+1];
							$arr[$j]=NULL;
							$arr[$j+1]=NULL;
						}
					}
				}
				if($cnt!=4)
				{
					if($count)
					{
						$date=date("Y-m-d");
						$obj=new IndentModel();
						$id=$obj->createIndent($arr[0],$date);
					}
					if($id)
					{
						$obj=new IndentModel();
						for($i=1;$i<=(2*$count);$i+=2)
						{
							if($arr[$i]==NULL)
								continue;
							$obj->createIndentItem($arr[$i],$id,$arr[$i+1],'pending');
						}
					}
					
					return $id;
				}
				
		}
		function updateIndentDetils()
		{
			$args=func_get_args();
			$arr[0]=$args[0];
			$index=1;
			$count=0;
			$cnt=0;
			for($i=1,$j=2;$i<9;$i+=2,$j+=2)
				{
					if($args[$i]!=0 && $args[$j]!=0)
					{
						$arr[$index]=$args[$i];
						$index++;
						$arr[$index]=$args[$j];
						$index++;
						$count++;
					}
					else
					{
						$cnt++;
					}
				}
				
				
				for($i=1;$i<=(2*$count);$i+=2)
				{
					for($j=$i+2;$j<=(2*$count);$j+=2)
					{
						if($arr[$i]==$arr[$j])
						{
							$arr[$i+1]=$arr[$i+1]+$arr[$j+1];
							$arr[$j]=NULL;
							$arr[$j+1]=NULL;
						}
					}
				}
				
			
				if($args[9]==0)
				{
					$obj=new IndentModel();
					$obj->cancelAll($arr[0]);
				    $_SESSION['errMsg']="<br><font color=black>The indent has been updated.</font><br><br>";
					$_SESSION['upMsg']=$arr[0];
//					header('location:indent_index.php');
				}
				else if($cnt!=4 && $args[9]!=0)
				{
					$obj=new IndentModel();
					$obj->cancelIndent($args[0]);
					for($i=1;$i<=(2*$count);$i+=2)
					{
						if(!$arr[$i]==NULL)
						{
							$no=$obj->checkRowsIndentItem($arr[$i],$arr[0],$arr[$i+1]);
							if($no)
							{
								$result=$obj->updateIndentItem($arr[$i],$arr[0],$arr[$i+1]);
							}
							else
							{
								$result=$obj->createIndentItem($arr[$i],$arr[0],$arr[$i+1],'pending');
							}
						}
					}

                                        return $arr[0];
				}
				else
				{
					return "0";
				}
		}
		function fetchIndentList()
		{
			$args=func_get_args();
			$obj=new IndentModel();
			if($args)
			{
				$res=$obj->getIndentList($args[0]);
				return $res;
			}
			else
			{
				$res=$obj->getIndentList();
				return $res;
			
			}
			
		}
		function showIndentDetails()
		{
			$args=func_get_args();
			$obj=new IndentModel();
			if($args)
			{
				$res=$obj->getIndentDetails($args[0]);
				return $res;
			}
		}
		function displayIndent()
		{
		   $obj=new IndentModel();
		   $args=func_get_args();
		   if($args[1]==1)
		   {
		    $temp=$obj->showIndent($args[0],1);   
		   }
		   if($args[1]==2)
		   {
		    $temp=$obj->showIndent($args[0],2);   
		   }
            if($args[1]==3)
		   {
		    $temp=$obj->showIndent($args[0],3);   
		   }
            if($args[1]==4)
		   {
		    $temp=$obj->showIndent($args[0],4);   
		   }
		   return $temp;
		}
	function selectIndent_ItemList()
    {
		 $para= func_get_args();
		 $obj=new IndentModel;
		 if(func_num_args() == 1)
		 {
			 return $obj->selectIndent_ItemList($para[0]);
		 }
		 else
		 return $obj->selectIndent_ItemList($para[0],$para[1],$para[2]);
		}
	function selectParticularIndentRecord()
    {
        $para=  func_get_args();
        $obj=new IndentModel();
        return $obj->selectParticularIndentRecord($para[0]);
    }
     function updateIndentStatusOnCancellation()
    {
        
        $para=  func_get_args();
        $obj=new IndentModel();
        return $obj->updateIndentStatusOnCancellation($para[0]);
     
    }
    function updateIndent_ItemStatusOnCancellation()
    {
     
        $para=  func_get_args();
        $obj=new IndentModel();
        return $obj->updateIndent_ItemStatusOnCancellation($para[0],$para[1]);   
    }
    function changeIndentStatus()
    {
         $obj=new IndentModel();
        return $obj->changeIndentStatus();
    }
    function getItemUsingCategory()
    {
         $para=  func_get_args();
        $obj=new IndentModel();
        return $obj->getItemUsingCategory($para[0]);
    }
    function countCategory()
    {
        $obj=new IndentModel();
        return $obj->countCategory();
    }
    function selectIndentList()
    {
          $para= func_get_args();
        $obj=new IndentModel();
        
         
        return $obj->selectIndentList($para[0]);
        
        
    }
	function getStatusReport()//function to be added in IndentController
	{
		$arg = func_get_args();
                $obj=new IndentModel();
		$result = $obj->fetchStatusReport($arg[0]);
		return $result;
	}
        function getItemReport()//function to be added in IndentController
	{
		$arg = func_get_args();
                $obj=new IndentModel();
		$result = $obj->fetchItemReport($arg[0]);
		return $result;
	}
        function getCategoryIndent()	//function to be added in IndentController
	{
		$arg = func_get_args();
                 $obj=new IndentModel();
		$result = $obj->fetchCategoryIndent($arg[0]);
		return $result;
	}
	}
?>