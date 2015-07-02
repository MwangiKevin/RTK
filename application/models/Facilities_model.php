<?php

/**
* 
*/
class Facilities_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from facilities";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from facilities where id='$id' and rtk_enabled='1'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from facilities where facility_name like %'$name'% and rtk_enabled='1'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_mfl($mfl)
	{
		$sql = "select * from facilities where facility_code ='$mfl' and rtk_enabled='1'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_in_county($county_id)
	{
		$sql = "select * from facilities";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_in_district($district_id)
	{
		$sql = "select * from facilities where rtk_enabled='1' and district='$district_id'";		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_first_in_district($district_id)
	{
		$sql = "select * from facilities where rtk_enabled='1' and district='$district_id' LIMIT 0,1";		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_reporting_in_district($district_id)
	{
		$sql = "select * from facilities where rtk_enabled='1' and district='$district_id'";
		$result = $this->db->query($sql)->result_array();		
		return $result;
	}

	function get_all_nonreporting_in_district($district_id)
	{
		$sql = "select * from facilities where rtk_enabled='0' and district='$district_id'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_total_in_district($district_id)
	{
		$sql = "select * from facilities where district='$district_id'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_reporting_in_county($county_id)
	{
		$sql = "select * from facilities where rtk_enabled='1' 
		and facilities.district in (select districts.id from districts where districts.county = '$county_id')";				
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_all_nonreporting_in_county($county_id)
	{
		$sql = "select * from facilities where rtk_enabled='0' 
		and facilities.district in (select districts.id from districts where districts.county = '$county_id'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_total_in_county($county_id)
	{
		$sql = "select * from facilities where facilities.district in (select districts.id from districts where districts.county = '$county_id'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function change_reporting_status($mfl,$type)
	{
		$sql = "update facilities set rtk_enabled = '$type' where facility_code='$mfl'";		
		$this->db->query($sql);
	}

	function monthly_facility_reports($mfl, $monthyear = null)
	{
	    $conditions = '';
	    if (isset($monthyear)) {
	        $year = substr($monthyear, -4);
	        $month = substr_replace($monthyear, "", -4);
	        $firstdate = $year . '-' . $month . '-01';
	        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	        $lastdate = $year . '-' . $month . '-' . $num_days;
	        $conditions=" AND lab_commodity_orders.order_date
	        BETWEEN  '$firstdate'
	        AND  '$lastdate'";
	    }

	    $sql = "select distinct lab_commodity_orders.order_date,lab_commodity_orders.compiled_by,lab_commodity_orders.id,
	    facilities.facility_name,districts.district,districts.id as district_id, counties.county,counties.id as county_id
	    FROM lab_commodity_orders,facilities,districts,counties
	    WHERE lab_commodity_orders.facility_code = facilities.facility_code
	    AND facilities.district = districts.id
	    AND counties.id = districts.county
	    AND facilities.facility_code =$mfl $conditions 
	    group by lab_commodity_orders.order_date";        


	    $sql .=' Order by lab_commodity_orders.order_date desc';
	    // echo "$sql";die();
	    $res = $this->db->query($sql);
	    $sum_facilities = array();
	    $facility_arr = array();

	    foreach ($res->result_array() as $key => $value) {
	        $facility_arr = $value;
	        $details = $this->fcdrr_values($value['id']);       
	        array_push($facility_arr, $details);
	        array_push($sum_facilities, $facility_arr);
	    }
	   
	    return $sum_facilities;
	}
	function fcdrr_values($order_id, $commodity = null)
	{  
	    $q = "SELECT * 
	    FROM lab_commodities, lab_commodity_details_old, facility_amc
	    WHERE lab_commodity_details_old.order_id ='$order_id'
	    AND facility_amc.facility_code = lab_commodity_details_old.facility_code
	    AND facility_amc.commodity_id = lab_commodity_details_old.commodity_id    
	    AND lab_commodity_details_old.commodity_id = lab_commodities.id 
	    AND lab_commodities.category='1'";

	    // echo "$q";die();
	    if (isset($commodity)) {
	        $q = "SELECT * 
	        FROM lab_commodities, lab_commodity_details_old
	        WHERE lab_commodity_details_old.order_id ='$order_id'
	        AND lab_commodity_details_old.commodity_id = lab_commodities.id
	        AND commodity_id='$commodity'";
	    }   
	    // echo "$q";die();
	    $q_res = $this->db->query($q);
	    $returnable = $q_res->result_array();
	    return $returnable;
	}

	function get_all_with_conditions($conditions = null)
	{
		if($conditions==0)
		{
			$conditions = '';
		}
		$sql = "select facilities.id,facilities.partner,counties.county,districts.district,facilities.facility_code,facilities.rtk_enabled,facilities.facility_name from 
				facilities,districts,counties where facilities.district = districts.id and districts.county>0 and districts.county = counties.id $conditions limit 0,50";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function get_all_facilities_county($county_id)
	{		
		$sql = "select facilities.id,districts.district,facilities.district as district_id,facilities.facility_code,facilities.rtk_enabled,facilities.facility_name from 
				facilities,districts where facilities.district = districts.id and districts.county =  '$county_id'";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function count_all_reporting_in_district($district_id)
	{
		$sql = "select count(distinct facility_code) as facilities from facilities where rtk_enabled='1' and district = '$district_id'";		
		$result = $this->db->query($sql)->result_array();
		$count = intval($result[0]['facilities']);
		return $count;
	}

	function count_all_reporting_in_county($county_id)
	{
		$sql = "select count(distinct facility_code) as facilities from facilities,districts,counties 
				where rtk_enabled='1' and facilities.district = districts.id and districts.county = counties.id and counties.id = '$county_id'";		
		$result = $this->db->query($sql)->result_array();
		$count = intval($result[0]['facilities']);
		return $count;
	}
}

?>