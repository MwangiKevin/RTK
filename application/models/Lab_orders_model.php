<?php

/**
* 
*/
class Lab_orders_model extends CI_Model
{
	function get_recent_lab_orders($mfl)
	{	
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$sql = "select facility_code, order_date from lab_commodity_orders where facility_code='$mfl' and order_date between '$first_date' AND NOW()";
		// echo "$sql";die();
		$result = $this->db->query($sql)->result_array();
		$result_count = count($result);
		return $result_count;
	}

	function get_latest_lab_orders($mfl)
	{	
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$last_date = $current_month_details['last_date_full'];
		$sql = "select distinct id as order_id,order_date from lab_commodity_orders where facility_code='$mfl' and order_date between '$first_date' AND '$last_date'";		
		$result = $this->db->query($sql)->result_array();		
		return $result[0];
	}

	function get_order_details($order_id)
	{	
		$sql = "select * from lab_commodity_orders where id='$order_id'";		
		$result = $this->db->query($sql)->result_array();		
		return $result[0];
	}

	function get_remaining_lab_orders($district)
	{	
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$last_date = $current_month_details['last_date_full'];
		$sql = "SELECT DISTINCT  f.facility_code FROM  facilities f, districts dist
				WHERE f.district = dist.id AND dist.id = '$district'  and
				f.rtk_enabled = '1' and f.facility_code not 
				in(SELECT lab_commodity_orders.facility_code
					FROM lab_commodity_orders,districts d,facilities
            		WHERE lab_commodity_orders.facility_code = facilities.facility_code
					AND facilities.district = d.id
					AND d.id = '$district' 
					AND lab_commodity_orders.order_date between '$first_date' and '$last_date')";				
		$result = $this->db->query($sql)->result_array();			
		return $result;
	}


	function check_if_reported($mfl)
	{	
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];		
		$sql = "select facility_code, order_date from lab_commodity_orders where facility_code='$mfl' and order_date between '$first_date' AND NOW()";		
		$result = $this->db->query($sql)->result_array();
		$result_count = count($result);
		return $result_count;
	}

	function get_district_orders($district){		
		$sql = "select lab_commodity_orders.id, lab_commodity_orders.facility_code, 
				facilities.facility_name,lab_commodity_orders.compiled_by,
				lab_commodity_orders.approved_by,lab_commodity_orders.order_date
				from lab_commodity_orders,districts dist, facilities 
				where lab_commodity_orders.facility_code = facilities.facility_code 
				and facilities.district = dist.id and dist.id = '$district' order by lab_commodity_orders.id desc";
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function save_order($data)
	{
		$this->db->insert('lab_commodity_orders', $data); 
		$order_id = $this->db->insert_id();
		return $order_id;
	}

	function update_order($data,$id)
	{
		$this->db->where('id', $id); 
		$this->db->update('lab_commodity_orders', $data); 		
	}

	function save_order_old($data)
	{
		 $this->db->insert('lab_commodity_orders', $data); 

		
	}


	function get_all_old($a,$b)
	{
		$sql = "select * from lab_commodity_orders_old order by id asc limit $a,$b ";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_county_reports($county_id)
	{
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$last_date = $current_month_details['last_date_full'];
		$sql = "SELECT DISTINCT (lab_commodity_orders.facility_code) as mfl, lab_commodity_orders.*
				FROM   lab_commodity_orders, facilities, districts, counties
				WHERE facilities.facility_code = lab_commodity_orders.facility_code
				AND districts.id = facilities.district
				AND counties.id = districts.county
				AND counties.id = '$county_id'
				AND order_date between '$first_date' and '$last_date'";

		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_late_county_reports($county_id)
	{
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$year = $current_month_details['year'];
		$month = $current_month_details['month'];
		$deadline_date = $this->date_settings->generate_full_date($year,$month,10);
		$last_date = $current_month_details['last_date_full'];
		$sql = "SELECT DISTINCT (lab_commodity_orders.facility_code) as mfl, lab_commodity_orders.*
				FROM   lab_commodity_orders, facilities, districts, counties
				WHERE facilities.facility_code = lab_commodity_orders.facility_code
				AND districts.id = facilities.district
				AND counties.id = districts.county
				AND counties.id = '$county_id'
				AND order_date between '$deadline_date' and '$last_date'";

		$result = $this->db->query($sql)->result_array();
		return $result;
	}	

	function get_all_district_reports($district_id)
	{
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$last_date = $current_month_details['last_date_full'];
		$sql = "SELECT DISTINCT (lab_commodity_orders.facility_code) as mfl, lab_commodity_orders.*
				FROM   lab_commodity_orders, facilities, districts, counties
				WHERE facilities.facility_code = lab_commodity_orders.facility_code
				AND districts.id = facilities.district				
				AND districts.id = '$district_id'
				AND order_date between '$first_date' and '$last_date'";

		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_late_district_reports($district_id)
	{
		$this->load->model('Date_settings_model','date_settings');
		$current_month_details = $this->date_settings->get_current_month();
		$first_date = $current_month_details['first_date_full'];
		$year = $current_month_details['year'];
		$month = $current_month_details['month'];
		$deadline_date = $this->date_settings->generate_full_date($year,$month,10);
		$last_date = $current_month_details['last_date_full'];
		$sql = "SELECT DISTINCT (lab_commodity_orders.facility_code) as mfl, lab_commodity_orders.*
				FROM   lab_commodity_orders, facilities, districts, counties
				WHERE facilities.facility_code = lab_commodity_orders.facility_code
				AND districts.id = facilities.district
				AND districts.id = facilities.district				
				AND districts.id = '$district_id'
				AND order_date between '$deadline_date' and '$last_date'";

		$result = $this->db->query($sql)->result_array();
		return $result;
	}
}	
?>