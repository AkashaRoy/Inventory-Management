$(function () {
    var fontWeight = "";
    var padding = "";
    var size = "";
    $("table").find("tr:first").attr("class", "noborder");
    $("table").attr("align", "center");
    $("table").attr("border", "0");
    $("table").attr("cellspacing", "0");
    $("td :submit").parent('td').parent('tr').attr("class", "noborder");
    $("td :reset").parent('td').parent('tr').attr("class", "noborder");
    $("table").css("font-family", "Cambria");
    if ($(":input[type=submit]").length < 1) {
        stripeRows();
    }
    if ($("filter").length > 0) {
        if ($("tr").length > 0) {
            createSearchFilter();
        }
        /*        $("tr:visible").each(function (i) {
        if ((i + 1) % 2 == 0) {
        $(this).addClass('roweven');
        }
        else {
        $(this).addClass('rowodd');
        }
        });

        $(".roweven").css("background", "#D0D0D0");
        $(".roweven").hover(function () {
        $(this).css("background", "#afcde3");
        }, function () {
        $(this).css("background", "#D0D0D0");
        });
        $(".rowodd").not("tr:first").hover(function () {
        $(this).css("background", "#afcde3");
        }, function () {
        $(this).css("background", "");
        });*/
    }

    $("td").attr("align", "left");


    /*For Search Filter*/

    //Declare the custom selector 'containsIgnoreCase'.
    $.expr[':'].containsIgnoreCase = function (n, i, m) {
        return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };

    $("#searchInput").keyup(function () {

        $("table").find("tr").not("tr:first").not(".noborder").hide();
        var data = this.value.split(" ");
        var jo = $("table").find("tr");
        $.each(data, function (i, v) {
            //Use the new containsIgnoreCase function instead
            jo = jo.filter("*:containsIgnoreCase('" + v + "')");
        });
        jo.show();
        removeStripeRows();
        stripeRows();

    }).focus(function () {
        this.value = "";
        $(this).css({ "color": "black" });
        $(this).unbind('focus');
        removeStripeRows();
        stripeRows();
    }).css({ "color": "#C0C0C0" });

});


function createSearchFilter()
{
    var temp = $("#page");
    $("<input type=text id=searchInput placeholder='Type to filter..'/>").prependTo(temp);
    $("#searchInput").css("margin","5px");
    $("#searchInput").css("border-color","#afcde3");
    $("#searchInput").css("border","2px solid #afcde3");
    $("#searchInput").css("line-height","1.8em");
    $("#searchInput").css("border-radius","10px");
    $("#searchInput").css("font-size","medium");
    $("#searchInput").css("width","40em");
    $("#searchInput").css("outline","0");
    $("#searchInput").css("padding","2px");
}

function stripeRows()
{
    $("tr:first").css("font-weight", "bold");
    $("tr:visible").each(function (i) {
        if ((i + 1) % 2 == 0) {
            $(this).addClass('roweven');
        }
        else {
            $(this).addClass('rowodd');
        }
    });
    $(".roweven").css("background", "#D0D0D0");
    $(".roweven").hover(function () {
        $(this).css("background", "#afcde3");
    }, function () {
        $(this).css("background", "#D0D0D0");
    });
    $(".rowodd").not("tr:first").hover(function () {
        $(this).css("background", "#afcde3");
    }, function () {
        $(this).css("background", "");
    });
}

function removeStripeRows()
{
    $("tr:first").css("font-weight", "normal");
    $(".roweven").css("background", "");
    $(".roweven").hover(function () {
        $(this).css("background", "#afcde3");
    }, function () {
        $(this).css("background", "");
    });
    $(".rowodd").not("tr:first").hover(function () {
        $(this).css("background", "#afcde3");
    }, function () {
        $(this).css("background", "");
    });
    $("tr:visible").each(function (i) {
    
            $(this).removeClass('roweven');
            $(this).removeClass('rowodd');
    });
}


function printPage()
{
    $("header").css("display", "none");
    $("footer").css("display", "none");
    $("button").css("display", "none");
    $("#searchInput").css("display", "none");
    $("table").attr("width", "100%");
    $("table").attr("cellspacing", "10");
    window.print();
    $("header").css("display", "block");
    $("footer").css("display", "block");
    $("button").css("display", "inline-block");
    $("#searchInput").css("display", "inline-block");
}