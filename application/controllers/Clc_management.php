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
	

	function get_facility_records($district_id,$mfl = null)
	{	
		$this->load->model("Districts_model",'districts_model');											
		$this->load->model("Facilities_model",'facilities_model');			
		$county_id = $this->session->userdata('county_id');				
		$districts_details = $this->districts_model->get_details_from_id($district_id);					
		$district_name = $districts_details[0]['district'];		
		$facility_code = null;
		if($mfl==0)
		{
			$facility_details = $this->facilities_model->get_first_in_district($district_id);			
		}else{
			$facility_details = $this->facilities_model->get_one_mfl($mfl);						
		}			
		foreach ($facility_details as $key => $value) {
			$facility_code = $value['facility_code'];							
		}			
		$facility_records = $this->facilities_model->monthly_facility_reports($facility_code);
		// echo "<pre>";
		// print_r($facility_records);die();
		$div_details =null;
		foreach ($facility_records as $key => $value) {
			$facility_name = $value['facility_name'];
			$district = $value['district'];
			$county = $value['county'];
			$report_id = $value['id'];
			$compiled_by = $value['compiled_by'];
			$report_for = date('F, Y', strtotime('-1 Month',strtotime($value['order_date'])) );
			$div_details.='<div class="accordion-group"><div class="accordion-heading">';									
	        $div_details.='<h4 style="background-color:#f5f5f5;font-size:13px;height:29px;margin-top:1px;margin-bottom:1px;margin-left:-2%;padding:1%;"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#report-'.$report_id.'">';	
	        $div_details.= "Report for ".$report_for." Compiled by ".$compiled_by."</a></h4>";
       		$div_details.="<div id=\"report-".$report_id."\" class=\"accordion-body collapse\" style=\"height: 0px;\">";
	        $div_details.='<div class="accordion-inner"><table class="table report_table" style="font-size:11px;border:1px ridge #ccc">';
	        $div_details.= '<thead style="font-size:11px;"><tr><th>Kit</th><th> AMC </th><th>Beginning Balance</th><th>Received Quantity</th><th>Used Total</th><th>Total Tests</th><th>Positive Adjustments</th><th>Negative Adjustments</th><th>Losses</th><th>Closing Balance</th></tr></thead>';
	        $div_details.='<tbody style="font-size:11px;">';            
            $a = 0;           
	        foreach ($value[$a] as $values) {
	        	$commodity_name = $values['commodity_name'];
	        	$amc = $values['amc'];
	        	$beginning_bal = $values['beginning_bal'];
	        	$q_received = $values['q_received'];
	        	$q_used = $values['q_used'];
	        	$no_of_tests_done = $values['no_of_tests_done'];
	        	$positive_adj = $values['positive_adj'];
	        	$negative_adj = $values['negative_adj'];
	        	$losses = $values['losses'];
	        	$closing_stock = $values['closing_stock'];	        	
            	$div_details.='<tr>';
            	$div_details.="<td>$commodity_name</td><td>$amc</td><td>$beginning_bal</td><td>$q_received</td><td>$q_used</td><td>$no_of_tests_done</td>";
            	$div_details.="<td>$positive_adj</td><td>$negative_adj</td><td>$losses</td>";
            	$div_details.="<td>$closing_stock</td></td></tr>";    

            	$a++;  	
	        }

			$div_details.='</tbody></table></div></div>';						
			$div_details.='</div></div>';						
		}	 
  	
		echo json_encode($div_details);
	}

	function update_facility_details()
	{
		$facility_code = $this->input->post('facility_code');
		$facility_name = $this->input->post('facility_name');
		$district_id = $this->input->post('district_id');
		$sql = "update facilities set facility_name = '$facility_name', district = '$district_id' where facility_code='$facility_code'";
		if($this->db->query($sql)){
			echo "Facility Updated Successfully";
		}else{
			echo "Facility Not Updated Successfully";
		}	
	}

	function get_edit_facility_form($mfl)
	{	
		$this->load->model("Districts_model",'districts_model');													
		$this->load->model("Facilities_model",'facilities_model');													
		$county_id = $this->session->userdata('county_id');							
		$facility_details = $this->facilities_model->get_one_mfl($mfl);
		$option = '';						
		foreach ($facility_details as $key => $value) {
			$facility_code = $value['facility_code'];							
			$facility_name = $value['facility_name'];							
		}					
  		$option.='<option id="0">Select Sub-County</option>';
  		$districts = $this->districts_model->get_all_from_county($county_id);
  		foreach ($districts as $key => $value) {
  			$id = $value['id'];
  			$district = $value['district'];
  			$option.='<option value="'.$id.'">'.$district.'</option>';
  		}
  		$output = array('facility_name'=>$facility_details[0]['facility_name'],'districts'=>$option);
		echo json_encode($output);
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


	function commodity_usage($district,$com_id=null) {
	    if(isset($com_id)){
	        $commodity_id = $com_id;
	    }else{
	        $commodity_id = 4;
	    }
	    $data = array();
	    $lastday = date('Y-m-d', strtotime("last day of previous month"));

	    $current_month = $this->session->userdata('Month');

	    if ($current_month == '') {
	        $current_month = date('mY', time());
	    }
	    $previous_month = date('m', strtotime("last day of previous month"));
	    $previous_month_1 = date('mY', strtotime('-2 month'));
	    $previous_month_2 = date('mY', strtotime('-3 month'));
	    $year_current = substr($current_month, -4);
	    
	    $year_previous = date('Y', strtotime("last day of previous month"));
	    $year_previous_1 = substr($previous_month_1, -4);
	    $year_previous_2 = substr($previous_month_2, -4);

	    $current_month = substr_replace($current_month, "", -4);        
	    $previous_month_1 = substr_replace($previous_month_1, "", -4);
	    $previous_month_2 = substr_replace($previous_month_2, "", -4);

	    $monthyear_current = $year_current . '-' . $current_month . '-1';
	    $monthyear_previous = $year_previous . '-' . $previous_month . '-1';
	    $monthyear_previous_1 = $year_previous_1 . '-' . $previous_month_1 . '-1';
	    $monthyear_previous_2 = $year_previous_2 . '-' . $previous_month_2 . '-1';

	    $englishdate = date('F, Y', strtotime($monthyear_current));

	    $m_c = date("F", strtotime($monthyear_current));
	//first month               
	    $m0 = date("F", strtotime($monthyear_previous));
	    $m1 = date("F", strtotime($monthyear_previous_1));
	    $m2 = date("F", strtotime($monthyear_previous_2));

	    $month_text = array($m2, $m1, $m0);

	    $month_one_data = $this->district_totals($year_current, $current_month, $district,$commodity_id);	   	
	   	$month_two_data = $this->district_totals($year_previous_1, $previous_month_1, $district,$commodity_id);
   		$month_three_data = $this->district_totals($year_previous_2, $previous_month_2, $district,$commodity_id);

   		$opening = array(intval($month_one_data[0]['sum_opening']),intval($month_two_data[0]['sum_opening']),intval($month_three_data[0]['sum_opening']));
   		$used = array(intval($month_one_data[0]['sum_used']),intval($month_two_data[0]['sum_used']),intval($month_three_data[0]['sum_used']));
   		$tests_done = array(intval($month_one_data[0]['sum_tests']),intval($month_two_data[0]['sum_tests']),intval($month_three_data[0]['sum_tests']));
   		$closing_bal = array(intval($month_one_data[0]['sum_closing_bal']),intval($month_two_data[0]['sum_closing_bal']),intval($month_three_data[0]['sum_closing_bal']));   		
   		$output=array('months'=>$month_text,'opening'=>$opening,'used'=>$used,'tests_done'=>$tests_done,'closing_bal'=>$closing_bal);   		
   		echo json_encode($output);
	}

	function district_totals($year, $month, $district = NULL,$commodity_id = null) {
	    $conditions = '';
	    if(isset($commodity_id)){
	        $conditions = "and lab_commodities.id = '$commodity_id'";
	    }

	    $firstdate = $year . '-' . $month . '-01';
	    //$firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));
	    //echo "$firstday";die();
	    // $month = date("m", strtotime("$firstdate +1 Month "));
	    // $year = date("Y", strtotime("$firstdate +1 Month "));
	    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	    $lastdate = $year . '-' . $month . '-' . $num_days;	    
	    $returnable = array();

	    $common_q = "SELECT lab_commodities.commodity_name,
	    sum(lab_commodity_details_old.beginning_bal) as sum_opening, 
	    sum(lab_commodity_details_old.q_received) as sum_received, 
	    sum(lab_commodity_details_old.q_used) as sum_used, 
	    sum(lab_commodity_details_old.no_of_tests_done) as sum_tests, 
	    sum(lab_commodity_details_old.positive_adj) as sum_positive, 
	    sum(lab_commodity_details_old.negative_adj) as sum_negative,
	    sum(lab_commodity_details_old.losses) as sum_losses,
	    sum(lab_commodity_details_old.closing_stock) as sum_closing_bal,
	    sum(lab_commodity_details_old.q_requested) as sum_requested, 	    	    
	    sum(lab_commodity_details_old.q_expiring) as sum_expiring
	    FROM lab_commodities, lab_commodity_details_old, lab_commodity_orders, facilities, districts, counties 
	    WHERE lab_commodity_details_old.commodity_id = lab_commodities.id 
	    AND lab_commodity_orders.id = lab_commodity_details_old.order_id 
	    AND facilities.facility_code = lab_commodity_details_old.facility_code AND facilities.district = districts.id 
	    AND districts.county = counties.id 
	    AND lab_commodity_orders.order_date BETWEEN  '$firstdate' AND  '$lastdate'
	    AND lab_commodities.id in (select lab_commodities.id from lab_commodities,lab_commodity_categories 
	        where lab_commodities.category = lab_commodity_categories.id and lab_commodity_categories.active = '1') $conditions";

	if (isset($district)) {
	    $common_q.= ' AND districts.id =' . $district;
	}

	$common_q.= ' group by lab_commodities.id';
	// echo "$common_q";die();
	$res = $this->db->query($common_q)->result_array();       

	return $res;
	}






	function get_commodity_select_options(){
		$this->load->model("Lab_commodities_model",'lab_commodities');											
		$commodities = $this->lab_commodities->get_active();
		$option = null;		
		foreach ($commodities as $key => $value) {
			$id = $value['id'];
			$name = $value['commodity_name'];
			$option.='<option id="'.$id.'">'.$name.'</option>';
		}
		echo json_encode($option);
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
			$facility_code = $value['facility_code'];							
			$fname_link = $facility_name.'(<input id="facility_code_hidden" type="hidden" value="'.$facility_code.'"/><i> MFL:'.$facility_code.'</i>)';			
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