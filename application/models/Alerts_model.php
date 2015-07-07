<?php

/**
* 
*/
class Alerts_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from rtk_alerts";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from rtk_alerts where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from counties where county='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_district_alerts()
	{
		$sql = "SELECT message  FROM rtk_alerts, rtk_alerts_reference  WHERE rtk_alerts.reference = rtk_alerts_reference.id and rtk_alerts.status = '1' and rtk_alerts_reference.id = '1'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

}

?>