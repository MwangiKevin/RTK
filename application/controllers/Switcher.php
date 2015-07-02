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
}

?>