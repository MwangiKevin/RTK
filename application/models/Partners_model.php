<?php

/**
* 
*/
class Partners_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from partners";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from partners where ID='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from partners where name='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

}

?>