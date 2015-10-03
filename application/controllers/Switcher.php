<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Switcher extends CI_Controller {


	function index()
	{
		echo "<pre>";
		$sessdata = $this->session->all_userdata();
		print_r($sessdata);
		echo "</pre>";
	}

	function switch_county($switched_from,$switched_to)
	{	
		$this->load->model("Districts_model",'districts_model');				
		$this->session->set_userdata('county_id', $switched_to);	
		if($switched_from=='view_facilities'){			
			$district_dets = $this->districts_model->get_first_from_county($switched_to);
			$district_id = $district_dets[0]['id'];			
			$switched_from = $district_id;
		}elseif ($switched_from=='Clc') {
			$switched_from = '';
		}elseif ($switched_from=='Sub_county') {
			$switched_from = '';
		}		
		echo json_encode( array( 'redirect' => $switched_from ) );		
	}

	function switch_district($switched_from,$switched_to)
	{	
		$this->load->model("Districts_model",'districts_model');		
		$this->session->set_userdata('district_id', $switched_to);			
		echo json_encode( array( 'redirect' => $switched_from ) );		
	}

	function switch_admin($switched_type,$switched_to)
	{	
		$this->load->model("Districts_model",'districts_model');		
		
		if($switched_type=='scmlt'){
			$this->session->set_userdata('district_id', $switched_to);	
			$district_details = $this->districts_model->get_one_id($switched_to);				
			$county_id = $district_details['county'];
			$this->session->set_userdata('county_id', $county_id);			
			$this->session->set_userdata('usertype_id', 1);	
			$this->session->set_userdata('switched_from_main', 'admin');	
		}else if($switched_type=='clc'){
			$this->session->set_userdata('county_id', $switched_to);	
			$this->session->set_userdata('usertype_id',2);	
			$this->session->set_userdata('switched_from_main', 'admin');	
		}else if($switched_type=='partner'){			
			$this->session->set_userdata('usertype_id',4);	
			$this->session->set_userdata('switched_from_main', '');	
			$this->session->set_userdata('switched_from_sec', 'admin');	
		}
		redirect('Home_controller');
		
	}

	function switch_back_admin()
	{	
		$switched_from = $this->session->userdata('switched_from_main');
		if($switched_from!=''){		
			$this->session->set_userdata('usertype_id', 5);	
			$this->session->set_userdata('switched_from_main', '');	
			$this->session->set_userdata('switched_from_sec', '');	
		}
		redirect('Home_controller');
		
	}
}

?>