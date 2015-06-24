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
    function get_main_graph()
    {
        $current_month = date('mY', strtotime('-0 month'));
        $current_month_text = date('F-Y', strtotime('-1 month'));
        $last_month = date('mY', strtotime('-1 month'));
        $last_month_text = date('F-Y', strtotime('-2 month'));
        $last_month1 = date('mY', strtotime('-2 month'));
        $last_month_text1 = date('F-Y', strtotime('-3 month'));
        $last_month_text_header = date('F, Y', strtotime('-1 month'));
        
        $this->load->model("Percentages_model",'percentage_model'); 
        $this->load->model("Counties_model",'county_model'); 
        $counties = $this->county_model->get_all();
        $counties_list = array();
        $percentages_current_month = array();
        $percentages_last_month = array();
        $percentages_last_month1 = array();
        foreach ($counties as $key => $value) {
            $county_id = $value['id'];
            $county_name = $value['county'];

            $sqlp1 = "select percentage from rtk_county_percentage where county_id ='$county_id' and month='$last_month1'";
            $sqlp = "select percentage from rtk_county_percentage where county_id ='$county_id' and month='$last_month'";
            $sqlc = "select percentage from rtk_county_percentage where county_id ='$county_id' and month='$current_month'";

            $percentage_current = $this->db->query($sqlc)->result_array();
            $percentage_past = $this->db->query($sqlp)->result_array();
            $percentage_past1= $this->db->query($sqlp1)->result_array();
            $p_c = intval($percentage_current[0]['percentage']);
            $p_p = intval($percentage_past[0]['percentage']);
            $p_p1 = intval($percentage_past1[0]['percentage']);

            array_push($counties_list, $county_name);
            array_push($percentages_current_month, $p_c);
            array_push($percentages_last_month, $p_p);
            array_push($percentages_last_month1, $p_p1);
            
        }     
        $months_list = array($last_month_text1,$last_month_text,$current_month_text,$last_month_text_header);           
        $output = array('months_list'=>$months_list,'counties'=>$counties_list,'current_month'=>$percentages_current_month,'last_month'=>$percentages_last_month,'last_month1'=>$percentages_last_month1);               
        echo json_encode($output);        

    }

public function get_national_trend($month=null)
{
    $this->load->model('Percentages_model','percentage_model');
    if(isset($month)){           
        $year = substr($month, -4);
        $month = substr($month, 0,2);            
        $monthyear = $year . '-' . $month . '-1';         
        $db_month = $month.$year;
    }else{
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', time());
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $monthyear = $year . '-' . $month . '-1';
        $db_month = $month.$year;
    }    
    // $month = 4;
    $englishdate = date('F, Y', strtotime($monthyear));

    $percentage_results = $this->percentage_model->get_all_county_percentage_month($db_month);    
    $reporting_rates = $this->percentage_model->reporting_rates(null,$year,$month);    
    
    $xArr = array();
    $yArr = array();
    $xArr1 = array();
    $cumulative_result = 0;
    foreach ($reporting_rates as $value) {
        $count = intval($value['count']);
        $order_date = substr($value['order_date'], -2);
        $order_date = date('jS', strtotime($value['order_date']));
        $cumulative_result +=$count;
        array_push($xArr1, $cumulative_result);
        array_push($yArr, $order_date);
        array_push($xArr, $count);
    }  
    $reported = intval($percentage_results['reported']);
    $facilities = intval($percentage_results['facilities']);
    $reporting_rate = ceil(($reported/$facilities)*100);
    
    $jsony = $yArr;
    $jsonx = $xArr;
    $jsonx1 = $xArr1;   
    $output = array('englishdate'=>$englishdate,'jsonx'=>$xArr,'jsony'=>$yArr,'jsonx1'=>$xArr1,'cumulative_result'=>$cumulative_result,'reported'=>$reported,'reporting_rate'=>$reporting_rate);               
    echo json_encode($output);        
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