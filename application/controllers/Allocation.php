<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Allocation extends CI_Controller {

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
		$template='allocation/template';
		$data['title'] = 'Allocation Home ';
		$data['banner_text'] = 'Rapid Test Kit System Summary';
		$data['content_view'] = 'allocation/home_v';
		$data['location'] = 'You are on RTK-> Home';
		$data['active_link'] = 'home';		
		$this->load->view($template,$data);

	}
	function get_zones()
	{		
		$template='allocation/template';
		$data['title'] = 'Allocation Zones ';
		$data['banner_text'] = 'Rapid Test Kit System Summary';
		$data['content_view'] = 'allocation/zones';
		$data['location'] = 'You are on RTK-> Zones';
		$data['active_link'] = 'get_zones';	
		$current_month = date('mY');
		$sql = "select sum(distinct rtk_county_percentage.facilities) as total,sum(distinct rtk_county_percentage.reported) as reported from counties, rtk_county_percentage where rtk_county_percentage.county_id = counties.id and counties.zone in ('A','B','C','D') and rtk_county_percentage.month = '$current_month' group by counties.zone order by counties.zone asc";		
		$res_facilities = $this->db->query($sql)->result_array();
		$total_array = array();
		$percentage_array = array();
		if (count($res_facilities)>0) {
			
		foreach ($res_facilities as $value) {
			$total = intval($value['total']);
			$reported = intval($value['reported']);
			$percentage = round(($reported/$total)*100);
			if($percentage>100){
				$percentage =100;
			}
			array_push($total_array, $total);
			array_push($percentage_array, $percentage);			
		}

		
		$last_allocated = array(1000,1467,2000,900);
		$zone_data = array('facilities'=>$total_array,'percentage'=>$percentage_array,'last_allocated'=>$last_allocated);

		}else{
		$zone_data = array('facilities'=>0,'percentage'=>0,'last_allocated'=>0);

		}

		$data['zone_data'] = $zone_data;	
		$this->load->view($template,$data);

	}
	function allocation_details()
	{		
		$template='allocation/template';
		$data['title'] = 'Allocation';
		$data['banner_text'] = 'Rapid Test Kit System Summary';
		$data['content_view'] = 'allocation/allocation_v';
		$data['location'] = 'You are on RTK-> Allocation';
		$data['active_link'] = 'allocation_v';		
		$this->load->view($template,$data);

	}
	function get_stock_card()
	{		
		$template='allocation/template';
		$data['title'] = 'Allocation Stock Card ';
		$data['banner_text'] = 'Rapid Test Kit System Summary';
		$data['content_view'] = 'allocation/stock_card';
		$data['location'] = 'You are on RTK-> National Stock Card';
		$data['active_link'] = 'get_stock_card';		
		$this->load->view($template,$data);

	}
	function get_non_reported_facilities()
	{		
		$template='allocation/template';
		$data['title'] = 'Non Reported Facilities ';
		$data['banner_text'] = 'Rapid Test Kit System Summary';
		$data['content_view'] = 'allocation/non_reported_facilities';
		$data['location'] = 'You are on RTK-> Non Reported Facilities';
		$data['active_link'] = 'get_non_reported_facilities';		
		$this->load->view($template,$data);

	}

	
}
?>