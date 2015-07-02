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
		return $result;
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
		$return = null;
		$count = count($result);
		if($count>0){
			$return = $result[0];
		}else{
			$return = 0;
		}
		return $return;
	}

	function get_partner_percentage($partner_id)
	{
		$sql = "select * from counties where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function set_up_district_percentages()
	{
		$this->load->model('Facilities_model','facilities_model');
		$sql = "select * from districts";
		$districts = $this->db->query($sql)->result_array();
		$db_month = date('mY');		
		foreach ($districts as $key => $value) {
			$district_id = $value['id'];
			$sql_check = "select * from rtk_district_percentage where district_id='$district_id' and month='$db_month'";
			$result_check = $this->db->query($sql_check)->result_array();			
			$count_res = count($result_check);
			if($count_res!=0){
				$this->update_district_percentage($district_id,0);
			}else{
				$dist_facilities = $this->facilities_model->count_all_reporting_in_district($district_id);				
				$sql_ins = "INSERT INTO `rtk_district_percentage`(`id`, `district_id`, `facilities`, `reported`, `percentage`, `month`) 
							VALUES (null,'$district_id','$dist_facilities','0','0','$db_month')";
				$this->db->query($sql_ins);
			}

		}
	}

	function set_up_county_percentages()
	{
		$this->load->model('Facilities_model','facilities_model');
		$sql = "select * from counties";
		$counties = $this->db->query($sql)->result_array();
		$db_month = date('mY');		
		foreach ($counties as $key => $value) {
			$county_id = $value['id'];
			$sql_check = "select * from rtk_county_percentage where county_id='$county_id' and month='$db_month'";
			$result_check = $this->db->query($sql_check)->result_array();			
			$count_res = count($result_check);
			if($count_res!=0){
				$this->update_district_percentage($county_id,0);
			}else{
				$county_facilities = $this->facilities_model->count_all_reporting_in_district($county_id);				
				$sql_ins = "INSERT INTO `rtk_county_percentage`(`id`, `county_id`, `facilities`, `reported`, `percentage`, `month`) 
							VALUES (null,'$county_id','$county_facilities','0','0','$db_month')";
				$this->db->query($sql_ins);
			}

		}
	}

	function update_district_percentage($district_id,$type){
		$db_month = date('mY');				
		$this->load->model('Facilities_model','facilities_model');		
		$this->load->model('Lab_orders_model','lab_orders_model');
		$reported_facilities = $this->lab_orders_model->count_all_reported_district($district_id);
		$dist_facilities = $this->facilities_model->count_all_reporting_in_district($district_id);						
		if($type==1){
			$reported_facilities+=1;
		}else if($type==2){
			$reported_facilities-=1;			
		}
		$percentage = 0;
		if($dist_facilities==0){
			$percentage = 0;
		}else{
			$percentage = ceil(($reported_facilities/$dist_facilities)*100);
		}
		
		$sql = "update rtk_district_percentage set reported = '$reported_facilities',percentage='$percentage' where district_id='$district_id' and month='$db_month'";
		$this->db->query($sql);

	}	

	function update_county_percentage($county_id,$type){
		$db_month = date('mY');				
		$this->load->model('Facilities_model','facilities_model');		
		$this->load->model('Lab_orders_model','lab_orders_model');
		$reported_facilities = $this->lab_orders_model->count_all_reported_county($county_id);
		$county_facilities = $this->facilities_model->count_all_reporting_in_county($county_id);						
		if($type==1){
			$reported_facilities+=1;
		}else if($type==2){
			$reported_facilities-=1;			
		}
		$percentage = 0;
		if($county_facilities==0){
			$percentage = 0;
		}else{
			$percentage = ceil(($reported_facilities/$county_facilities)*100);
		}
		
		$sql = "update rtk_county_percentage set reported = '$reported_facilities',percentage='$percentage' where county_id='$county_id' and month='$db_month'";
		$this->db->query($sql);

	}	

}

?>