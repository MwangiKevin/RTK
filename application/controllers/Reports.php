<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Reports extends CI_Controller 
{
		
 function index() {	

    $usertype_id = $this->session->userdata('usertype_id');     
    switch ($usertype_id) 
    {
        case '1':
            redirect('Reports/scmlt_home');              
            break;
        case '2':
            redirect('Reports/clc_home');                
            break;
        case '3':
            redirect('Reports/partner_home');              
            break;
        case '4':
            redirect('Reports/partner_admin_home');              
            break;
        case '5':
            redirect('Reports/admin_home');                              
            break;
        case '6':
            redirect('Reports/allocation_home');                                                      
            break;
        case '7':
            redirect('Reports/pepfar_home');                                                                          
            break;
        
        default:
            # code...
            break;
    }   

}

    function scmlt_home(){
        $data['content_view'] = "reports/scmlt/national_reports";
        $data['title'] = "SCMLT Reports";
        $data['link'] = "home";      
        $data['banner_text'] = 'Rapid Test Kit System Reports';        
        $data['location'] = 'You are on RTK-> Reports ->SCMLT';   
        $this->load->view('reports/template/template', $data);
    }
    function clc_home(){
        $data['content_view'] = "reports/clc/national_reports";
        $data['title'] = "CLC Reports";
        $data['link'] = "home";       
        $data['banner_text'] = 'Rapid Test Kit System Reports';        
        $data['location'] = 'You are on RTK-> Reports ->CMCL'; 
        $this->load->view('reports/template/template', $data);
    }
    function admin_home(){
        $data['content_view'] = "reports/national/national_reports";
        $data['title'] = "Administrator Reports";
        $data['link'] = "home";        
        $data['banner_text'] = 'Rapid Test Kit System Reports';        
        $data['location'] = 'You are on RTK-> Reports ->Administrator';
        $this->load->view('reports/template/template', $data);
    }

	function national_clc() {	
    
    $data['content_view'] = "reports/national/county_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    $data['banner_text'] = 'Rapid Test Kit System Reports';        
    $data['location'] = 'You are on RTK-> Reports ->National Administrator';     
    $this->load->view('reports/template/template', $data);

	}
	function national_partner() {	
    
    $data['content_view'] = "reports/national/partner_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    $data['banner_text'] = 'Rapid Test Kit System Reports';        
    $data['location'] = 'You are on RTK-> Reports ->National Partner'; 
    $this->load->view('reports/template/template', $data);

	}
	function national_commodity_usage() {	
    
    $data['content_view'] = "reports/national/commodity_usage_reports";
    $data['title'] = "Reports";
    $data['link'] = "home";
    $data['banner_text'] = 'Rapid Test Kit System Commodity Usage';        
    $data['location'] = 'You are on RTK-> Reports ->National Administrator'; 
    $this->load->view('reports/template/template', $data);

	}


}
?>