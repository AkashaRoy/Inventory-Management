<?php
include_once 'Database.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_orderModel
 *
 * @author kiit
 */
class PurchaseOrderModel extends Database
{
   function fetchPurchase_orderForVendor()
    {
        $vendorID=  func_get_arg(0);
        $con = parent::connectToDB();
		$query="SELECT `purchase_order_id`,`status` FROM `purchase_order` WHERE `vendor_id`=$vendorID";
		$result=mysqli_query($con,$query);
		return $result;

	}
}

?>