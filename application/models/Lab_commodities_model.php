<?php

/**
* 
*/
class Lab_commodities_model extends CI_Model
{
	function get_all() 
	{
		$sql = "select * from lab_commodities";
		$categories = $this->db->query($sql)->result_array();
		return $categories;
	}

	function get_all_from_id($id) 
	{
		$sql = "select * from lab_commodities where id='$id'";
		$categories = $this->db->query($sql)->result_array();
		return $categories;
	}
	function get_active() 
	{
		$sql = "select * from lab_commodities where category='1' order by id asc";
		$commodities = $this->db->query($sql)->result_array();		
		return $commodities;
	}

}

?>