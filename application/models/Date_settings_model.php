<?php

/**
* 
*/
class Date_settings_model extends CI_Model
{
	function get_all_settings()
	{
		$sql = "select * from rtk_settings";
		$result = $this->db->query($sql)->result_array();		
		return $result;
	}

	function get_deadline_details($zone)
	{
		$sql = "select * from rtk_settings where zone='$zone' and status='0'";
		$result = $this->db->query($sql)->result_array();					
		return $result;
	}

	function get_deadline_date($zone)
	{
		$sql = "select deadline from rtk_settings where zone='$zone' and status='0'";
		$result = $this->db->query($sql)->result_array();			
		$deadline = $result[0]['deadline'];
		return $deadline;
	}

    function get_date_text_previous_month($date)
    {
        $date_text = date('F Y',strtotime('-1 month',strtotime($date)));        
        return $date_text;
    }
	
	function get_previous_month()
	{
		$first_date_full = date('Y-m-d', strtotime("first day of previous month"));
    	$last_date_full = date('Y-m-d', strtotime("last day of previous month"));

        $first_date_slash = date('d/m/Y', strtotime("first day of previous month"));
        $last_date_slash = date('d/m/Y', strtotime("last day of previous month"));

    	$first_day_num = date('d', strtotime("first day of previous month"));
    	$last_day_num = date('d', strtotime("last day of previous month"));

    	$first_day_text = date('D F Y', strtotime("first day of previous month"));
    	$last_day_text= date('D F Y', strtotime("last day of previous month"));

    	$month_year_full = date('mY', strtotime("first day of previous month"));
    	$year = substr($month_year_full, -4);    	
    	$month = substr_replace($month_year_full, "", -4);       	
    	$num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);    		
    	
    	$today = date('Y-m-d', time());
    	$today_last_month = date('d', time());    	
    	$today_last_month_text = date("D F Y", strtotime("$today -1 month"));

        $englishdate = date('F, Y', strtotime("first day of previous month"));

    	$month_year = date('mY', strtotime("first day of previous month"));
    	$previous_month = array('first_date_full'=>$first_date_full,
    							'last_date_full'=>$last_date_full,
                                'first_date_slash'=>$first_date_slash,
                                'last_date_slash'=>$last_date_slash,
    							'first_day_num'=>$first_day_num,
    							'last_day_num'=>$last_day_num,
    							'num_days'=>$num_days,
    							'first_day_text'=>$first_day_text,
    							'last_day_text'=>$last_day_text,
    							'month_year'=>$month_year,
                                'today_next_month'=>$today_last_month,
                                'year'=>$year,
                                'month_year_full'=>$month_year_full,
                                'month'=>$month,
    							'englishdate'=>$englishdate,
    							'today_next_month_text'=>$today_last_month_text);
    	return $previous_month;
	}

	function get_current_month()
	{

        $month_year = $this->session->userdata('month_year'); 
        if($month_year!='')         
        {
            $month = $month_year;
        }else{
            $month = date('mY', strtotime("first day of this month"));
            $first_date_full = date('Y-m-d', strtotime("first day of this month"));     
            $last_date_full = date('Y-m-d', strtotime("last day of this month"));      

            $first_day_num = date('d', strtotime("first day of this month"));
            $last_day_num = date('d', strtotime("last day of this month"));

            $first_day_text = date('D F Y', strtotime("first day of this month"));
            $last_day_text= date('D F Y', strtotime("last day of this month"));
        }
		
        $englishdate = date('F, Y', strtotime("first day of this month"));

    	$year = substr($month, -4);    	
    	$month = substr_replace($month, "", -4);       	
    	$num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);    		
    	
    	$today = date('d', time());
    	$today_text = date('D F Y', time());
    	$month_year = date('mY', strtotime("first day of this month"));
    	$current_month = array('first_date_full'=>$first_date_full,
    							'last_date_full'=>$last_date_full,
    							'first_day_num'=>$first_day_num,
    							'last_day_num'=>$last_day_num,
    							'num_days'=>$num_days,
    							'first_day_text'=>$first_day_text,
    							'last_day_text'=>$last_day_text,
    							'month_year'=>$month_year,
    							'today'=>$today,
    							'today_text'=>$today_text,
                                'englishdate'=>$englishdate,
                                'year'=>$year,
                                'month'=>$month);
    	return $current_month;
	}

    function generate_full_date($year,$month,$day)
    {
        $full_date = $year.'-'.$month.'-'.$day;
        return $full_date;
    }

	function get_next_month()
	{
		$first_date_full = date('Y-m-d', strtotime("first day of next month"));		
    	$last_date_full = date('Y-m-d', strtotime("last day of next month"));    	

    	$first_day_num = date('d', strtotime("first day of next month"));
    	$last_day_num = date('d', strtotime("last day of next month"));

    	$first_day_text = date('D F Y', strtotime("first day of next month"));
    	$last_day_text= date('D F Y', strtotime("last day of next month"));

    	$month = date('mY', strtotime("first day of next month"));
    	$year = substr($month, -4);    	
    	$month = substr_replace($month, "", -4);       	
    	$num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);    		
    	
    	$today = date('Y-m-d', time());
    	$today_next_month = date('d', time());    	
    	$today_next_month_text = date("D F Y", strtotime("$today +1 month"));

    	$month_year = date('mY', strtotime("first day of next month"));
    	$next_month = array('first_date_full'=>$first_date_full,
    							'last_date_full'=>$last_date_full,
    							'first_day_num'=>$first_day_num,
    							'last_day_num'=>$last_day_num,
    							'num_days'=>$num_days,
    							'first_day_text'=>$first_day_text,
    							'last_day_text'=>$last_day_text,
    							'month_year'=>$month_year,
    							'today_next_month'=>$today_next_month,
    							'today_next_month_text'=>$today_next_month_text);
    	return $next_month;
	}

}

?>