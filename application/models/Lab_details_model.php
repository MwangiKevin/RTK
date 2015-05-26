<?php

/**
* 
*/
class Lab_details_model extends CI_Model
{
	function get_all() 
	{
		$sql = "select * from lab_commodity_categories order by id asc";
		$categories = $this->db->query($sql)->result_array();
		return $categories;
	}

	function get_all_old($order_id) 
	{
		$sql = "select * from lab_commodity_details_old where order_id = '$order_id' order by id asc";
		$details = $this->db->query($sql)->result_array();
		return $details;
	}
	function get_active() 
	{
		$sql = "select * from lab_commodities where category='1' order by id asc";
		$commodities = $this->db->query($sql)->result_array();		
		return $commodities;
	}

	function get_all_from_order($order_id)
	{
		$sql = "SELECT * FROM lab_commodity_details, counties, facilities, districts,
				lab_commodity_orders, lab_commodity_categories, lab_commodities
        		WHERE lab_commodity_details.facility_code = facilities.facility_code
        		AND counties.id = districts.county
        		AND facilities.facility_code = lab_commodity_orders.facility_code
        		AND lab_commodity_details.commodity_id = lab_commodities.id
        		AND lab_commodity_categories.id = lab_commodities.category
        		AND facilities.district = districts.id
        		AND lab_commodity_details.order_id = lab_commodity_orders.id
        		AND lab_commodity_orders.id = '$order_id'";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}

	function get_begining_balance($mfl) 
	{
		$result_bal = array();
	    $start_date_bal = date('Y-m-d', strtotime("first day of previous month"));
	    $end_date_bal = date('Y-m-d', strtotime("last day of previous month"));
	    $sql_bal = "SELECT lab_commodity_details.closing_stock from lab_commodity_orders, lab_commodity_details 
	    where lab_commodity_orders.id = lab_commodity_details.order_id 
	    and lab_commodity_orders.order_date between '$start_date_bal' and '$end_date_bal' 
	    and lab_commodity_orders.facility_code='$mfl'";

	    $res_bal = $this->db->query($sql_bal)->result_array();

	    foreach ($res_bal as $row_bal) {
	        array_push($result_bal, $row_bal['closing_stock']);
	    }
	    return $result_bal;
	}

	function save_order_details($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

	function save_order_details_old($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

}

?>