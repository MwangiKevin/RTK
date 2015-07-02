<?php

/**
* 
*/
class Counties_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from counties";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select id,county,zone from counties where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from counties where county='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_rca_county($user_id)
	{
		$sql = "select county from rca_county where rca = '$user_id'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

}

?>