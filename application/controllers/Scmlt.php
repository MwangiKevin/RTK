<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Scmlt extends CI_Controller {

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
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];

		$template='scmlt/template';
		$data['title'] = 'SCMLT Home ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/home_v';
		$data['location'] = 'You are on RTK-> Sub County -> Home';
		$data['active_link'] = 'home';		
		$this->load->view($template,$data);

	}

	function orders()
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];

		$template='scmlt/template';
		$data['title'] = 'SCMLT Orders ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/orders_v';
		$data['location'] = 'You are on RTK-> Sub County -> Orders';
		$data['active_link'] = 'orders';		
		$this->load->view($template,$data);

	}

	function statistics()
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];

		$template='scmlt/template';
		$data['title'] = 'SCMLT Statistics ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/statistics_v';
		$data['location'] = 'You are on RTK-> Sub County -> Statistics';
		$data['active_link'] = 'statistics';		
		$this->load->view($template,$data);

	}

	function allocations()
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];

		$template='scmlt/template';
		$data['title'] = 'SCMLT Allocations ';		
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/allocations_v';
		$data['location'] = 'You are on RTK-> Sub County -> Allocations';
		$data['active_link'] = 'allocations';		
		$this->load->view($template,$data);

	}

	function get_report($mfl)
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);	
		$district_name = $district_details['district'];
		$county_id = $district_details['county'];
		$this->load->model("Counties_model",'county');				
		$county_details = $this->county->get_one_id($county_id);	
		$county_name = $county_details['county'];

		$this->load->model("Facilities_model",'facilities');			
		$this->load->model("Date_settings_model",'date_settings');

		$this->load->model("Lab_commodity_categories_model",'commodity_categories');						
		$lab_categories = $this->commodity_categories->get_active();
		$this->load->model("Lab_details_model",'lab_details');						
		$this->load->model("Lab_categories_model",'categories');						
		$lab_commodities = $this->categories->get_active();
		$lab_details_begining_bal = $this->lab_details->get_begining_balance($mfl);	
		$facility_details = $this->facilities->get_one_mfl($mfl);
		$facility_name = $facility_details['facility_name'];
		$facility_code = $facility_details['facility_code'];	

		$previous_month_details =$this->date_settings->get_previous_month();


		// $template='scmlt/template_fcdrr_multiple';
		$template='scmlt/template_fcdrr';
		$data['title'] = 'SCMLT FCDRR ';
		$data['mfl'] = $mfl;
		// $data['content_view'] = 'scmlt/fcdrr_multiple';		
		$data['content_view'] = 'scmlt/fcdrr_form';				
		$data['facility_code'] = $facility_code;
		$data['beg_date'] = $previous_month_details['first_date_slash'];
		$data['end_date'] = $previous_month_details['last_date_slash'];
		$data['facility_name'] = $facility_name;
		$data['district_id'] = $district_id;
		$data['district_name'] = $district_name;
		$data['county_name'] = $county_name;
		$data['banner_text'] = 'RTK - FCDRR Form For '.$facility_name;		
  		$data['count_categories'] = count($lab_categories);         
  		$data['beginning_bal'] = $lab_details_begining_bal;         
		$data['lab_commodities_categories'] = $lab_commodities;
		$data['lab_categories'] = $lab_categories;
		$this->load->view($template,$data);

	}

	function view_report($order_id)
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);	
		$district_name = $district_details['district'];
		$county_id = $district_details['county'];
		$this->load->model("Counties_model",'county');				
		$county_details = $this->county->get_one_id($county_id);	
		$county_name = $county_details['county'];
		$this->load->model("Facilities_model",'facilities');			
		$this->load->model("Date_settings_model",'date_settings');
		$this->load->model("Lab_commodity_categories_model",'commodity_categories');						
		$lab_categories = $this->commodity_categories->get_active();
		$this->load->model("Lab_details_model",'lab_details');						
		$this->load->model("Lab_orders_model",'lab_orders');						
		$this->load->model("Lab_categories_model",'categories');						
		$order_details = $this->lab_orders->get_order_details($order_id);
		$lab_details_all = $this->lab_details->get_all_from_order($order_id);
		// echo "<pre>";
		// print_r($order_details);die();
		$mfl = $order_details['facility_code'];
		$lab_commodities = $this->categories->get_active();

		$lab_details_begining_bal = $this->lab_details->get_begining_balance($mfl);	
		$facility_details = $this->facilities->get_one_mfl($mfl);
		$facility_name = $facility_details['facility_name'];
		$facility_code = $facility_details['facility_code'];	

		$previous_month_details =$this->date_settings->get_previous_month();		
		
		$template='scmlt/template_fcdrr';
		$data['title'] = 'SCMLT Home ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/fcdrr_edit';
		$data['facility_code'] = $facility_code;
		$data['beg_date'] = $previous_month_details['first_date_slash'];
		$data['end_date'] = $previous_month_details['last_date_slash'];
		$data['facility_name'] = $facility_name;
		$data['district_id'] = $district_id;
		$data['district_name'] = $district_name;
		$data['county_name'] = $county_name;
		$data['order_details'] = $order_details;
		$data['count_categories'] = count($lab_categories);         
		$data['county_name'] = $county_name;		

		$data['count_categories'] = count($lab_categories);         
		$data['all_details'] = $lab_details_all;         
  		$data['beginning_bal'] = $lab_details_begining_bal;         
		$data['lab_commodities_categories'] = $lab_commodities;
		$data['lab_categories'] = $lab_categories;		
		$this->load->view($template,$data);

	}
	function view_report_mfl($mfl)
	{		
		$this->load->model("Lab_orders_model",'orders_model');	;
		$order_details = $this->orders_model->get_latest_lab_orders($mfl);		
		$link = 'Scmlt/view_report/'.$order_details['order_id'];
		redirect($link);		

	}


	function migrate_order_details()
	{
		ini_set(MAX_EXECUTION_TIME, -1);
		$a = 0;
		$b = 50;
		while($b<=65050){
		// while($b<=){
		
			$this->load->model("Lab_orders_model",'orders_model');		
			$this->load->model("Lab_details_model",'details_model');				

			$orders = $this->orders_model->get_all_old($a,$b);
			foreach ($orders as $key => $order) {
				$order_id = $order['id'];
				$facility_code = $order['facility_code'];
				$order_date = $order['order_date'];
				$vct = $order['vct'];
				$pitc = $order['pitc'];
				$other = $order['other'];
				$pmtct = $order['pmtct'];
				$b_screening = $order['b_screening'];
				$specification = $order['specification'];
				$rdt_under_tests = $order['rdt_under_tests'];
				$rdt_under_pos = $order['rdt_under_pos'];
				$rdt_btwn_tests = $order['rdt_btwn_tests'];
				$rdt_btwn_pos = $order['rdt_btwn_pos'];
				$rdt_over_tests = $order['rdt_over_tests'];
				$rdt_over_pos = $order['rdt_over_pos'];
				$micro_under_tests = $order['micro_under_tests'];
				$micro_under_pos = $order['micro_under_pos'];
				$micro_btwn_tests = $order['micro_btwn_tests'];
				$micro_btwn_pos = $order['micro_btwn_pos'];
				$micro_over_tests = $order['micro_over_tests'];
				$micro_over_pos = $order['micro_over_pos'];
				$beg_date = $order['beg_date'];
				$end_date = $order['end_date'];
				$explanation = $order['explanation'];
				$moh_642 = $order['moh_642'];
				$moh_643 = $order['moh_643'];
				$compiled_by = $order['compiled_by'];
				// $approved_by = $order['approved_by'];
				$created_at = $order['created_at'];
				$report_for = $order['report_for'];		
				if($compiled_by=='')
				{
					$compiled_by = 'UNSPECIFIED';
				}			
				$approved_by = 'UNSPECIFIED';			

				$data = array('id'=>$order_id,'facility_code' => $facility_code,'compiled_by' => $compiled_by,'approved_by' => $approved_by, 'order_date' => $order_date, 'vct' => $vct, 'pitc' => $pitc, 'pmtct' => $pmtct, 'b_screening' => $b_screening, 'other' => $other, 'specification' => $specification, 'rdt_under_tests' => $rdt_under_tests, 'rdt_under_pos' => $rdt_under_pos, 'rdt_btwn_tests' => $rdt_btwn_tests, 'rdt_btwn_pos' => $rdt_btwn_pos, 'rdt_over_tests' => $rdt_over_tests, 'rdt_over_pos' => $rdt_over_pos, 'micro_under_tests' => $micro_under_tests, 'micro_under_pos' => $micro_under_pos, 'micro_btwn_tests' => $micro_btwn_tests, 'micro_btwn_pos' => $micro_btwn_pos, 'micro_over_tests' => $micro_over_tests, 'micro_over_pos' => $micro_over_pos, 'beg_date' => $beg_date, 'end_date' => $end_date, 'explanation' => $explanation, 'moh_642' => $moh_642, 'moh_643' => $moh_643, 'report_for' => $report_for);
		    	$this->orders_model->save_order_old($data);	    	
		    	$order_details = $this->details_model->get_all_old($order_id);
		    	foreach ($order_details as $key => $value) {
		    		$commodity_id = $value['commodity_id'];
		    		$order_id_new = $value['order_id'];
		    		$facility_code_new = $value['facility_code'];
		    		$beginning_bal = $value['beginning_bal'];
		    		$q_used = $value['q_used'];
		    		$q_received = $value['q_received'];
		    		$no_of_tests_done = $value['no_of_tests_done'];
		    		$losses = $value['losses'];
		    		$positive_adj = $value['positive_adj'];
		    		$negative_adj = $value['negative_adj'];
		    		$closing_stock = $value['closing_stock'];
		    		$q_expiring = $value['q_expiring'];
		    		$days_out_of_stock = $value['days_out_of_stock'];
		    		$q_requested = $value['q_requested'];
		    		$created_at = $value['created_at'];
		    		$allocated = $value['allocated'];
		    		$allocated_date = $value['allocated_date'];
		    		$mydata = array('order_id' => $order_id_new,
		    		 'facility_code' => $facility_code_new,
		    		  'commodity_id' => $commodity_id, 
		    		  'beginning_bal' => $beginning_bal,
		    		   'q_received' => $q_received, 
		    		   'q_used' => $q_used,
		    		    'no_of_tests_done' => $no_of_tests_done, 
		    		    'losses' => $losses,
		    		     'positive_adj' => $positive_adj,
		    		      'negative_adj' => $negative_adj,
		    		       'closing_stock' => $closing_stock,
		    		        'q_expiring' => $q_expiring,
		    		         'days_out_of_stock' => $days_out_of_stock,
		    		          'q_requested' => $q_requested,		    		         
		    		          'created_at'=>$created_at);

		    		$this->details_model->save_order_details_old($mydata);	    	

		    	}
		    	

			}
			$a = $b;
			$b+=50;

		}

	}

	

}
