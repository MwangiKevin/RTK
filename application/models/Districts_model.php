<?php

/**
* 
*/
class Districts_model extends CI_Model
{

	function get_all()
	{
		$sql = "select * from districts";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from districts where id='$id'";		
		$result = $this->db->query($sql)->result_array();		
		return $result[0];
	}

	function get_details_from_id($id)
	{
		$sql = "select * from districts where id='$id'";		
		$result = $this->db->query($sql)->result_array();		
		return $result;
	}

	function get_one_name($name)
	{
		$sql = "select * from districts where district='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_scmlt_districts($user_id)
	{
		$sql = "SELECT * from scmlt_districts,districts where scmlt_districts.district=districts.id
            	and scmlt_districts.dmlt='$user_id'";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}

	function get_current_scmlt_district($user_id)
	{
		$sql = "SELECT * from user,districts where user.district=districts.id and user.id= '$user_id'";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}

	function get_all_from_county($county_id){
		$sql = "SELECT DISTINCT districts.* FROM districts,counties WHERE districts.county= '$county_id'";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}

	function get_first_from_county($county_id){
		$sql = "SELECT districts.* FROM districts,counties WHERE districts.county= '$county_id' LIMIT 0,1";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}
}

?>