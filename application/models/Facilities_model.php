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
}

?>