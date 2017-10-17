var fieldValue = "";
var posValues = ["Ex:-Ram Singh","Enter Your Address","Ex:-12","Ex:-9898989898","Ex:-ram@gmail.com","Ex:-Big Bazaar","Ex:-KIIT Square,Patia","Ex:-Street No-12","Ex:-Bhubaneswar","Ex:-751024","Ex:-247"];

function validateIssueToStudentForm(form)
{
    resetIssueToStudFields(form);
    if (form.quantity.value.length < 1 && form.sID.value.length < 1) {
        alert("Kindly fill the mandatory fields");
        return false;
    }
    if (!validateDropdown(form.item,"itemError"))
        return false;
    if(!validateStudentID(form.sID))
        return false;
    if(!validateQuantity(form.quantity))
        return false;
    return true;
}

function validateIssueToDeptForm(form)
{
    resetIssueToDeptFields(form);
    if(form.quantity.value.length < 1) {
        alert("Kindly fill the mandatory fields");
        return false;
    }
    if (!validateDropdown(form.dept,"deptError"))
        return false;
    if (!validateDropdown(form.item,"itemError"))
        return false;
    if (!validateQuantity(form.quantity))
        return false;
    return true;
}

function validateDropdown(arg, string)
{
    document.getElementById(string).innerHTML = "";
    if (arg.value == "select") {
        document.getElementById(string).innerHTML = "Please select a value";
        return false;
    }
    return true;
}

function validateQuantity(quan)
{
    document.getElementById('quantityError').innerHTML = '';
    quantity = quan.value;
    if(quantity.length < 1)
    {
        document.getElementById('quantityError').innerHTML = 'Invalid Quantity';
        return false;
    }
    if(quantity < 1)
    {
        document.getElementById('quantityError').innerHTML = 'Invalid Quantity';
        return false;
    }
    for (i = 0; i < quantity.length; i++) {
        if (quantity.charCodeAt(i) < 47 || quantity.charCodeAt(i) > 58) {
            document.getElementById('quantityError').innerHTML = 'Invalid Quantity';
            return false;
        }
    }
    return true;
}

function validateStudentID(ID)
{
    document.getElementById('studentIDError').innerHTML = '';
    studID = ID.value;
    if(studID.length < 1)
    {
        document.getElementById('studentIDError').innerHTML = 'Invalid ID';
        return false;
    }
    for (i = 0; i < studID.length; i++) {
        if (studID.charCodeAt(i) < 47 || studID.charCodeAt(i) > 58) {
            document.getElementById('studentIDError').innerHTML = 'Invalid ID';
            return false;
        }
    }
    return true;
}

function validateDept(arg)
{
    document.getElementById("deptError").innerHTML = "";
    if (arg.value.length < 1) {
        document.getElementById("deptError").innerHTML = "Choose a department";
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

function resetIssueToDeptFields(arg)
{
    posValues.forEach(function (entry) {
        if (arg.quantity.value == entry) {
            arg.quantity.value = "";
            arg.quantity.style.color = "Black";
        }
    });
}

function resetIssueToStudFields(arg)
{
    var fields = [arg.sID,arg.quantity];
    fields.forEach(function (field) {
        posValues.forEach(function (entry) {
            if (field.value == entry) {
                field.value = "";
                field.style.color = "Black";
            }
        });
    });
}

function validateItemIssuedToStudentForm(form)
{
    if (form.sID.value == "Ex:-247")
        form.sID.value = "";
    if (!validateStudentID(form.sID))
        return false;
    return true;
}

function validateItemIssuedToDepartmentForm(form)
{
    if (!validateDropdown(form.deptID,"deptIDError"))
        return false;
    return true;
}

function validateGetIssueDetailsForm(form)
{
    if (form.itemID.value == 'select' && form.categoryID.value == 'select' && form.day.value == 'select' && form.month.value == 'select' && form.year.value == 'select') {
        alert("Kindly fill at least one field.");
        return false;
    }
/*    if(form.day.value != 'select' && form.month.value != 'select' && form.year.value != 'select') {
        var today = new Date();
        if(form.year.value > today.getFullYear) {
            alert("Date cannot be greater than today.");
            return false;
        }
        if(form.year.value == today.getFullYear) {
            if(form.month.value > today.month) {
                alert("Date cannot be greater than today.");
                return false;
            }
            if(form.month.value == today.getMonth) {
                if(form.year.day > today.getDay) {
                    alert("Date cannot be greater than today.");
                    return false;
                }
            }
        }
    }*/
    return true;
}

function validateDate(day,month,year,string)
{
    var today = new Date();
    document.getElementById(string).innerHTML = "";
    if(day.value == "select" && month.value == "select" && year.value == "select")
    {
        document.getElementById(string).innerHTML = "Invalid Date";
        return false;
    }
    if(day.value != "select" && month.value != "select" && year.value != "select")
    {
        if(year.value <= today.getYear && month.value <= today.getMonth && day.value <= today.getDay) {
        
        }
        else {
            document.getElementById(string).innerHTML = "Invalid Date";
        }
    }
    return true;
}