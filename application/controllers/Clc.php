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
}
?>