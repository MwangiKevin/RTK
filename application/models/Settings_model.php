<?php

/**
* get all data regarding system setting such as deadlines, alerts, commodities....
*/
class Settings_model extends CI_Model
{
	function deadlines(){
		$sql = "select rtk_settings.*, user.fname,user.lname from rtk_settings, user where rtk_settings.user_id = user.id ";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}
	function alerts(){
		$sql = "select rtk_alerts.*,rtk_alerts_reference.id as ref_id,rtk_alerts_reference.description as description from rtk_alerts,rtk_alerts_reference where rtk_alerts.reference=rtk_alerts_reference.id order by id ASC,status ASC";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}
	
}

?>