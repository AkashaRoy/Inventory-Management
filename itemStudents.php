<script src="Script.js"></script>
<?php
    include_once 'stockUI.php';
    include_once 'template.php';
    $stockUIObj = new StockUI();
    if(!isset($_GET) || empty($_GET)) {
        echo $stockUIObj->itemIssuedToStudentForm();
    }
    else if(isset($_GET['all']) && $_GET['all']=='true') {
        echo $stockUIObj->displayIssueDetailsOfAllStudents();
    }
    else {
        echo $stockUIObj->onItemIssuedToStudentFormSubmit();
    }
    include_once 'footer.php';
?>