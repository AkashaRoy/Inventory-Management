var fieldValue = "";
var posValues = ["Ex:-Ram Singh","Ex:-Ram Singh","Enter Your Address","Ex:-12","Ex:-9898989898","Ex:-ram@gmail.com","Ex:-Big Bazaar","Ex:-KIIT Square,Patia","Ex:-Street No-12","Ex:-Bhubaneswar","Ex:-751024"];

function validateName(arg,compulsary) {
    document.getElementById('nameError').innerHTML = "";
    var temp=arg.value.toLowerCase();
    if(typeof(compulsary)==='undefined')
        compulsary = true;
    if(compulsary && arg.value.length == 0)
    {
        document.getElementById('nameError').innerHTML = "This field should not be left empty.";
        return false;
    }
    for (var i = 0; i < arg.value.length;i++)
    {
       if((temp.charCodeAt(i) < 97 || temp.charCodeAt(i) > 122) && temp.charAt(i)!= " ")
        {
            document.getElementById('nameError').innerHTML = "Name is not valid";
            return false;
        }
    }
    return true;
}

function validateCity(arg,mandatory)
{
document.getElementById('cityError').innerHTML = "";
    var temp=arg.value.toLowerCase();
    if(typeof(mandatory)==='undefined')
        mandatory = true;
    if(mandatory && arg.value.length == 0)
    {
        document.getElementById('cityError').innerHTML = "This field should not be left empty.";
        return false;
    }
    for (var i = 0; i < arg.value.length;i++)
    {
       if((temp.charCodeAt(i) < 97 || temp.charCodeAt(i) > 122) && temp.charAt(i)!= " ")
        {
            document.getElementById('cityError').innerHTML = "City Name is not valid";
            return false;
        }
    }
    return true;
}

function validateEmail(arg, arg1) {
    document.getElementById('emailError').innerHTML = "";
    if (arg.value.length == 0)
            return true;
    if (arg.value.indexOf('@') == -1) {
        document.getElementById('emailError').innerHTML = "Email id is not valid";
        return false;
    }
    else if (arg.value.lastIndexOf('@') != arg.value.indexOf('@')) {
        document.getElementById('emailError').innerHTML = "Email id is not valid";
        return false;
    }
    else if (arg.value.lastIndexOf('.') < arg.value.lastIndexOf('@')) {
        document.getElementById('emailError').innerHTML = "Email id is not valid";
        return false;
    }
    else if (arg.value.indexOf('@') < 3) {
        document.getElementById('emailError').innerHTML = "Email id is not valid";
        return false;
    }
    else if (arg.value.charAt(0) == '.') {
        document.getElementById('emailError').innerHTML = "Email id is not valid";
        return false;
    }
    for (var i = 0; i < arg.value.length; i++ )
    {
        if(!((arg.value.charCodeAt(i) > 96 && arg.value.charCodeAt(i) < 123) || (arg.value.charCodeAt(i) >= 48 && arg.value.charCodeAt(i) <= 57) || (arg.value.charAt(i) == '@' || arg.value.charAt(i) == '.' || arg.value.charAt(i) == '_')))
        {
            document.getElementById('emailError').innerHTML = "Email id is not valid";
            return false;
        }    
    }
    return true;
}

function validatePhone(arg,arg1) {
    document.getElementById(arg1).innerHTML = "";
    if(arg1=="phoneError2"){
        if (arg.value.length == 0)
            return true;
    }
    if (arg.value.length !=10) {
        document.getElementById(arg1).innerHTML = "Phone Number is not valid";
        return false;
    }
    if (isNaN(arg.value)) {
        document.getElementById(arg1).innerHTML = "Phone Number is not valid";
        return false;
    }
    for (var i = 0; i < arg.value.length; i++) {
        if (arg.value.charCodeAt(i) < 48 || arg.value.charCodeAt(i) > 57) {
            document.getElementById(arg1).innerHTML = "Phone Number is not valid";
            return false;
        }
    }
    return true;
}



function validatePincode(arg){
    document.getElementById('pincodeError').innerHTML = "";
	for (var i = 0; i < arg.value.length;i++ ){
        if(arg.value.charCodeAt(i) < 48 || arg.value.charCodeAt(i) > 57)
        {
            document.getElementById('pincodeError').innerHTML = "Pincode is not valid";
            return false;
        }
    }
    if(arg.value.length != 6)
    {
        document.getElementById('pincodeError').innerHTML = "Pincode is not valid";
        return false;
    }
    return true;
}
function validateAddress(arg){
    document.getElementById('addressError').innerHTML = "";
    if(arg.value.length == 0)
    {
        document.getElementById('addressError').innerHTML = "This field should not be left empty.";
        return false;
    }
    return true;
}
function validateID(arg)
 {
    document.getElementById('idError').innerHTML = "";
    for (var i = 0; i < arg.value.length;i++ ){
        if(arg.value.charCodeAt(i) < 48 || arg.value.charCodeAt(i) > 57)
        {
            document.getElementById('idError').innerHTML = "ID is not valid";
            return false;
        }
    }
    if (arg.value.length == 0) {
        document.getElementById('idError').innerHTML = "Invalid ID";
        return false;
    }
    return true;
}

function validateCategory(arg)
{
    document.getElementById("categoryError").innerHTML = "";
    if (arg.value.length < 1) {
        document.getElementById("categoryError").innerHTML = "Choose a category";
        return false;
    }
    return true;
}

function validateLine(arg, errorFieldName)
{
    document.getElementById(errorFieldName).innerHTML = "";
    if (arg.value.length ==0) {
        document.getElementById(errorFieldName).innerHTML = "This field should not be left empty.";
        return false;
    }
    return true;
}

function resetAddFields(arg)
{
    var fields = [arg.vdname,arg.vdline1,arg.vdline2,arg.vdstreet,arg.vdcity,arg.vdpincode,arg.vdemail,arg.vdphone1,arg.vdphone2];
    fields.forEach(function (field) {
        posValues.forEach(function (entry) {
            if (field.value == entry) {
                field.value = "";
                field.style.color = "Black";
            }
        });
    });
}
function resetEditFields(arg)
{
    var fields = [arg.vdname,arg.vdaddress,arg.vdemail,arg.vdphone1,arg.vdphone2];
    fields.forEach(function (field) {
        posValues.forEach(function (entry) {
            if (field.value == entry) {
                field.value = "";
                field.style.color = "Black";
            }
        });
    });
}
function resetDisplayFields(arg)
{
    var fields = [arg.vdname,arg.vdid,arg.vdphone];
    fields.forEach(function (field) {
        posValues.forEach(function (entry) {
            if (field.value == entry) {
                field.value = "";
                field.style.color = "Black";
            }
        });
    });
}


function addVendorFormValidate(arg) {

    resetAddFields(arg);
	if(arg.vdname.value.length == 0 && arg.vdline1.value.length == 0 && arg.vdstreet.value.length == 0 && arg.vdcity.value.length == 0 && arg.vdpincode.value.length == 0 && arg.vdphone1.value.length == 0 && arg.vdcategory.value.length <1)
	{
		alert("Kindly fill in all the mandatory fields.");
		return false;
	}
	else
	{
    if(!validateName(arg.vdname)){
        return false;
    }
    if (!validateLine(arg.vdline1,"line1Error")) {
        return false;
    }
   
	if(arg.vdline2.value.length!=0){
    if (!validateLine(arg.vdline2, "line2Error"))
        return false;
    }
	if (!validateLine(arg.vdstreet,"streetError")) {
        return false;
    }
	if (!validateCity(arg.vdcity)) {
        return false;
    }
	if (!validatePincode(arg.vdpincode)) {
        return false;
    }
    if (!validateEmail(arg.vdemail)) {
        return false;
    }
    if (!validatePhone(arg.vdphone1,"phoneError1")) {
        return false;
    }
    if(arg.vdphone2.length!=0){
    if (!validatePhone(arg.vdphone2, "phoneError2"))
        return false;
    }
    if(!validateCategory(arg.vdcategory))
        {
            return false;
        }
    }
    return true;
}
function editVendorFormValidate(arg)
{ resetEditFields(arg);
    if(!validateName(arg.vdname)){
        return false;
    }
    if(!validateAddress(arg.vdaddress))
        {
            return false;
        }
    if (!validateEmail(arg.vdemail)) {
        return false;
    }
    if (!validatePhone(arg.vdphone1,"phoneError1")) {
        return false;
    }
    if(arg.vdphone2.length!=0){
    if (!validatePhone(arg.vdphone2, "phoneError2"))
        return false;
    }
    return true;
}
    

function editFormValidate(arg){
    resetDisplayFields(arg);
    if (arg.vdid.value.length != 0) {
        if (!validateID(arg.vdid)) {
            return false;
        }
    }
    else if(arg.vdname.value.length != 0 && arg.vdphone.value.length != 0)
    {
        if (!validateName(arg.vdname,"nameError")) {
            return false;
        }
        if (!validatePhone(arg.vdphone, "phoneError")) {
            return false;
        }
    }
    else{
        alert(" Kindly fill in the required fields");
		return false;
    }
	return true;}

function vendorDetailsFormValidate(arg) {
    resetDisplayFields(arg);
	if(arg.vdid.value.length == 0 && arg.vdname.value.length == 0 && arg.vdphone.value.length == 0)
	{
		alert("Kindly fill in atleast one of the fields.");
		return false;
	
	}
    if (arg.vdid.value.length != 0) {
        if (!validateID(arg.vdid)) {
            return false;
        }
    }
    else if(arg.vdname.value.length == 0 && arg.vdphone.value.length == 0)
    {
        if (!validateName(arg.vdname,"nameError")) {
            return false;
        }
        if (!validatePhone(arg.vdphone, "phoneError")) {
            return false;
        }
    }
    else if(arg.vdname.value.length == 0 && arg.vdphone.value.length == 0 && arg.vdid.value.length != 0){
        alert("Kindly fill the required fields");
		return false;
    }
	return true;
}

function vendorListFormValidate(form)
{
	if(form.catId.value == 'select' && form.itemId.value == 'select') {
		alert("Kindly fill at least one field.");
		return false;
	}
	return true;
	
}

function fieldFocusGained(arg)
{
    var match = false;
    posValues.forEach(function (entry) {
        if (arg.value == entry) {
            fieldValue = arg.value;
            arg.value = "";
            arg.style.color = "Black";
            return;
        }
    });
}

function fieldFocusLost(arg)
{
    if(arg.value == ""){
        arg.value = fieldValue;
        arg.style.color = "Gray";
    }
    fieldValue="";
}

function displayPersonal()
{
    var po = document.getElementById('po');
    var per = document.getElementById('personal');
    po.style.display = 'none';
    per.style.display = 'block';
}

function displayPO()
{
    var po = document.getElementById('po');
    var per = document.getElementById('personal');
    per.style.display = 'none';
    po.style.display = 'block';
}