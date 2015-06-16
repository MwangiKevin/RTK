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

	function get_ending_balance_county($county_id) 
	{		
	    $firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
	    $sql = "SELECT lab_commodities.id, lab_commodities.commodity_name,SUM(lab_commodity_details.closing_stock) AS end_bal
				FROM lab_commodities,lab_commodity_details,districts, counties, facilities
				WHERE  lab_commodities.category = '1' AND lab_commodity_details.commodity_id = lab_commodities.id
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND  lab_commodity_details.facility_code = facilities.facility_code 
        		AND facilities.rtk_enabled = '1' AND facilities.district = districts.id 
        		AND districts.county = counties.id AND counties.id = '$county_id'
				GROUP BY lab_commodities.id
				ORDER BY lab_commodities.id ASC";		
	    $result = $this->db->query($sql)->result_array();
	    return $result;
	}

	function save_order_details($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

	function update_order_details($data,$order_id,$commodity_id){
		$this->db->where('order_id',$order_id);
		$this->db->where('commodity_id',$commodity_id);
		$this->db->update('lab_commodity_details', $data); 		
	}

	function save_order_details_old($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

	function get_county_highest_stocks($commodity_id,$county_id)
	{
    	$firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
	    $sql = "SELECT DISTINCT facilities.facility_code, facilities.facility_name, districts.district,
    			lab_commodity_details.closing_stock FROM  lab_commodity_details, facilities, districts
				WHERE   facilities.facility_code = lab_commodity_details.facility_code    
        		AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND lab_commodity_details.commodity_id = '$commodity_id' AND districts.county = '$county_id'
				HAVING closing_stock > 0 
				ORDER BY lab_commodity_details.closing_stock DESC , facilities.facility_code ASC LIMIT 0 , 5";    		
	    $endbal = $this->db->query($sql)->result_array();	   
	    return $endbal;
	}

	function get_county_highest_expiries($commodity_id,$county_id)
	{
		$firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
		$sql = "SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
            	FROM lab_commodity_details,facilities,districts
            	WHERE   facilities.facility_code = lab_commodity_details.facility_code    
        		AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND lab_commodity_details.commodity_id = '$commodity_id' AND districts.county = '$county_id'
        		having q_expiring>0 order by lab_commodity_details.q_expiring desc,facilities.facility_code asc limit 0,5";    
	    $expiries = $this->db->query($sql)->result_array();
	    return $expiries;
	}

}

?>