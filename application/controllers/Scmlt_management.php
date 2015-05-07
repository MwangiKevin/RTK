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

	}


	function get_scmlt_home()
	{
		$district_id = $this->session->userdata('district_id');		
		$this->load->model("Facilities_model",'facility');
		$this->load->model("Lab_orders_model",'orders');
		$facility_details = $this->facility->get_all_in_district($district_id);
		$deadline_date = 15;		
	    $table_body = '';
	    $date = date('d', time());
	    $reported = 0;
	    $nonreported = 0;
	    foreach ($facility_details as $key => $value) {
	    	$mfl = $value['facility_code'];
	    	$facility_name = $value['facility_name'];
	    	$owner = $value['owner'];
	    	$lastmonth = date('F', strtotime("last day of previous month"));
	    	$report_link = "<a href=" . site_url('Scmlt/get_report/' . $mfl) . " class='link report'>&nbsp;Report</a>";
	    	$view_link = "<a href=" . site_url('Scmlt/view_report/' . $mfl) . " class='link report'>&nbsp;View</a>";

            if($date>$deadline_date){                
	    		$report_status = '<span class="label-danger label">Pending for '.$lastmonth.'</span>';                
            }else{
                $report_status = '<span class="label-danger label">Pending for '.$lastmonth.'</span>';                
            }
            $lab_count = $this->orders->get_recent_lab_orders($mfl);            
            if ($lab_count > 0) {
                $reported = $reported + 1;  
	    		$report_status = '<span class="label-success label">Submitted for '.$lastmonth.'</span>';                                                            
                $report_status .=$view_link;
            } else {
                $nonreported = $nonreported + 1;                
                $report_status.=$report_link;

            }

            $output[] = array($mfl,$facility_name,$owner,$report_status);


	    }	   
		echo json_encode($output);
	}
	

}
