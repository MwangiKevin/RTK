<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Clc extends CI_Controller {

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
		$this->load->model("Counties_model",'county');		
		$county_id = $this->session->userdata('county_id');
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];


		$template='clc/template';
		$data['title'] = 'CLC Home ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$county_name.' County';
		$data['content_view'] = 'clc/home_v';
		$data['location'] = 'You are on RTK-> County -> Home';
		$data['active_link'] = 'home';		
		$this->load->view($template,$data);

	}

	function statistics()
	{		
		$this->load->model("Counties_model",'county');		
		$county_id = $this->session->userdata('county_id');
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];


		$template='clc/template';
		$data['title'] = 'CLC Statistics ';
		$data['banner_text'] = 'Rapid Test Kit System - '.$county_name.' County';
		$data['content_view'] = 'clc/statistics_v';
		$data['location'] = 'You are on RTK-> County -> Statistics';
		$data['active_link'] = 'statistics';		
		$this->load->view($template,$data);

	}

	function sub_county()
	{		
		$this->load->model("Counties_model",'county');		
		$this->load->model("Districts_model",'districts_model');		
		$county_id = $this->session->userdata('county_id');			
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];
		$districts_details = $this->districts_model->get_all_from_county($county_id);		
		foreach ($districts_details as $key => $value) {
			$id = $value['id'];
			$dname = $value['district'];			
			$link = '<a id="'.$id.'" class="menu_link" href="#">'.$dname.'</a>';
			// $link = '<a id="'.$id.'" href="'.site_url().'Clc_management/sub_county/'.$id.'">'.$dname.'</a>';
			$menu_list[]=array('id'=>$id,'menu'=>$link);
		}				
		$template='clc/template_sub';
		$data['title'] = 'CLC Sub_Counties ';
		$data['menu'] = $menu_list;
		$data['banner_text'] = 'Rapid Test Kit System - '.$county_name.' County';
		$data['content_view'] = 'clc/subcounty_v';		
		$data['active_link'] = 'statistics';		
		$this->load->view($template,$data);

	}

	function view_facilities($district_id)
	{		
		$this->load->model("Facilities_model",'facilities_model');		
		$this->load->model("Districts_model",'districts_model');		
		$this->load->model("Counties_model",'county');		
		$county_id = $this->session->userdata('county_id');		
		$county_details = $this->county->get_one_id($county_id);
		$county_name = $county_details['county'];
		$facilities = $this->facilities_model->get_all_in_district($district_id);			
		foreach ($facilities as $key => $value) {
			$mfl = $value['facility_code'];
			$fname = $value['facility_name'];			
			$link = '<a id="'.$mfl.'" class="menu_link" href="#">'.$fname.'</a>';			
			$menu_list[]=array('id'=>$mfl,'menu'=>$link);
		}				
		$template='clc/template_fac';
		$data['title'] = 'CLC Facilities ';
		$data['menu'] = $menu_list;
		$data['district_id'] = $district_id;
		$data['banner_text'] = 'Rapid Test Kit System - '.$county_name.' County';
		$data['content_view'] = 'clc/facilities_v';		
		$data['active_link'] = 'statistics';		
		$this->load->view($template,$data);

	}
}
?>