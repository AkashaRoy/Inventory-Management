
function confirmationFunction(x1,x2)
{
    
    if(confirm("are you sure you want to cancel purchase order no:"+x1+" against indent id:"+x2+"?"))
        {
            return true;
        }
        else
            return false;
}
function ValidateCreatePurchaseOrderForm()
{
	
	var count=document.getElementById("total").value;
	var i = 0;
	var flag_amnt = 0;
        var flag_amt1=0;
	for(i=0;i<count;i++)
	{
            document.getElementById("ItemList"+i).innerHTML="";
		document.getElementById("Amnt"+i).innerHTML="";
	}
        
       
       
	for(i=0;i<count;i++)
	{
            
		if(document.getElementById("check["+i+"]").checked)
		{
                    
			if(document.getElementById("Amount["+i+"]").value=="")
			{	
				document.getElementById("Amnt"+i).innerHTML="**";
				flag_amnt++;
                                break;
			}
		}
                else if(!document.getElementById("check["+i+"]").checked)
                    {
                        if(!document.getElementById("Amount["+i+"]").value=="")
                            {
                                document.getElementById("ItemList"+i).innerHTML="**";
                               //code for innerhtml
                               flag_amt1++;
                               break;
                            }
                    }
       /*        else //if(document.getElementById("Amount["+i+"]").value!=""  &&  !(document.getElementById("check["+i+"]").checked))
                {   
                    alert("bingo");
                    return false;
                    /*document.getElementById("Amnt"+i).innerHTML="**";
                    alert("Kindly check the item corresponding to the highlighted amount");
                    return false;
                }*/
	}
	if(flag_amnt>0)
	{
		alert("please enter amount against checked item");
		return false;
	}
	else if(flag_amt1>0)
            {
                alert("please check the highlighted item since you have filled the amount for the corresponding item");
                return false;
            }
	//alert("paused");
	//return false;
	var id=0,k=0;count=0;
    var len=document.getElementById('totalCategory').value;
    for(i=0;i<len;i++)
	{
		document.getElementById("VenList"+i).innerHTML=" ";
                document.getElementById("ExDate"+i).innerHTML=" ";
	}
    for ( i=0;i<(len);i++)
        {
            count=0;
            var l=document.getElementsByName('Amount['+i+'][]').length;
            for(var j=0;j<l;j++)
                {
                   k=document.getElementById('Amount['+id+']').value;
                   if(k!="" || k!=0)
                       {   
                      count=count+1;
                       }
               id++;
                }
				//alert(document.getElementById('VendorList['+i+']').value);
                if((count!=0)&&(document.getElementById('VendorList['+i+']').value==0))
                    {
					
			document.getElementById("VenList"+i).innerHTML="**";		
                    alert('Kindly fill in the vendor name')    ;
                    return false;
                    }
                    else if((count==0) && (document.getElementById('VendorList['+i+']').value!=0))
                        {
                            alert("Kindly select an item and fill the amount corresponding to the vendor selected");
                            return false;
                        }
                        else if(((count==0)&&(document.getElementById('expected_date['+i+']').value!='')))
                            {
                            document.getElementById("VenList"+i).innerHTML="**";		
                                alert("Kindly fill in a vendor corresponding to the expected date");
                                return false;
                            }
	            else if(((count!=0)&&(document.getElementById('expected_date['+i+']').value==''))||((document.getElementById('expected_date['+i+']').value <= document.getElementById('current_date['+i+']').value)&&(count!=0) ))
                    {
                        document.getElementById("ExDate"+i).innerHTML="**";
			alert('Kindly fill in the expected date or check if the expected date is a future date');
                        return false;
                    }    
                    
					
				
	 	/*else if(document.getElementById('expected_date['+i+']').value <= document.getElementById('current_date['+i+']').value)
		{
                    
                //document.getElementById("ExDate"+i).innerHTML="**";
		alert('Kindly enter a date after the current date');
		return false;
		}*/
      
	}
	return true;

}
function onclickValidateCancelPurchaseOrder()
{
    var x1=document.forms["cancelPurchaseOrder"]["indentIdCancel"].value;
    var x2=document.forms["cancelPurchaseOrder"]["IndentIdCancelDropDown"].value;
    if(x1=='' && x2==0)
        {
            alert("Enter an indent id in the text box(Ex:1001) or select an indent id from the drop down box");
            return false;
        }
        else if(x1!='' && x2==0)
            {
                if(x1<0 || isNaN(x1))
                {
                alert("The entered indent id is not a valid id");
                return false;
                }
                else
                return true;
            }
            else if(x1=='' && x2!=0)
                {
                    return true;
                }
                else if(x1!='' && x2!=0)
                    {
                        if(x1==x2)
                            return true;
                        else if(x1<0 || isNaN(x1))
                            {
                            alert("The entered indent id is not a valid id");
                            return false;
                            }
                            else if(x1!=x2)
                                {
 //                                   alert("The indent ids entered in the text box and dropdown fields cannot be different");
       //                             return false;
                                }
                    }
    
}
function isValidKeyPurchaseOrder(evt)
{ 
   evt = (evt) ? evt : window.event
   var charCode = (evt.which) ? evt.which : evt.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
   }
   return true;
   
}
function isValidKeyAmountPurchaseOrder(evt)
{ 
   evt = (evt) ? evt : window.event
   var charCode = (evt.which) ? evt.which : evt.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46 ) {
      return false;
   }
   return true;
   
}

function validateEntryCreatePurchaseOrder()
{
    /*alert('hhdhhdhdhd');
    return false;
    */
    var x1=document.forms["createPurchaseOrder"]["indentId"].value;
    var x2=document.forms["createPurchaseOrder"]["IndentIdPending"].value;
   
    if(x1=='' && x2==0)
        {
            alert("Enter a indent id in the text box(Ex:1001) or select an indent id from the drop down box");
            return false;
        }
        else if(x1!='' && x2==0)
            {
                if(x1<0 || isNaN(x1))
                {
                alert("The entered indent id is not a valid id");
                return false;
                }
                else
                return true;
            }
            else if(x1=='' && x2!=0)
                {
                    return true;
                }
                else if(x1!='' && x2!=0)
                    {
                        if(x1==x2)
                            return true;
                        else if(x1<0 || isNaN(x1))
                            {
                            alert("The entered indent id is not a valid id");
                            return false;
                            }
                            else if(x1!=x2)
                                {
   //                                 alert("The indent ids entered in the text box and dropdown fields cannot be different");
     //                               return false;
                                }
                    }
    
    
}
function showForm(c)
{
    
	if(c.value == "Purchase Order Id")
	{
	document.getElementById("IdForm").style.display="block";
	document.getElementById("VendorForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
        
	}
  	else if(c.value == "Vendor")
	{
         //document.getElementById("searchIndentForm").style.dispaly="none";
	document.getElementById("VendorForm").style.display="block";
        document.getElementById("IdForm").style.display="none";
        document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
	}
	else if(c.value == "Release Date")
	{
           // document.getElementById("searchIndentForm").style.dispaly="none";
        
	document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="block";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
	}
        else if(c.value=='Indent')
            {
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="block";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
            }
            else if(c.value == 'Status')
                {
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="block";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
                }
                else if(c.value=='Item')
                    {
                        
                    
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="block";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
                    }
                    else if(c.value=='Category')
                        {
                        
                        
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="block";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="none";
                        }
                        else if(c.value=='Year')
                            {
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="block";
        document.getElementById("monthForm").style.display="none";
                            }
                            else if(c.value=='Month')
                            {
        document.getElementById("VendorForm").style.display="none";
	document.getElementById("IdForm").style.display="none";
	document.getElementById("DateForm").style.display="none";
        document.getElementById("indentSearchForm").style.display="none";
        document.getElementById("itemForm").style.display="none";
        document.getElementById("statusSearchForm").style.display="none";
        document.getElementById("categoryForm").style.display="none";
        document.getElementById("yearForm").style.display="none";
        document.getElementById("monthForm").style.display="block";
                            }
}
function checkInput(ch)
{

  if(ch==1)
  {
        var z= document.forms['VForm']['Vname'].value;
		
		if(z == 0)
		{
		   alert("Select a vendor name");
		   return false;
	    }
	   return true;
  }
  if(ch==2)
  {
      
	   var d= document.forms['DForm']['day'].value;
	   var m= document.forms['DForm']['month'].value;
	   var y= document.forms['DForm']['year'].value;
	   if(d== "--SELECT--" || m== "--SELECT--" || y== "--SELECT--")
	   {
	   		   alert("Select a valid date");
	   		   return false;
	   }
	   if((m=="4"||m=="6"||m=="9"||m=="11")&&(d=="31"))
	   {
		   alert("The month you have selected has 30 days");
		   return false;
	   }
	   if(m=="2" &&(d=="29"||d=="30"||d=="31")&&y!="2016"&&y!="2020")
	   {
		   alert("February has only 28 days");
		   return false;
       }
       return true;
  }
  if(ch==3)
  {
     var p=document.forms['PForm']['Pid'].value;
     if(p==null || p=='')
     {
		 alert("You cannot leave this field empty");
		 return false;
     }
     var nums=/^[0-9]+$/;
     if(!p.match(nums))
     {
		 alert("Invalid Purchase Order Id.Please re-enter!!");
		 return false;
     }
     return true;
  }
  if(ch==4)
      {
          var p=document.forms['IForm']['Indentid'].value;
     if(p==null || p=='')
     {
		 alert("You cannot leave this field empty");
		 return false;
     }
     var nums=/^[0-9]+$/;
     if(!p.match(nums))
     {
		 alert("Invalid Indent Id.Please re-enter!!");
		 return false;
     }
     return true;
      }
      if(ch==5)
          {
               var z= document.forms['statusForm']['statusPO'].value;
		
		if(z == 0)
		{
		   alert("Select a status type for purchase order");
		   return false;
	    }
	   return true;
          }
          if(ch==6)
              {
                  var z= document.forms['selectItem']['ItemPO'].value;
		
		if(z == 0)
		{
		   alert("Select an item to search for corresponding purchase orders");
		   return false;
	    }
	   return true;
              }
              if(ch==7)
                  {
                      var z= document.forms['selectCategory']['CategoryPO'].value;
		
		if(z == 0)
		{
		   alert("Select a category to search for corresponding purchase orders");
		   return false;
                  }
                  return true;
                  }
                  if(ch==8)
                  {
                      var z= document.forms['selectYear']['YearPO'].value;
		
		if(z == 0)
		{
		   alert("Select a year to search for corresponding purchase orders");
		   return false;
                  }
                  return true;
                  }
                  if(ch==9)
                  {
                      var z= document.forms['selectMonth']['MonthPO'].value;
		
		if(z == 0)
		{
		   alert("Select a month to search for corresponding purchase orders");
		   return false;
                  }
                  return true;
                  }
}