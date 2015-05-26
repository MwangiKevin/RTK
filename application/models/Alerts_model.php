<?php

/**
* 
*/
class ALerts_model extends CI_Model
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

}

?>