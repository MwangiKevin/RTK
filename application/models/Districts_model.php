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

	function get_one_name($name)
	{
		$sql = "select * from districts where district='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}
}

?>