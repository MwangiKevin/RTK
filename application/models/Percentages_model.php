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


	function reporting_rates($County = NULL,$year = NULL, $month = NULL) {
	    if ($year == NULL) {
	        $year = date('Y', time());
	        $month = date('m', time());
	    }
	    $from = '';
	    $conditions = '';
	    if($County!=NULL){
	        $from = ',districts,counties';
	        $conditions .="and lab_commodity_orders.district_id= districts.id and districts.county = counties.id and counties.id = $County";
	    }
	    $firstdate = $year . '-' . $month . '-01';
	    $month = date("m", strtotime("$firstdate"));
	    $year = date("Y", strtotime("$firstdate"));
	    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	    $lastdate = $year . '-' . $month . '-' . $num_days;
	    $firstdate = $year . '-' . $month . '-01';

	    $sql = "select 
	    lab_commodity_orders.order_date as order_date,
	    count(distinct lab_commodity_orders.facility_code) as count
	    from
	    lab_commodity_orders $from
	    WHERE
	    lab_commodity_orders.order_date between '$firstdate' and '$lastdate' $conditions
	    Group BY lab_commodity_orders.order_date";   

	    // echo "$sql";die();
	    $res = $this->db->query($sql)->result_array();
	    return $res;
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

	function get_all_county_percentage_month($month)
	{
		$sql = "SELECT sum(facilities) as facilities, sum(reported) as reported FROM `rtk_county_percentage` WHERE month='$month'";		
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_all_county_percentage()
	{
		$month = date('mY', strtotime('-1 month'));
		$m =substr($month, 0,2);
		$y = substr($month, 2);
		$new_month = $y.'-'.$m.'-01';
		$d = new DateTime("$new_month");    
		$d->modify( 'last day of next month' );
		$month_db =  $d->format( 'mY' );  

		$sql ="select * from rtk_county_percentage
    			where month = '$month_db'";
    			echo "$sql";
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