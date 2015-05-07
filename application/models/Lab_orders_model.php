<?php

/**
* 
*/
class Lab_orders_model extends CI_Model
{
	function get_recent_lab_orders($mfl)
	{	
		$lastday = date('Y-m', time());
		$lastday = $lastday.'-01';
		$sql = "select facility_code, order_date from lab_commodity_orders where facility_code='$mfl' and order_date between '$lastday' AND NOW()";
		// echo "$sql";die();
		$result = $this->db->query($sql)->result_array();
		$result_count = count($result);
		return $result_count;
	}
}

?>