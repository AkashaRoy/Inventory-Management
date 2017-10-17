<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Inventory Management</title>
        <!link rel="shortcut icon" href="/favicon.ico">
        <!link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="stylesheet" href="StyleSheet.css" media="screen,projection">
        <script src="js/jquery.min.js"></script>
        <script src="onStart.js"></script>
        <script src="js/custom.js"></script>
		
    </head>
    <body>
        <header>
            <div class="wrap">
                <nav align=center>
                    <div id="nav">
                        <ul>
                            <li class="active" menu="1">
                                <a href="index.php" title="Home" onclick="changeActiveMenu('menu-1')">Home</a>
                            </li>
		                    <li class="parent" menu="2">
                                <a>Indent</a>
                                <ul>
                                    <li>
                                        <a href="indent_index.php?id=1">Raise Indent</a>
                                    </li>
                                    <li>
                                        <a href="indent_index.php?id=2">Update Indent</a>
                                    </li>

				                    <li>
                                        <a href="indent_index.php?id=5">Search Indent</a>
                                    </li>
                                </ul>
							<li class="parent">
                                <a>Vendor</a>
                                <ul>
                                    <li>
                                        <a href="addVendor.php">Add Vendor</a>
                                        </li>
                                        <li>
                                            <a href="editVendor.php">Edit Vendor</a>
                                        </li>
                                        <li>
                                            <a href="displayVendorDetails.php">Display Vendor Details</a>
                                        </li>
                                        <li>
                                            <a href="vendorList.php">Display Vendor List</a>
                                        </li>
                                </ul>              
                            </li>
                        	<li class="parent">
                                <a>Purchase Order</a>
                                <ul>
                                    <li>
                                        <a href="indexPO.php?id=1">Create PO</a>
                                        </li>
                                        <li>
                                            <a href="indexPO.php?id=2">Cancel PO</a>
                                        </li>
                                        <li>
                                            <a href="indexPO.php?id=3">Search PO</a>
                                        </li>
                                </ul>              
                            </li>
                            <li class="parent">
                                <a>Stock</a>
                                <ul>
                                    <li>
                                        <a href="index_stock.php">Receive Stock </a>
                                    </li>
                                    <li>
                                            <a href="view.php">View Stock Details</a>
                                    </li>
                                </ul>          
                            </li>
                            <li class="parent">
                                <a>Issue</a>
                                <ul>
                                    <li>
                                        <a href="issue.php?choice=dept">Issue to Department</a>
                                    </li>
                                    <li>
                                        <a href="issue.php?choice=student">Issue to Student</a>
                                    </li>
                                    <li>
                                        <a href="itemStudents.php">Items issued to Students</a>
                                    </li>
                                    <li>
                                        <a href="itemDept.php">Items issued to Departments</a>
                                    </li>
                                    <li>
                                        <a href="issueDetails.php">Get Issue Details</a>
                                    </li>
                                </ul>              
                            </li>
<!--                            <li>
                                <a href="help.php">Help</a>
                            </li>
-->
                        </ul> 
                    </div>
                </nav>
            </div>
        </header>
        <div style="clear:both;"></div>
        <div id=page>