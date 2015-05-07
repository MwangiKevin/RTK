<?php

/**
* 
*/
class Lab_commodity_categories_model extends CI_Model
{
	function get_all() 
	{
		$sql = "select * from lab_commodity_categories order by id asc";
		$categories = $this->db->query($sql)->result_array();
		return $categories;
	}
	function get_active() 
	{
		$sql = "select * from lab_commodity_categories where active='1' order by id asc";
		$categories = $this->db->query($sql)->result_array();		
		return $categories;
	}

}

?>