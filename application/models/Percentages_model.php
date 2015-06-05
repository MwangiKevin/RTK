<?php

/**
* 
*/
class Percentages_model extends CI_Model
{
	                
   
    
	function get_district_percentages_county($county_id)
	{
		$month = date('mY', strtotime('-1 month'));
		$m =substr($month, 0,2);
		$y = substr($month, 2);
		$new_month = $y.'-'.$m.'-01';
		$d = new DateTime("$new_month");    
		$d->modify( 'last day of next month' );
		$month_db =  $d->format( 'mY' );  

		$sql ="select rtk_district_percentage.percentage,districts.district from rtk_district_percentage,districts,counties
    	where rtk_district_percentage.district_id = districts.id and districts.county = counties.id and counties.id = '$county_id' 
        and rtk_district_percentage.month = '$month_db'";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}


	function get_county_percentage($county_id)
	{
		$month = date('mY', strtotime('-1 month'));
		$m =substr($month, 0,2);
		$y = substr($month, 2);
		$new_month = $y.'-'.$m.'-01';
		$d = new DateTime("$new_month");    
		$d->modify( 'last day of next month' );
		$month_db =  $d->format( 'mY' );  

		$sql ="select * from rtk_county_percentage
    			where county_id = '$county_id'  and month = '$month_db'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}


	function get_district_percentage($district_id)
	{		
		$month = date('mY', strtotime('-1 month'));
		$m =substr($month, 0,2);
		$y = substr($month, 2);
		$new_month = $y.'-'.$m.'-01';
		$d = new DateTime("$new_month");    
		$d->modify( 'last day of next month' );
		$month_db =  $d->format( 'mY' );  

		$sql = "select * from rtk_district_percentage where district_id='$district_id' and month='$month_db'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_partner_percentage($partner_id)
	{
		$sql = "select * from counties where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

}

?>