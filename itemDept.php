<?php
    
    include_once 'stockUI.php';
    include_once 'template.php';
    $stockUIObj = new StockUI();
    if(!isset($_POST) || empty($_POST)) {
        if(isset($_GET['all']) && $_GET['all']=='true') {
            echo $stockUIObj->displayIssueDetailsOfAllDepartments();
        }
        else {
            echo $stockUIObj->itemIssuedToDeptForm();
        }
    }
    else {
        echo $stockUIObj->onItemIssuedToDeptFormSubmit();
    }

    include_once 'footer.php';
?>