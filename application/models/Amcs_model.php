<?php

/**
* 
*/
class Amcs_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from counties";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from counties where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from counties where county='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_county_amc($county_id)
	{
		$sql = "select lab_commodities.id,lab_commodities.commodity_name,sum(facility_amc.amc) as amc 
			    from  lab_commodities,facility_amc,facilities,districts,counties 
			    where  lab_commodities.id = facility_amc.commodity_id and lab_commodities.category = '1' 
			    and facility_amc.facility_code = facilities.facility_code and facilities.district = districts.id 
			    and districts.county = counties.id and counties.id = '$county_id'
			    group by lab_commodities.id order by lab_commodities.id asc";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_district_amc($district_id)
	{
		$sql = "select lab_commodities.id,lab_commodities.commodity_name,sum(facility_amc.amc) as amc 
			    from  lab_commodities,facility_amc,facilities,districts,counties 
			    where  lab_commodities.id = facility_amc.commodity_id and lab_commodities.category = '1' 
			    and facility_amc.facility_code = facilities.facility_code and facilities.district = districts.id 
			    and districts.id = '$district_id'
			    group by lab_commodities.id order by lab_commodities.id asc";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

}

?>