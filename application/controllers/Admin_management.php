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

            $p_c = 0;
            $p_p = 0;
            $p_p1 = 0;
            if(count($percentage_current)!=0){
                $p_c = intval($percentage_current[0]['percentage']);
            }
            if(count($percentage_past)!=0){
                $p_p = intval($percentage_past[0]['percentage']);
            }
            if(count($percentage_past1)!=0){
                $p_p1 = intval($percentage_past1[0]['percentage']);
            }            
            
            

            array_push($counties_list, $county_name);
            array_push($percentages_current_month, $p_c);
            array_push($percentages_last_month, $p_p);
            array_push($percentages_last_month1, $p_p1);
            
        }     
        $months_list = array($last_month_text1,$last_month_text,$current_month_text,$last_month_text_header);           
        $output = array('months_list'=>$months_list,'counties'=>$counties_list,'current_month'=>$percentages_current_month,'last_month'=>$percentages_last_month,'last_month1'=>$percentages_last_month1);               
        echo json_encode($output);        

    }

    function update_facility_details()
    {
        $facility_code = $this->input->post('facility_code');
        $facility_name = $this->input->post('facility_name');
        $district_id = $this->input->post('district_id');        
        $partner = $this->input->post('partner');
        $conditions = '';
        if($district_id!=0){
            $conditions.=" ,district ='$district_id'";
        }
        if($partner!=0){
            $conditions.=" ,partner ='$partner'";
        }
        $sql = "update facilities set facility_name = '$facility_name' $conditions where facility_code='$facility_code'";
        if($this->db->query($sql)){
            echo "Facility Updated Successfully";
        }else{
            echo "Facility Not Updated Successfully";
        }   
    }
    function add_facility_details()
    {
        $facility_code = $this->input->post('facility_code');
        $facility_name = $this->input->post('facility_name');
        $district_id = $this->input->post('district_id');        
        $partner = $this->input->post('partner');
        $owner = $this->input->post('owner');
        $facility_level = $this->input->post('facility_level');
        $facility_type = $this->input->post('facility_type');
        $pepfar_supported = 0;
        $rtk_enabled = 1;
        $cd4_enabled = 0;
        $date_of_activation = time();

        $conditions = '';
        if($district_id!=0){
            $conditions.=" ,district ='$district_id'";
        }
        if($partner!=0){
            $conditions.=" ,partner ='$partner'";
        }
        $sql = "INSERT INTO `facilities`( `facility_code`, `facility_name`, `district`, `partner`, `owner`, `type`, `level`, `rtk_enabled`,`pepfar_supported`, `cd4_enabled`, `date_of_activation`) 
                VALUES ('$facility_code','$facility_name','$district_id','$partner','$owner','$facility_type','$facility_level','$rtk_enabled','$pepfar_supported','$cd4_enabled','$date_of_activation')";
        // echo "$sql"; die;
        // $this->db->query($sql);
        if($this->db->query($sql)){
            echo "Facility Updated Successfully";
        }else{
            echo "Facility Not Updated Successfully";
        }   
    }

function get_national_counties(){
    $this->load->model("Counties_model",'counties_model');                                                        
    $option = '';                                           
    $option.='<option value="0">Select County</option>';
    $counties = $this->counties_model->get_all();
    foreach ($counties as $key => $value) {
        $id = $value['id'];
        $county = $value['county'];
        $option.='<option value="'.$id.'">'.$county.'</option>';
    }

    echo json_encode($option);
}

function get_national_subcounties($county_id){
    $this->load->model("Districts_model",'districts_model');                                                        
    $option = '';                                           
    $option.='<option value="0">Select Sub-County</option>';
    $districts = $this->districts_model->get_all_from_county($county_id);
    foreach ($districts as $key => $value) {
        $id = $value['id'];
        $district = $value['district'];
        $option.='<option value="'.$id.'">'.$district.'</option>';
    }

    echo json_encode($option);
}

function get_national_partners(){
    $this->load->model("Partners_model",'partners_model');                                                        
    $option = '';                                           
    $option.='<option value="0">Select Partner</option>';
    $partners = $this->partners_model->get_all();
    foreach ($partners as $key => $value) {
        $id = $value['ID'];
        $partner = $value['name'];
        $option.='<option value="'.$id.'">'.$partner.'</option>';
    }

    echo json_encode($option);
}
function get_national_facilities($zone = null,$county_id=null,$district_id=null,$partner = null)
{
    $this->load->model('Facilities_model','facilities_model');    
    $this->load->model('Partners_model','partners_model');    
    $conditions = '';
    if($zone!=0)
    {
        $conditions.=" and facilities.zone = Zone '$zone'";
    }
    if($county_id!=0)
    {
        $conditions.=" and counties.id = '$county_id'";
    }
    if($district_id!=0)
    {
        $conditions.=" and districts.id = '$district_id'";        
    }
    if($partner!=0)
    {
        $partner.=" and facilities.partner = '$partner'";        
    }
    $facilities = $this->facilities_model->get_all_with_conditions($conditions);    
    foreach ($facilities as $key => $value) {
        $id = $value['id'];
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $partner_id = $value['partner'];
        $county = $value['county'];
        $district = $value['district'];
        $rtk_enabled = $value['rtk_enabled'];
        $status = '';
        $link = '';
        $partner_name = null;
        if($partner_id!=0){
            $partner_dets= $this->partners_model->get_one_id($partner_id);
            $partner_name = $partner_dets['name'];
        }else{
            $partner_name = 'N/A';
        }
        $set_non_reporting_link = base_url().'Admin_management/change_reporting_status/'.$facility_code.'/0';
        $set_reporting_link = base_url().'Admin_management/change_reporting_status/'.$facility_code.'/1';
        if($rtk_enabled==1){
            $status.= 'Reporting <a href="'.$set_non_reporting_link.'"><span class="glyphicon glyphicon-minus"></span></a>';
            $link = '<button id="'.$facility_code.'" class="edit_facility_link" value="'.$facility_code.'" data-toggle="modal" data-target="#edit_facility">Edit </button>';

        }else if($rtk_enabled==0){
            $status.= 'Not Reporting <a href="'.$set_reporting_link.'"><span class="glyphicon glyphicon-plus"></span></a>';            
            $link = 'N/A';

        }               
        $output[] = array($county,$district,$partner_name,$facility_code,$facility_name,$status,$link);
    }
    // echo "<pre>";
    // print_r($output);die();
    echo json_encode($output);

}

function change_reporting_status($mfl,$type)
{
    $this->load->model('Facilities_model','facilities_model');        
    $this->facilities_model->change_reporting_status($mfl,$type);
    redirect('Admin/facilities');
}

function get_national_trend($month=null)
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
    $reported = 0;
    $facilities = 0;
    $reporting_rate = 0;
    if(count($reporting_rates)!=0){
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
    }else{          
        $count = 0;
        $order_date = date('d');                
        $order_date = date('jS', strtotime($order_date));
        $cumulative_result =0;
        array_push($xArr1, $cumulative_result);

        array_push($yArr, $order_date);
        array_push($xArr, $count);

        $reported = 0;
        $facilities = 0;
        $reporting_rate = 0;
            
    }
    
   
    
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