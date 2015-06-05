<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Clc_management extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	/////**** Home Page Stuff *////
	function get_main_graph()
	{
		$this->load->model("Percentages_model",'percentage_model');	
		$county_id = $this->session->userdata('county_id');
		$reporting_rates = $this->percentage_model->get_district_percentages_county($county_id);
		$this->load->model("Date_Settings_model",'date_settings');
		$previous_month_details =$this->date_settings->get_previous_month();	
		$districts = array();
        $reported = array();
        $nonreported = array();
        foreach ($reporting_rates as $key => $value) {
            array_push($districts, $value['district']);  
            $percentage_reported = intval($value['percentage']);
            if($percentage_reported >100){
                $percentage_reported=100;
            }else{
                $percentage_reported = intval($value['percentage']);
            }

            array_push($reported, $percentage_reported);
            $percentage_non_reported = 100 - $percentage_reported;
            array_push($nonreported, $percentage_non_reported);
        }   
		$englishdate = $previous_month_details['englishdate'];                                 												        

        $reporting_rates = array('districts'=>$districts,'reported'=>$reported,'nonreported'=>$nonreported,'englishdate'=>$englishdate);       
        echo json_encode($reporting_rates);        

	}

	function get_early_vs_late()
	{
		$this->load->model("Lab_orders_model",'orders');		
		$county_id = $this->session->userdata('county_id');
		$this->load->model("Date_Settings_model",'date_settings');
		$previous_month_details =$this->date_settings->get_previous_month();	
		$late_reports = $this->orders->get_late_county_reports($county_id);
		$all_reports = $this->orders->get_all_county_reports($county_id);
		$count_late = count($late_reports);
		$count_all = count($all_reports);
		$early_reports = $count_all - $count_late;
		$englishdate = $previous_month_details['englishdate'];                                 
		$statistics_details = array('all_reports'=>$count_all,'late_reports'=>$count_late,'early_reports'=>$early_reports,'englishdate'=>$englishdate);
		echo json_encode($statistics_details);

	}

	function get_reported_vs_nonreported()
	{
		$this->load->model("Lab_orders_model",'orders');				
		$this->load->model("Facilities_model",'facilities');
		$this->load->model("Date_Settings_model",'date_settings');
		$previous_month_details =$this->date_settings->get_previous_month();
		$englishdate = $previous_month_details['englishdate'];                                 												
		$county_id = $this->session->userdata('county_id');
		$reported_facilities = $this->orders->get_all_reported_county($county_id);
		$all_facilities = $this->facilities->get_all_reporting_in_county($county_id);
		$count_reported = count($reported_facilities);
		$count_all = count($all_facilities);
		$count_nonreported = $count_all - $count_reported;
		$statistics_details = array('all_facilities'=>$count_all,'reported_facilities'=>$count_reported,'nonreported_facilities'=>$count_nonreported,'englishdate'=>$englishdate);
		echo json_encode($statistics_details);

	}

	function get_trend_graph()
	{
		$this->load->model("Lab_orders_model",'orders');				
		$this->load->model("Date_Settings_model",'date_settings');				
		$this->load->model("Counties_model",'county');	
		
		$current_month_details =$this->date_settings->get_current_month();
		$previous_month_details =$this->date_settings->get_previous_month();
        
        $month = $this->session->userdata('month_year');         
		if(isset($month)){           
            $year = substr($month, -4);
            $month = substr($month, 0,2);            
            $monthyear = $year . '-' . $month . '-1';                         
        }else{
            $month = $previous_month_details['month_year'];                                 
            $englishdate = $previous_month_details['englishdate'];                                 
            $year = substr($month, -4);
            $month = substr_replace($month, "", -4);            
        }        


        $county_id = $this->session->userdata('county_id');
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];

        $xArr = array();
        $yArr = array();
        $xArr1 = array();
        $cumulative_result = 0;        
        $reporting_rates = $this->orders->reporting_rates($county_id,$year,$month);        
        foreach ($reporting_rates as $value) {
            $count = intval($value['count']);
            $order_date = substr($value['order_date'], -2);
            $order_date = date('jS', strtotime($value['order_date']));

            $cumulative_result +=$count;
            array_push($xArr1, $cumulative_result);

            array_push($yArr, $order_date);
            array_push($xArr, $count);
        }
        
        $final_array = array('cumulative_result'=>$cumulative_result,
        					 'jsony'=>$yArr,
        					 'jsonx'=>$xArr,
        					 'jsonx1'=>$xArr1,
        					 'month_text'=>$englishdate);

        echo json_encode($final_array);
	}

	function get_county_percentage()
	{
		$this->load->model("Percentages_model",'percentages');	
		$county_id = $this->session->userdata('county_id');					
		$percentage_details = $this->percentages->get_county_percentage($county_id);		
		$percentage = intval($percentage_details['percentage']);
		$output = array('percentage'=>$percentage);
		echo json_encode($output);

	}

	//// ** Statistics Page Stuff ***///

	function get_stock_card()
	{
		$this->load->model("Lab_details_model",'lab_details');	
		$this->load->model("Amcs_model",'amc_details');	
		$county_id = $this->session->userdata('county_id');					
		$facil_amcs = $this->amc_details->get_county_amc($county_id);		
		$facil_endbals = $this->lab_details->get_ending_balance_county($county_id);	
		$count = count($facil_amcs);
    	$stock_details = array();
    	for ($i=0; $i < $count; $i++) { 
	        $comm_id = $facil_amcs[$i]['id'];
	        $comm_name = $facil_amcs[$i]['commodity_name'];
	        $amc = $facil_amcs[$i]['amc'];
	        $endbal = $facil_endbals[$i]['end_bal'];
	        if($amc==0){
	        	$ratio = 0;
	        }else{
	        	$ratio = round(($endbal/$amc),0);
	        }
	        $stock_details[$i] = array($comm_name,$amc,$endbal,$ratio);
	    }  	
	    echo json_encode($stock_details);
	    
	}


	function get_highest_stocks($commodity_id)
	{	
		$this->load->model("Lab_details_model",'lab_details');			
		$county_id = $this->session->userdata('county_id');				
		$highest_stocks = $this->lab_details->get_county_highest_stocks($commodity_id,$county_id);
		if(count($highest_stocks)>0){
			for ($i=0; $i <count($highest_stocks) ; $i++) {            
	            $mfl = $highest_stocks[$i]['facility_code'];                    
	            $endbal = $highest_stocks[$i]['closing_stock'];                    
	            $facility_name = $highest_stocks[$i]['facility_name'];                                
		        $highest_stocks_details[$i] = array($mfl,$facility_name,$endbal);            
	        }
	    }
	    echo json_encode($highest_stocks_details);        
	}
	

	function sub_county_early_vs_late($district_id=null)
	{			
		$this->load->model("Districts_model",'districts_model');
		$this->load->model("Lab_orders_model",'orders');				
		$this->load->model("Date_Settings_model",'date_settings');
		$previous_month_details =$this->date_settings->get_previous_month();	

		$county_id = $this->session->userdata('county_id');						
		if($district_id==0)
		{
			$districts_details = $this->districts_model->get_all_from_county($county_id);
			$district_id = $districts_details[0]['id'];
		}		
		$late_reports = $this->orders->get_late_district_reports($district_id);
		$early_reports = $this->orders->get_early_district_reports($district_id);
		$count_late = count($late_reports);
		$count_early = count($early_reports);
		$count_all = $count_early + $count_late;
		$englishdate = $previous_month_details['englishdate'];                                 
		$statistics_details = array('all_reports'=>$count_all,'late_reports'=>$count_late,'early_reports'=>$early_reports,'englishdate'=>$englishdate);
		echo json_encode($statistics_details);

	}

	function sub_county_get_dets($district_id = null)
	{
		
		$this->load->model("Districts_model",'districts_model');										
		$this->load->model("Amcs_model",'amc_details');	
		$county_id = $this->session->userdata('county_id');					
		if($district_id==0)
		{
			$districts_details = $this->districts_model->get_first_from_county($county_id);			
		}else{
			$districts_details = $this->districts_model->get_details_from_id($district_id);						
		}			
		foreach ($districts_details as $key => $value) {
			$id = $value['id'];
			$district_name = $value['district'];	
			$fac_link = '<a href="'.site_url().'Clc/view_facilities/'.$id.'">View Facilities</a>';				
			$location = 'You are on RTK-> County -> '.$district_name.' Sub-County  ['.$fac_link.']';	
			echo json_encode($location);
		}			
			
		
	}

	function fac_county_get_dets($district_id,$mfl = null)
	{	
		$this->load->model("Districts_model",'districts_model');											
		$this->load->model("Facilities_model",'facilities_model');	
		$districts_details = $this->districts_model->get_details_from_id($district_id);					
		$district_name = $districts_details[0]['district'];		

		if($mfl==0)
		{
			$facility_details = $this->facilities_model->get_first_in_district($district_id);			
		}else{
			$facility_details = $this->facilities_model->get_one_mfl($mfl);						
		}			
		foreach ($facility_details as $key => $value) {
			$id = $value['id'];
			$facility_name = $value['facility_name'];				
			$fname_link = $facility_name.' ('.$district_name.' Sub-County)';			
			$location = 'You are on RTK-> County -> '.$district_name.' Sub-County -> '.$facility_name.' (Facility)';	
			$output = array('facility_name'=>$fname_link,'location'=>$location);
			echo json_encode($output);
		}			
			
		
	}

	function sub_county_get_stock_card($district_id = null)
	{
		$this->load->model("Districts_model",'districts_model');						
		$this->load->model("Facilities_model",'facilities');				
		$this->load->model("Lab_details_model",'lab_details');	
		$this->load->model("Amcs_model",'amc_details');	
		$county_id = $this->session->userdata('county_id');					
		if($district_id==0)
		{
			$districts_details = $this->districts_model->get_all_from_county($county_id);
			$district_id = $districts_details[0]['id'];
			$district_name = $districts_details[0]['district'];
		}	
						
		$facil_amcs = $this->amc_details->get_district_amc($district_id);		
		$facil_endbals = $this->lab_details->get_ending_balance_district($district_id);	
		$count = count($facil_amcs);
    	$stock_details = array();
    	for ($i=0; $i < $count; $i++) { 
	        $comm_id = $facil_amcs[$i]['id'];
	        $comm_name = $facil_amcs[$i]['commodity_name'];
	        $amc = $facil_amcs[$i]['amc'];
	        $endbal = $facil_endbals[$i]['end_bal'];
	        if($amc==0){
	        	$ratio = 0;
	        }else{
	        	$ratio = round(($endbal/$amc),0);
	        }
	        $stock_details[$i] = array($comm_name,$amc,$endbal,$ratio);
	    }  	
	    echo json_encode($stock_details);
	    
	}
	
	function sub_county_reported_vs_nonreported($district_id=null)
	{	
		$this->load->model("Districts_model",'districts_model');
		$this->load->model("Lab_orders_model",'orders');				
		$this->load->model("Date_Settings_model",'date_settings');
		$previous_month_details =$this->date_settings->get_previous_month();		
		$this->load->model("Facilities_model",'facilities');		
		$englishdate = $previous_month_details['englishdate']; 
		$county_id = $this->session->userdata('county_id');						
		if(is_null($district_id))
		{
			$districts_details = $this->districts_model->get_all_from_county($county_id);
			$district_id = $districts_details[0]['id'];
			$district_name = $districts_details[0]['district'];
		}		

		$reported_facilities = $this->orders->get_all_reported_district($district_id);
		$all_facilities = $this->facilities->get_all_reporting_in_district($district_id);		
		$count_reported = count($reported_facilities);
		$count_all = count($all_facilities);
		$count_nonreported = $count_all - $count_reported;
		$statistics_details = array('all_facilities'=>$count_all,'reported_facilities'=>$count_reported,'nonreported_facilities'=>$count_nonreported,'englishdate'=>$englishdate);
		echo json_encode($statistics_details);

	}
	


	function get_highest_expiries($commodity_id)
	{
		//GEts the Expiries in 6 Months
		$this->load->model("Lab_details_model",'lab_details');			
		$county_id = $this->session->userdata('county_id');					
		$highest_expiries = $this->lab_details->get_county_highest_expiries($commodity_id,$county_id);
		for ($i=0; $i <count($highest_expiries) ; $i++) {            
            $mfl = $highest_expiries[$i]['facility_code'];                    
            $expiries = $highest_expiries[$i]['q_expiring'];                    
            $facility_name = $highest_expiries[$i]['facility_name'];                                
	        $highest_expiries_details[$i] = array($mfl,$facility_name,$expiries);            
        }
        
	    echo json_encode($highest_expiries_details); 
	}


}
?>