<?php
include_once 'Database.php';

class IndentItemModel extends Database
{
	function fetchDeliveryDetails()
    {
        $purchase_orderID=func_get_arg(0);
        /*                $host = 'localhost';        $user = 'root';        $password = '';        $database = 'vocational_training';        $link = parent::connectToDB();*/        $con = parent::connectToDB();
        $query="SELECT purchase_order.purchase_order_id AS `POid`, purchase_order.status AS `status`,
			`name_brand` AS `name`, `quantity` FROM `purchase_order` 
			JOIN  `indent_item` ON purchase_order.purchase_order_id=indent_item.purchase_order_id 
			JOIN `item` ON indent_item.item_id=item.item_id
			WHERE purchase_order.purchase_order_id=$purchase_orderID";
        $result=mysqli_query($con,$query);
		return $result;
    }
}

?>