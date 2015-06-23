<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Reports extends CI_Controller 
{
		
 function index() {	
    
    $data['content_view'] = "reports/national/national_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    
    $this->load->view('reports/template/template', $data);

	}
	function national_clc() {	
    
    $data['content_view'] = "reports/national/county_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    
    $this->load->view('reports/template/template', $data);

	}
	function national_partner() {	
    
    $data['content_view'] = "reports/national/partner_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    
    $this->load->view('reports/template/template', $data);

	}
	function national_commodity_usage() {	
    
    $data['content_view'] = "reports/national/commodity_usage_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    
    $this->load->view('reports/template/template', $data);

	}


}
?>