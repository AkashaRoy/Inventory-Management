<script src="Script.js"></script>

<?php
    include_once 'stockUI.php';
    include_once 'template.php';
    $stockUIObj = new StockUI();
    if(!isset($_POST) || empty($_POST)) {
        echo $stockUIObj->getIssueDetailsForm();
    }
    else {
        echo $stockUIObj->onGetIssueDetailsFormSubmit();
    }
    include_once 'footer.php';
?>