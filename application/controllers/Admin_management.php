<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Admin_management extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    /////**** Home Page Stuff *////
    function get_main_graph_()
    {
        $this->load->model("Percentages_model",'percentage_model'); 
        $county_id = $this->session->userdata('county_id');
        $reporting_rates = $this->percentage_model->get_district_percentages_county($county_id);
        $this->load->model("Date_Settings_model",'date_settings');
        $previous_month_details =$this->date_settings->get_previous_month();    
        $districts = array();
        $reported = array();
        $nonreported = array();
        foreach ($reporting_rates as $key => $value) {
            array_push($districts, $value['district']);  
            $percentage_reported = intval($value['percentage']);
            if($percentage_reported >100){
                $percentage_reported=100;
            }else{
                $percentage_reported = intval($value['percentage']);
            }

            array_push($reported, $percentage_reported);
            $percentage_non_reported = 100 - $percentage_reported;
            array_push($nonreported, $percentage_non_reported);
        }   
        $englishdate = $previous_month_details['englishdate'];                                                                                      

        $reporting_rates = array('districts'=>$districts,'reported'=>$reported,'nonreported'=>$nonreported,'englishdate'=>$englishdate);       
        echo json_encode($reporting_rates);        

    }

    public function get_main_graph() {
        // get all counties
    $this->load->model("Counties_model",'counties_model'); 
    $counties = $this->counties_model->get_all();

    $this->load->model("Percentages_model",'percentages_model'); 
    $percentages = $this->percentages_model->get_all_county_percentage();
    
    echo"<pre>";print_r($percentages);


}
function get_stock_status(){
    if(isset($month)){           
        $year = substr($month, -4);
        $month = substr($month, 0,2);            
        $monthyear = $year . '-' . $month . '-01';         

    }else{
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', time());
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $monthyear = $year . '-' . $month . '-01';
    }
    
    $this->load->model("Lab_details_model",'lab_details_model'); 
    $lab_details = $this->lab_details_model->get_total_summary($year, $month);
    $this->load->model("Counties_model",'counties_model'); 
    $counties = $this->counties_model->get_all();

    
   // echo "<pre>"; print_r($lab_details); die;
    $englishdate = date('F, Y', strtotime($monthyear));
    $count =0;
    for ($i=0; $i < count($lab_details); $i++) { 
       
    foreach ($lab_details[$i] as $key => $value) {
        $county = $value ['county'];
        $commodity_name = $value ['commodity_name'];
        $beg_bal = $value ['sum_opening'];
        $recieved_qty = $value['sum_received'];
        $qty_used = $value['sum_used'];
        $test_done = $value['sum_tests'];
        $end_bal = $value['sum_closing_bal'];
        $qty_requested = $value['sum_requested'];
        $qty_expiring = $value['sum_expiring'];
    $output[] = array($county,$commodity_name,$beg_bal,$recieved_qty,$qty_used,$test_done,$end_bal,$qty_requested,$qty_expiring); 
    $count++;      
    }
}
   // echo "<pre>"; print_r($output); die;
    echo json_encode($output);        
    
    // $data['stock_status'] = $this->lab_details($year, $month);           
    // $data['englishdate'] = $englishdate;
    // $County = $counties('county_name');
    // $data['county'] = $County;
    // $Countyid = $counties('county_id');   
    // $data['active_month'] = $month.$year;
    // $data['content_view'] = "rtk/rtk/admin/stocks_v";
    // $data['banner_text'] = "RTK Manager";
    // $data['title'] = "RTK Manager";
    // $this->load->view('rtk/template', $data);
}


}
?>