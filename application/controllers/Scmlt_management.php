<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Scmlt_management extends CI_Controller {

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

	// private $template='scmlt/template';
	function index()
	{		
		

	}

	function get_scmlt_orders()
	{
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Lab_orders_model",'orders');
		$this->load->model("Date_settings_model",'date_settings');
		$lab_orders_details = $this->orders->get_district_orders($district_id);			
		foreach ($lab_orders_details as $key => $value) {
			$order_id = $value['id'];			
			$order_date = $value['order_date'];
			$report_for = $this->date_settings->get_date_text_previous_month($order_date);
			$facility_code = $value['facility_code'];
			$facility_name = $value['facility_name'];
			$compiled_by = $value['compiled_by'];
			$approved_by = $value['approved_by'];
			$action = '<a href="'.site_url('Scmlt/view_report').'/'.$order_id.'" class="link">Edit/View Report</a>';			
			$output[] = array($report_for,$facility_code,$facility_name,$compiled_by,$approved_by,$order_date,$action);
		}		
		echo json_encode($output);		

	}

	function set_up_percentages(){
		$this->load->model("Percentages_model",'percentage_model');
		$this->percentage_model->set_up_district_percentages();
		$this->percentage_model->set_up_county_percentages();
	}

	function update_percentages($id){
		$this->load->model("Percentages_model",'percentage_model');
		// $this->percentage_model->set_up_county_percentages();
		$this->percentage_model->update_county_percentage($id,0);
	}

	function get_navigation(){		
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Facilities_model",'facility');
		$this->load->model("Lab_orders_model",'orders');
		$facility_details = $this->facility->get_all_in_district($district_id);
		$deadline_date = 15;			    
	    $date = date('d', time());
	    $reported = 0;
	    $nonreported = 0;
	    $unreported = array();
		foreach ($facility_details as $key => $value) {
	    	$mfl = $value['facility_code'];	    		    	
	    	$lastmonth = date('F', strtotime("last day of previous month"));   	            
            $lab_count = $this->orders->get_recent_lab_orders($mfl);            
            if ($lab_count <= 0) {                
                array_push($unreported, $mfl);
            }            
        }
		echo json_encode($unreported);
	}

	
	function get_scmlt_home()
	{
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Facilities_model",'facility');
		$this->load->model("Lab_orders_model",'orders');
		$this->load->model("Date_settings_model",'date_settings');
		$facility_details = $this->facility->get_all_in_district($district_id);		
		$deadline_details = $this->date_settings->get_deadline_details($facility_details[0]['zone']);				
		$deadline_date = $deadline_details[0]['deadline'];		
		$five_day_alert = $deadline_details[0]['5_day_alert'];		
		$one_day_alert = $deadline_details[0]['report_day_alert'];		
		$overdue_alert = $deadline_details[0]['overdue_alert'];		
	    $table_body = '';
	    $current_month_details =$this->date_settings->get_current_month();
	    $current_date = $current_month_details['today'];
	    $date_diff = $deadline_date - $current_date;
	    $reported = 0;
	    $nonreported = 0;	

	    foreach ($facility_details as $key => $value) {
	    	$mfl = $value['facility_code'];
	    	$facility_name = $value['facility_name'];
	    	$owner = $value['owner'];
	    	$lastmonth = date('F', strtotime("last day of previous month"));
	    	$report_link = "<a href=" . site_url('Scmlt/get_report/' . $mfl) . " class='link report'>&nbsp;Report</a>";
	    	$view_link = "<a href=" . site_url('Scmlt/view_report_mfl/' . $mfl) . " class='link report'>&nbsp;View</a>";
	    	
	    	if($deadline_date<=$current_date)
	    	{
	    		$report_link = '';
	    		$report_status = '<span class="label-danger label">Pending for '.$lastmonth.'</span>';                
                $report_status.=$report_link;

            }else{
                $report_status = '<span class="label-danger label">Pending for '.$lastmonth.'</span>';    
                $report_status.=$report_link;

            }
           
            $lab_count = $this->orders->get_recent_lab_orders($mfl);            
            if ($lab_count > 0) {
                $reported = $reported + 1;  
	    		$report_status = '<span class="label-success label">Submitted for '.$lastmonth.'</span>';                                                            
                $report_status .=$view_link;
            } else {
                $nonreported = $nonreported + 1;                

            }

            $output[] = array($mfl,$facility_name,$owner,$report_status);


	    }	
	    
		echo json_encode($output);
	}

	function get_scmlt_districts()
	{
		$user_id = $this->session->userdata('user_id');		
		$this->load->model("Districts_model",'district');	
		$current_district = $this->district->get_current_scmlt_district($user_id);	
		$assigned_district = $this->district->get_scmlt_districts($user_id);
		$option= '';
		foreach ($current_district as $key => $value) {
			$option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
		}
		foreach ($assigned_district as $key => $value) {
			$option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
		}	
		$count_assigned = count($assigned_district);		
		$select ='<option value="0">---Switch Sub-County---</option>';
		$select .=$option;		

		$district_dets = array('count_assigned'=>$count_assigned,'districts'=>$select);
		echo json_encode($district_dets);

	}

	function get_remaining_orders()
	{
		$district_id = $this->session->userdata('district_id');				
		$this->load->model("Lab_orders_model",'orders');
		$this->load->model("Date_settings_model",'date_settings');
		$facility_details = $this->orders->get_remaining_lab_orders($district_id);	
		$output = array();
		foreach ($facility_details as $key => $value) {
			$mfl = $value['facility_code'];
			array_push($output, $mfl);
		}			
		echo json_encode($output);		
	}
	
	function get_reporting_message()
	{
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Facilities_model",'facility');		
		$this->load->model("Date_settings_model",'date_settings');
		$facility_details = $this->facility->get_all_in_district($district_id);		
		$deadline_details = $this->date_settings->get_deadline_details($facility_details[0]['zone']);				
		$deadline_date = $deadline_details[0]['deadline'];		
		$five_day_alert = $deadline_details[0]['5_day_alert'];		
		$one_day_alert = $deadline_details[0]['report_day_alert'];		
		$overdue_alert = $deadline_details[0]['overdue_alert'];			    
	    $current_month_details =$this->date_settings->get_current_month();
	    $current_date = $current_month_details['today'];
	    $date_diff = $deadline_date - $current_date;	   
	    $alert_message = '';
	    if($date_diff==5){
    		$alert_message = $five_day_alert;
    	}elseif ($date_diff==1) {
    		$alert_message = $one_day_alert;
    	}elseif ($date_diff<1) {
    		$alert_message = $overdue_alert;
    	}else{
    		$alert_message = 'You have '.$date_diff.' days remaining before the Reporting Deadline. Kindly Finish reporting on Time';
    	}	    	
    	echo json_encode($alert_message);

	}

	
	function get_alerts()
	{
		$district_id = $this->session->userdata('district_id');				
		$this->load->model("Alerts_model",'alerts_model');
		$alert_details = $this->alerts_model->get_district_alerts();		
		$count = count($alert_details);
	    $alert_message = '';		
		if($count!=0){
			$alert_message = $alert_details[0]['message'];
    	}
    	$output  = array('alert_count' => $count,'message'=>$alert_message);	    	
    	echo json_encode($output);
	}

	function submit_report()
	{
		
		date_default_timezone_set("EUROPE/Moscow");
	    $firstday = date('D dS M Y', strtotime("first day of previous month"));
	    $lastday = date('D dS M Y', strtotime("last day of previous month"));
	    $lastmonth = date('F', strtotime("last day of previous month"));	    
	    $month = $lastmonth;
	    $district_id = $_POST['district_id'];
	    $facility_code = $_POST['facility_code'];

	    $this->load->model("Lab_orders_model",'orders_model');
	    $this->load->model("Districts_model",'districts_model');
	    $count_submitted = $this->orders_model->check_if_reported($facility_code);
	    if($count_submitted==0)
	    {
		    $drug_id = $_POST['commodity_id'];
		    $unit_of_issue = $_POST['unit_of_issue'];
		    $b_balance = $_POST['b_balance'];
		    $q_received = $_POST['q_received'];
		    $q_used = $_POST['q_used'];
		    $tests_done = $_POST['tests_done'];
		    $losses = $_POST['losses'];
		    $pos_adj = $_POST['pos_adj'];
		    $neg_adj = $_POST['neg_adj'];
		    $physical_count = $_POST['physical_count'];
		    $q_expiring = $_POST['q_expiring'];
		    $days_out_of_stock = $_POST['days_out_of_stock'];
		    $q_requested = $_POST['q_requested'];
		    $commodity_count = count($drug_id);

		    $vct = $_POST['vct'];
		    $pitc = $_POST['pitc'];
		    $pmtct = $_POST['pmtct'];
		    $b_screening = $_POST['blood_screening'];
		    $other = $_POST['other2'];
		    $specification = $_POST['specification'];
		    $rdt_under_tests = $_POST['rdt_under_tests'];
		    $rdt_under_pos = $_POST['rdt_under_positive'];
		    $rdt_btwn_tests = $_POST['rdt_to_tests'];
		    $rdt_btwn_pos = $_POST['rdt_to_positive'];
		    $rdt_over_tests = $_POST['rdt_over_tests'];
		    $rdt_over_pos = $_POST['rdt_over_positive'];
		    $micro_under_tests = $_POST['micro_under_tests'];
		    $micro_under_pos = $_POST['micro_under_positive'];
		    $micro_btwn_tests = $_POST['micro_to_tests'];
		    $micro_btwn_pos = $_POST['micro_to_positive'];
		    $micro_over_tests = $_POST['micro_over_tests'];
		    $micro_over_pos = $_POST['micro_over_positive'];
		    $beg_date = $_POST['begin_date'];
		    $end_date = $_POST['end_date'];
		    $explanation = $_POST['explanation'];
		    $compiled_by = $_POST['compiled_by'];
		    $approved_by = $_POST['approved_by'];
		    $moh_642 = $_POST['moh_642'];
		    $moh_643 = $_POST['moh_643'];

		    date_default_timezone_set('EUROPE/Moscow');
		    $beg_date = date('Y-m-d', strtotime("first day of previous month"));
		    $end_date = date('Y-m-d', strtotime("last day of previous month"));

		    $user_id = $this->session->userdata('user_id');        

		    $order_date = date('y-m-d');
		    $count = 1;
		    $data = array('facility_code' => $facility_code,'compiled_by' => $compiled_by,'approved_by' => $approved_by, 'order_date' => $order_date, 'vct' => $vct, 'pitc' => $pitc, 'pmtct' => $pmtct, 'b_screening' => $b_screening, 'other' => $other, 'specification' => $specification, 'rdt_under_tests' => $rdt_under_tests, 'rdt_under_pos' => $rdt_under_pos, 'rdt_btwn_tests' => $rdt_btwn_tests, 'rdt_btwn_pos' => $rdt_btwn_pos, 'rdt_over_tests' => $rdt_over_tests, 'rdt_over_pos' => $rdt_over_pos, 'micro_under_tests' => $micro_under_tests, 'micro_under_pos' => $micro_under_pos, 'micro_btwn_tests' => $micro_btwn_tests, 'micro_btwn_pos' => $micro_btwn_pos, 'micro_over_tests' => $micro_over_tests, 'micro_over_pos' => $micro_over_pos, 'beg_date' => $beg_date, 'end_date' => $end_date, 'explanation' => $explanation, 'moh_642' => $moh_642, 'moh_643' => $moh_643, 'report_for' => $lastmonth);
		    $this->load->model("Lab_orders_model",'orders_model');				
		    $order_id = $this->orders_model->save_order($data);
		    $update_data = array('old_id'=>$order_id);
		    $this->orders_model->update_order($update_data,$order_id);

		    $this->load->model("Lab_details_model",'details_model');				
		    $this->load->model("Percentages_model",'percentage_model');				
		    // $order_id = $this->details_model->save_order_details($data);

		    $count++;

		    for ($i = 0; $i < $commodity_count; $i++) {            
		        $mydata = array('order_id' => $order_id, 'facility_code' => $facility_code, 'commodity_id' => $drug_id[$i], 'beginning_bal' => $b_balance[$i], 'q_received' => $q_received[$i], 'q_used' => $q_used[$i], 'no_of_tests_done' => $tests_done[$i], 'losses' => $losses[$i], 'positive_adj' => $pos_adj[$i], 'negative_adj' => $neg_adj[$i], 'closing_stock' => $physical_count[$i], 'q_expiring' => $q_expiring[$i], 'days_out_of_stock' => $days_out_of_stock[$i], 'q_requested' => $q_requested[$i]);
		        $this->details_model->save_order_details($mydata);	
		     // echo "<pre>";   print_r($mydata);        
		    }
		    $district_dets = $this->districts_model->get_one_id($district_id);
		   	$county_id = $district_dets['county'];
		   	$this->percentage_model->update_district_percentage($district_id,1);
		   	$this->percentage_model->update_county_percentage($county_id,1);
		   	echo "1";

		}else{
			echo "2";	    	

		}	    
	}

	function update_report()
	{	
		$lastmonth = date('F', strtotime("last day of previous month"));	    
	    $drug_id = $_POST['commodity_id'];
	    $order_id = $_POST['order_id'];
	    $unit_of_issue = $_POST['unit_of_issue'];
	    $b_balance = $_POST['b_balance'];
	    $q_received = $_POST['q_received'];
	    $q_used = $_POST['q_used'];
	    $tests_done = $_POST['tests_done'];
	    $losses = $_POST['losses'];
	    $pos_adj = $_POST['pos_adj'];
	    $neg_adj = $_POST['neg_adj'];
	    $physical_count = $_POST['physical_count'];
	    $q_expiring = $_POST['q_expiring'];
	    $days_out_of_stock = $_POST['days_out_of_stock'];
	    $q_requested = $_POST['q_requested'];
	    $facility_code = $_POST['facility_code'];
	    $commodity_count = count($drug_id);

	    $vct = $_POST['vct'];
	    $pitc = $_POST['pitc'];
	    $pmtct = $_POST['pmtct'];
	    $b_screening = $_POST['blood_screening'];
	    $other = $_POST['other2'];
	    $specification = $_POST['specification'];
	    $rdt_under_tests = $_POST['rdt_under_tests'];
	    $rdt_under_pos = $_POST['rdt_under_positive'];
	    $rdt_btwn_tests = $_POST['rdt_to_tests'];
	    $rdt_btwn_pos = $_POST['rdt_to_positive'];
	    $rdt_over_tests = $_POST['rdt_over_tests'];
	    $rdt_over_pos = $_POST['rdt_over_positive'];
	    $micro_under_tests = $_POST['micro_under_tests'];
	    $micro_under_pos = $_POST['micro_under_positive'];
	    $micro_btwn_tests = $_POST['micro_to_tests'];
	    $micro_btwn_pos = $_POST['micro_to_positive'];
	    $micro_over_tests = $_POST['micro_over_tests'];
	    $micro_over_pos = $_POST['micro_over_positive'];
	    $beg_date = $_POST['begin_date'];
	    $end_date = $_POST['end_date'];
	    $explanation = $_POST['explanation'];
	    $compiled_by = $_POST['compiled_by'];
	    $approved_by = $_POST['approved_by'];
	    $moh_642 = $_POST['moh_642'];
	    $moh_643 = $_POST['moh_643'];

	    date_default_timezone_set('EUROPE/Moscow');
	    $beg_date = date('Y-m-d', strtotime("first day of previous month"));
	    $end_date = date('Y-m-d', strtotime("last day of previous month"));

	    $user_id = $this->session->userdata('user_id');        

	    $order_date = date('y-m-d');
	    
	    $data = array('facility_code' => $facility_code,'compiled_by' => $compiled_by,'approved_by' => $approved_by, 'order_date' => $order_date, 'vct' => $vct, 'pitc' => $pitc, 'pmtct' => $pmtct, 'b_screening' => $b_screening, 'other' => $other, 'specification' => $specification, 'rdt_under_tests' => $rdt_under_tests, 'rdt_under_pos' => $rdt_under_pos, 'rdt_btwn_tests' => $rdt_btwn_tests, 'rdt_btwn_pos' => $rdt_btwn_pos, 'rdt_over_tests' => $rdt_over_tests, 'rdt_over_pos' => $rdt_over_pos, 'micro_under_tests' => $micro_under_tests, 'micro_under_pos' => $micro_under_pos, 'micro_btwn_tests' => $micro_btwn_tests, 'micro_btwn_pos' => $micro_btwn_pos, 'micro_over_tests' => $micro_over_tests, 'micro_over_pos' => $micro_over_pos, 'beg_date' => $beg_date, 'end_date' => $end_date, 'explanation' => $explanation, 'moh_642' => $moh_642, 'moh_643' => $moh_643, 'report_for' => $lastmonth);
	    // echo "<pre>";
	    // print_r($data);die();
	    $this->load->model("Lab_orders_model",'orders_model');				
	    $this->orders_model->update_order($data,$order_id);

	    $this->load->model("Lab_details_model",'details_model');				  
	    
	    for ($i = 0; $i < $commodity_count; $i++) {            
	        $mydata = array('facility_code' => $facility_code, 'commodity_id' => $drug_id[$i], 'beginning_bal' => $b_balance[$i], 'q_received' => $q_received[$i], 'q_used' => $q_used[$i], 'no_of_tests_done' => $tests_done[$i], 'losses' => $losses[$i], 'positive_adj' => $pos_adj[$i], 'negative_adj' => $neg_adj[$i], 'closing_stock' => $physical_count[$i], 'q_expiring' => $q_expiring[$i], 'days_out_of_stock' => $days_out_of_stock[$i], 'q_requested' => $q_requested[$i]);
	        $this->details_model->update_order_details($mydata,$order_id,$drug_id[$i]);	        
	    }
	   	echo "1";
			    
	}

	function submit_report_ajax()
	{
		$form_data = $_POST['form'];		
		echo "<pre>";
		print_r($form_data);die();
		date_default_timezone_set("EUROPE/Moscow");
	    $firstday = date('D dS M Y', strtotime("first day of previous month"));
	    $lastday = date('D dS M Y', strtotime("last day of previous month"));
	    $lastmonth = date('F', strtotime("last day of previous month"));

	    $month = $lastmonth;
	    $district_id = $new_post['district'];
	    $facility_code = $new_post['facility_code'];
	    $drug_id = $new_post['commodity_id'];
	    $unit_of_issue = $new_post['unit_of_issue'];
	    $b_balance = $new_post['b_balance'];
	    $q_received = $new_post['q_received'];
	    $q_used = $new_post['q_used'];
	    $tests_done = $new_post['tests_done'];
	    $losses = $new_post['losses'];
	    $pos_adj = $new_post['pos_adj'];
	    $neg_adj = $new_post['neg_adj'];
	    $physical_count = $new_post['physical_count'];
	    $q_expiring = $new_post['q_expiring'];
	    $days_out_of_stock = $new_post['days_out_of_stock'];
	    $q_requested = $new_post['q_requested'];
	    $commodity_count = count($drug_id);

	    $vct = $new_post['vct'];
	    $pitc = $new_post['pitc'];
	    $pmtct = $new_post['pmtct'];
	    $b_screening = $new_post['blood_screening'];
	    $other = $new_post['other2'];
	    $specification = $new_post['specification'];
	    $rdt_under_tests = $new_post['rdt_under_tests'];
	    $rdt_under_pos = $new_post['rdt_under_positive'];
	    $rdt_btwn_tests = $new_post['rdt_to_tests'];
	    $rdt_btwn_pos = $new_post['rdt_to_positive'];
	    $rdt_over_tests = $new_post['rdt_over_tests'];
	    $rdt_over_pos = $new_post['rdt_over_positive'];
	    $micro_under_tests = $new_post['micro_under_tests'];
	    $micro_under_pos = $new_post['micro_under_positive'];
	    $micro_btwn_tests = $new_post['micro_to_tests'];
	    $micro_btwn_pos = $new_post['micro_to_positive'];
	    $micro_over_tests = $new_post['micro_over_tests'];
	    $micro_over_pos = $new_post['micro_over_positive'];
	    $beg_date = $new_post['begin_date'];
	    $end_date = $new_post['end_date'];
	    $explanation = $new_post['explanation'];
	    $compiled_by = $new_post['compiled_by'];
	    $approved_by = $new_post['approved_by'];
	    $moh_642 = $new_post['moh_642'];
	    $moh_643 = $new_post['moh_643'];

	    date_default_timezone_set('EUROPE/Moscow');
	    $beg_date = date('Y-m-d', strtotime("first day of previous month"));
	    $end_date = date('Y-m-d', strtotime("last day of previous month"));

	    $user_id = $this->session->userdata('user_id');        

	    $order_date = date('y-m-d');
	    $count = 1;
	    $data = array('facility_code' => $facility_code,'compiled_by' => $compiled_by,'approved_by' => $approved_by, 'order_date' => $order_date, 'vct' => $vct, 'pitc' => $pitc, 'pmtct' => $pmtct, 'b_screening' => $b_screening, 'other' => $other, 'specification' => $specification, 'rdt_under_tests' => $rdt_under_tests, 'rdt_under_pos' => $rdt_under_pos, 'rdt_btwn_tests' => $rdt_btwn_tests, 'rdt_btwn_pos' => $rdt_btwn_pos, 'rdt_over_tests' => $rdt_over_tests, 'rdt_over_pos' => $rdt_over_pos, 'micro_under_tests' => $micro_under_tests, 'micro_under_pos' => $micro_under_pos, 'micro_btwn_tests' => $micro_btwn_tests, 'micro_btwn_pos' => $micro_btwn_pos, 'micro_over_tests' => $micro_over_tests, 'micro_over_pos' => $micro_over_pos, 'beg_date' => $beg_date, 'end_date' => $end_date, 'explanation' => $explanation, 'moh_642' => $moh_642, 'moh_643' => $moh_643, 'report_for' => $lastmonth);
	    $this->load->model("Lab_orders_model",'orders_model');				
	    $order_id = $this->orders_model->save_order($data);

	    $this->load->model("Lab_details_model",'details_model');				
	    // $order_id = $this->details_model->save_order_details($data);

	    $count++;

	    for ($i = 0; $i < $commodity_count; $i++) {            
	        $mydata = array('order_id' => $order_id, 'facility_code' => $facility_code, 'commodity_id' => $drug_id[$i], 'beginning_bal' => $b_balance[$i], 'q_received' => $q_received[$i], 'q_used' => $q_used[$i], 'no_of_tests_done' => $tests_done[$i], 'losses' => $losses[$i], 'positive_adj' => $pos_adj[$i], 'negative_adj' => $neg_adj[$i], 'closing_stock' => $physical_count[$i], 'q_expiring' => $q_expiring[$i], 'days_out_of_stock' => $days_out_of_stock[$i], 'q_requested' => $q_requested[$i]);
	        $this->details_model->save_order_details($mydata);	        
	    }
	   
	    redirect('Home_controller');
	}
	
	function get_fcdrr_kits()
	{
		$mfl = $_POST['mfl'];		
		$this->load->model("Lab_commodity_categories_model",'commodity_categories');						
		$lab_categories = $this->commodity_categories->get_active();

		$this->load->model("Lab_categories_model",'categories');						
		$lab_commodities = $this->categories->get_active();

		$this->load->model("Lab_details_model",'lab_details');						
		$lab_details_begining_bal = $this->lab_details->get_begining_balance($mfl);
		$count_categories = count($lab_categories);		
		$data['count_categories'] = $count_categories;		
  		$data['beginning_bal'] = $lab_details_begining_bal;         
		$data['lab_commodities_categories'] = $lab_commodities;
		$data['lab_categories'] = $lab_categories;
		$data = json_encode($data);	
		echo $data;
	}

	function get_fcdrr_details()
	{
		$mfl = $_POST['mfl'];
		$this->load->model("Facilities_model",'facilities');				
		$facility_details = $this->facilities->get_one_mfl($mfl);
		$facility_name = $facility_details['facility_name'];
		$facility_code = $facility_details['facility_code'];
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];
		$this->load->model("Counties_model",'county');		
		$county_id = $this->session->userdata('county_id');
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];
		$this->load->model("Lab_commodity_categories_model",'commodity_categories');						
		// $lab_categories = $this->commodity_categories->get_active();

		// $this->load->model("Lab_categories_model",'categories');						
		// $lab_commodities = $this->categories->get_active();
		$data['banner_text'] = 'RTK - FCDRR Form For '.$facility_name.' ('.$mfl.')';
		$this->load->model("Lab_details_model",'lab_details');						
		$lab_details_begining_bal = $this->lab_details->get_begining_balance($mfl);
		$data['facility_code'] = $facility_code;
		$data['facility_name'] = $facility_name;
		$data['district_id'] = $district_id;
		$data['district_name'] = $district_name;
		$data['county_name'] = $county_name;
		$data = json_encode($data);		
		// $data = str_replace('"', "'", $data);
		echo $data;
	}

	function get_reporting_percentage()
	{
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Facilities_model",'facility');
		$this->load->model("Lab_orders_model",'orders');
		$this->load->model("Date_settings_model",'date_settings');
		$facility_details = $this->facility->get_all_in_district($district_id);				
		$total_facilities = count($facility_details);
	    $reported = 0;
	    $nonreported = 0;
	    foreach ($facility_details as $key => $value) {
	    	$mfl = $value['facility_code'];	    	
            $lab_count = $this->orders->get_recent_lab_orders($mfl);            
            if ($lab_count > 0) {
                $reported = $reported + 1;  	    		
            } else {
                $nonreported = $nonreported + 1;                                

            }           

	    }	   

	    $percentage = ceil(($reported/$total_facilities)*100);
	    $output[] = array('reported'=>$reported,'nonreported'=>$nonreported,'total'=>$total_facilities,'percentage'=>$percentage);	

	    echo json_encode($output);

	}
	
	function get_statistics()
	{
		$this->load->model("Lab_orders_model",'orders');		
		$district_id = $this->session->userdata('district_id');
		$late_reports = $this->orders->get_late_district_reports($district_id);
		$early_reports = $this->orders->get_early_district_reports($district_id);
		$all_reports = $this->orders->get_all_district_reports($district_id);
		$count_late = count($late_reports);
		$count_early = count($early_reports);
		$count_all = count($all_reports);		
		$statistics_details = array('all_reports'=>$count_all,'late_reports'=>$count_late,'early_reports'=>$count_early);
		echo json_encode($statistics_details);

	}	

	function get_stats_table()
	{
		$this->load->model("Lab_orders_model",'orders');		
		$this->load->model("Facilities_model",'facilities');		
		$this->load->model("Districts_model",'districts');		
		$county_id = $this->session->userdata('county_id');
		$districts_in_county = $this->districts->get_all_from_county($county_id);
		foreach ($districts_in_county as $key => $district) {
			$district_id = $district['id'];
			$district_name = $district['district'];
			$late_reports = $this->orders->get_late_district_reports($district_id);
			$all_reports = $this->orders->get_all_district_reports($district_id);
			$all_facilities = $this->facilities->get_total_in_district($district_id);
			$all_non_reporting_facilities = $this->facilities->get_all_nonreporting_in_district($district_id);
			$all_reporting_facilities = $this->facilities->get_all_reporting_in_district($district_id);

			$count_late = count($late_reports);
			$count_all = count($all_reports);
			$count_early = $count_all - $count_late;

			$reporting_facilities = count($all_reporting_facilities);
			$nonreporting_facilities = count($all_non_reporting_facilities);
			$total_facilities = count($all_facilities);

			$output[] = array($district_name,$total_facilities,$reporting_facilities,$nonreporting_facilities,$count_early,$count_late);
		}

		echo json_encode($output);			

	}	

	function get_stats_column()
	{
		$this->load->model("Lab_orders_model",'orders');		
		$this->load->model("Percentages_model",'percentage_model');		
		$this->load->model("Districts_model",'districts');		
		$county_id = $this->session->userdata('county_id');
		$districts_in_county = $this->districts->get_all_from_county($county_id);	
			
		foreach ($districts_in_county as $key => $district) {
			$district_id = $district['id'];			
			$district_name = $district['district'];
			$percentage_details = $this->percentage_model->get_district_percentage($district_id);				
		    $percentage = intval($percentage_details['percentage']);
			$districts[] = array($district_name);
			$percentages[] = array($percentage);			
		}
		$output[] = array('districts'=>$districts,'percentage'=>$percentages);
		echo json_encode($output);			

	}	

	function print_fcdrr($order_id,$report_type)
	{
		$this->load->model("Lab_details_model",'lab_details');	
		$lab_orders_details = $this->lab_details->get_all_from_order($order_id);

		$table_head = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
	    table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
	    table.data-table td, table th {padding: 4px;}
	    table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
	    .col5{background:#D8D8D8;}</style></table>
	    <table class="data-table" width="100%">
	        <thead>
	            <tr>
	                <th><strong>Category</strong></th>
	                <th><strong>Description</strong></th>
	                <th><strong>Unit of Issue</strong></th>
	                <th><strong>Beginning Balance</strong></th>
	                <th><strong>Quantity Received</strong></th>
	                <th><strong>Quantity Used</strong></th>
	                <th><strong>Number of Tests Done</strong></th>
	                <th><strong>Losses</strong></th>
	                <th><strong>Positive Adjustments</strong></th>
	                <th><strong>Negative Adjustments</strong></th>
	                <th><strong>Closing Stock</strong></th>
	                <th><strong>Quantity Expiring in 6 Months</strong></th>
	                <th><strong>Days Out of Stock</strong></th>
	                <th><strong>Quantity Requested</strong></th>
	            </tr>
	        </thead>
	        <tbody>';
	    $table_body = '';
        foreach ($lab_orders_details as $detail) {
            $table_body .= '<tr><td>' . $detail['category_name'] . '</td>';
            $table_body .= '<td>' . $detail['commodity_name'] . '</td>';
            $table_body .= '<td>' . $detail['unit_of_issue'] . '</td>';
            $table_body .= '<td>' . $detail['beginning_bal'] . '</td>';
            $table_body .= '<td>' . $detail['q_received'] . '</td>';
            $table_body .= '<td>' . $detail['q_used'] . '</td>';
            $table_body .= '<td>' . $detail['no_of_tests_done'] . '</td>';
            $table_body .= '<td>' . $detail['losses'] . '</td>';
            $table_body .= '<td>' . $detail['positive_adj'] . '</td>';
            $table_body .= '<td>' . $detail['negative_adj'] . '</td>';
            $table_body .= '<td>' . $detail['closing_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_expiring'] . '</td>';
            $table_body .= '<td>' . $detail['days_out_of_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_requested'] . '</td></tr>';
        }
        $table_foot = '</tbody></table>';
        $report_name = "Lab Commodities Order " . $order_id . " Details";
        $title = "Lab Commodities Order " . $order_id . " Details";
        $html_data = $table_head . $table_body . $table_foot;        
        switch ($report_type) {
	        case 'excel' :
	        $this->_generate_lab_report_excel($report_name, $title, $html_data);
	        break;
	        case 'pdf' :
	        $this->_generate_lab_report_pdf($report_name, $title, $html_data);
	        break;
	    }
	}

	function _generate_lab_report_pdf($report_name, $title, $html_data) {
        $html_title = "<div ALIGN=CENTER><img src='" . base_url() . "assets/img/coat_of_arms-resized.png' height='70' width='70'style='vertical-align: top;' > </img></div>
       	<div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>$title</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
            Ministry of Health</div>
            <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />";

            /*         * ********************************initializing the report ********************* */
            $this->load->library('mpdf');
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->SetTitle($title);
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML('<br/>');
            $this->mpdf->WriteHTML($html_data);
            $report_name = $report_name . ".pdf";
            $this->mpdf->Output($report_name, 'D');
        }

    //Generate the FCDRR Excel
        function _generate_lab_report_excel($report_name, $title, $html_data) {
            $data = $html_data;
            $filename = $report_name;
            header("Content-type: application/excel");
            header("Content-Disposition: attachment; filename=$filename.xls");
            echo "$data";
        }

}
