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
		
		$this->load->view($template,$data);

	}

	function get_report($mfl)
	{		
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
		$lab_categories = $this->commodity_categories->get_active();

		$this->load->model("Lab_categories_model",'categories');						
		$lab_commodities = $this->categories->get_active();
		// echo "<pre>";

		// print_r($lab_commodities);die();
		$template='scmlt/template_fcdrr';
		$data['title'] = 'SCMLT FCDRR ';
		$data['banner_text'] = 'RTK - FCDRR Form For '.$facility_name;
		$data['content_view'] = 'scmlt/fcdrr_form';		
		$data['facility_code'] = $facility_code;
		$data['facility_name'] = $facility_name;
		$data['district_id'] = $district_id;
		$data['district_name'] = $district_name;
		$data['county_name'] = $county_name;
		$data['lab_commodities_categories'] = $lab_commodities;
		$data['lab_categories'] = $lab_categories;
		$this->load->view($template,$data);

	}

	function view_report($mfl)
	{		
		$this->load->model("Districts_model",'district');		
		$district_id = $this->session->userdata('district_id');
		$district_details = $this->district->get_one_id($district_id);
		$district_name = $district_details['district'];

		$template='scmlt/template_fcdrr';
		$data['title'] = 'SCMLT Home ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$district_name.' Sub-County Home';
		$data['content_view'] = 'scmlt/home_v';
		
		$this->load->view($template,$data);

	}

	

}
