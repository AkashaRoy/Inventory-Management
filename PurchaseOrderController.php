<?php
include_once 'PurchaseOrderModel.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_orderController
 *
 * @author kiit
 */
class PurchaseOrderController {
 
     function getPurchase_orderForVendor()
    {
        $purchase_orderModelObj = new PurchaseOrderModel();
        $result = $purchase_orderModelObj->fetchPurchase_orderForVendor(func_get_arg(0));
		$index=0;
		$array=NULL;
		while($row=mysqli_fetch_array($result))
		{
			$array[$index] = $row;
			$index++;
		}
		return $array;
    }
}

?>