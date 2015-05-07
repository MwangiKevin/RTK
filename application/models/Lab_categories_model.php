<?php

/**
* 
*/
class Lab_categories_model extends CI_Model
{
	function get_all() 
	{
		$sql = "select * from lab_commodity_categories order by id asc";
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