
<script src="Script.js"></script>
<link rel="stylesheet" href="StyleSheet.css" type="text/css">
<?php
	
    include_once 'StockUI.php';
    include_once 'template.php';
    $StockUIobj=new StockUI();
    if(empty($_GET) || !isset($_GET))
    {
	    if(empty($_POST) || !isset($_POST))
		    echo $StockUIobj->stockIssueToDeptForm();
	    else {
		    echo $StockUIobj->onStockIssueToDeptFormSubmit();
	    }
    }
    else if(isset($_GET['choice']) && $_GET['choice']=="student")
    {
	    if(empty($_POST) || !isset($_POST))
		    echo $StockUIobj->stockIssueToStudForm();
	    else {
		    echo $StockUIobj->onStockIssueToStudFormSubmit();
	    }
    }
    else if(isset($_GET['choice']) && $_GET['choice']=="dept")
    {
	    if(empty($_POST) || !isset($_POST))
		    echo $StockUIobj->stockIssueToDeptForm();
	    else {
		    echo $StockUIobj->onStockIssueToDeptFormSubmit();
	    }
    }
	include_once 'footer.php';
?>
    </body>
</html>