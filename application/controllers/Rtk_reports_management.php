<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Rtk_reports_management extends CI_Controller 
{

    function get_percentage_months($county_id=null){
        $current_month = date('mY', strtotime('-0 month',time()));    
        $previous_month = date('mY', strtotime('-1 month',time()));    
        $two_months_ago = date('mY', strtotime('-2 month',time()));                        

        $current_month_text = date('F-Y', strtotime('-1 month',time()));    
        $previous_month_text = date('F-Y',strtotime('-2 month',time()));    
        $two_months_ago_text = date('F-Y',strtotime('-3 month',time()));
        $header_text = null;
        $type = '';
        if($county_id==0){       
            $type = 'County';
            $header_text = 'National Percentages from '.$two_months_ago_text.' to '.$current_month_text;            
        }else{
            $q = "SELECT * FROM  `counties` where id='$county_id'";            
            $counties = $this->db->query($q)->result_array();   
            $county_name = $counties[0]['county'];
            $type = 'Sub-County';            
            $header_text = $county_name.' County Percentages from '.$two_months_ago_text.' to '.$current_month_text;

        }        
        $output = array('previous_month1'=>$two_months_ago_text,'previous_month'=>$previous_month_text,'current_month'=>$current_month_text,'header_info'=>$header_text,'header_type'=>$type);
        echo json_encode($output);
    }

     
		
    function get_percentages($county_id=null,$month=null) 
    {	        
        $current_month = date('mY', strtotime('-0 month',time()));    
        $previous_month = date('mY', strtotime('-1 month',time()));    
        $two_months_ago = date('mY', strtotime('-2 month',time()));                        

        $current_month_text = date('F-Y', strtotime('-1 month',time()));    
        $previous_month_text = date('F-Y',strtotime('-2 month',time()));    
        $two_months_ago_text = date('F-Y',strtotime('-3 month',time()));    

        if($county_id==0){
            $q = "SELECT * FROM  `counties` order by county asc";
            $counties = $this->db->query($q)->result_array();
            $current_percentage = array();
            $previous_percentage = array();
            $previous1_percentage = array();
            foreach ($counties as $key => $value) {
                $id = $value['id'];
                $county = $value['county'];
                $sql_c = "SELECT percentage  FROM `rtk_county_percentage` WHERE county_id='$id'  and`month` = '$current_month' limit 0,1";
                $sql_p = "SELECT percentage  FROM `rtk_county_percentage` WHERE county_id='$id' and `month` = '$previous_month' limit 0,1";
                $sql_p1 = "SELECT percentage  FROM `rtk_county_percentage` WHERE county_id='$id' and `month` = '$two_months_ago' limit 0,1";
                $perc_c =  $this->db->query($sql_c)->result_array();
                $perc_p =  $this->db->query($sql_p)->result_array();
                $perc_p1 =  $this->db->query($sql_p1)->result_array();
                $current_p = $perc_c[0]['percentage'];
                $previous_p = $perc_p[0]['percentage'];
                $previous_p1 = $perc_p1[0]['percentage'];                
                $output[] = array($county,$previous_p1,$previous_p,$current_p);
            }     
        }else{
            $q = "SELECT * FROM  `districts` where county='$county_id' order by district asc";
            $districts = $this->db->query($q)->result_array();
            $current_percentage = array();
            $previous_percentage = array();
            $previous1_percentage = array();
            foreach ($districts as $key => $value) {
                $id = $value['id'];
                $district = $value['district'];
                $sql_c = "SELECT percentage  FROM `rtk_district_percentage` WHERE district_id ='$id'  and`month` = '$current_month' limit 0,1";
                $sql_p = "SELECT percentage  FROM `rtk_district_percentage` WHERE district_id='$id' and `month` = '$previous_month' limit 0,1";
                $sql_p1 = "SELECT percentage  FROM `rtk_district_percentage` WHERE district_id='$id' and `month` = '$two_months_ago' limit 0,1";
                $perc_c =  $this->db->query($sql_c)->result_array();
                $perc_p =  $this->db->query($sql_p)->result_array();
                $perc_p1 =  $this->db->query($sql_p1)->result_array();
                $current_p = $perc_c[0]['percentage'];
                $previous_p = $perc_p[0]['percentage'];
                $previous_p1 = $perc_p1[0]['percentage'];                
                $output[] = array($district,$previous_p1,$previous_p,$current_p);
            }     
        }                        

        
        echo json_encode($output); 

    }
	
    
    function get_national_stock_summary($county_id=null,$partner_id=null){

        $month_year = date('mY', strtotime('-1 month',time())); 
        $year = substr($month_year, -4);     
        $month = substr($month_year,0,2);     
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_date = $year . '-' . $month . '-' . '01';   
        $last_date = $year . '-' . $month . '-' . $num_days;   

        $q = "select * from lab_commodities where category='1' and id in(4,5,6)";
        $commodities = $this->db->query($q)->result_array();       
        foreach ($commodities as $key => $value) {
            $commodity_name = $value['commodity_name'];
            $commodity_id = $value['id'];
            $commodity_summary = $this->get_stock_summary_details(null,$commodity_id,$first_date,$last_date);
            $beginning_bal = $commodity_summary['sum_opening'];
            $used = $commodity_summary['sum_used'];
            $tests = $commodity_summary['sum_tests'];
            $closing_stock = $commodity_summary['sum_closing_bal'];
            $output[] = array($commodity_name,$beginning_bal,$used,$tests,$closing_stock);
        }
        //  echo "<pre>";
        // print_r($output);die();
       echo json_encode($output);
    }

    function get_national_stock_summary_partner($partner_id=null){

        $month_year = date('mY', strtotime('-1 month',time())); 
        $year = substr($month_year, -4);     
        $month = substr($month_year,0,2);     
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_date = $year . '-' . $month . '-' . '01';   
        $last_date = $year . '-' . $month . '-' . $num_days;   

        $q = "select * from lab_commodities where category='1' and id in(4,5,6)";
        $commodities = $this->db->query($q)->result_array();       
        foreach ($commodities as $key => $value) {
            $commodity_name = $value['commodity_name'];
            $commodity_id = $value['id'];
            $commodity_summary = $this->get_stock_summary_details_partner(null,$commodity_id,$first_date,$last_date);
            $beginning_bal = $commodity_summary['sum_opening'];
            $used = $commodity_summary['sum_used'];
            $tests = $commodity_summary['sum_tests'];
            $closing_stock = $commodity_summary['sum_closing_bal'];
            $output[] = array($commodity_name,$beginning_bal,$used,$tests,$closing_stock);
        }
       echo json_encode($output);
    }
    


    function get_highest_stocks($county_id=null,$commodity_id)
    {           
        $county_id = $this->session->userdata('county_id');             
        $firstdate = date('Y-m-d', strtotime("first day of previous month"));
        $lastdate = date('Y-m-d', strtotime("last day of previous month"));
        $conditions = '';
        if($county_id==0){
            $conditions = '';
        }else{
            $conditions = "AND districts.county = '$county_id'";
        }
        $sql = "SELECT DISTINCT facilities.facility_code, facilities.facility_name, districts.district,
                lab_commodity_details.closing_stock FROM  lab_commodity_details, facilities, districts
                WHERE   facilities.facility_code = lab_commodity_details.facility_code    
                AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
                AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
                AND lab_commodity_details.commodity_id = '$commodity_id' $conditions
                HAVING closing_stock > 0 
                ORDER BY lab_commodity_details.closing_stock DESC , facilities.facility_code ASC LIMIT 0,10";          
        $highest_stocks = $this->db->query($sql)->result_array();   

        if(count($highest_stocks)>0){
            for ($i=0; $i <count($highest_stocks) ; $i++) {            
                $mfl = $highest_stocks[$i]['facility_code'];                    
                $endbal = $highest_stocks[$i]['closing_stock'];                    
                $facility_name = $highest_stocks[$i]['facility_name'];                                
                $highest_stocks_details[$i] = array($mfl,$facility_name,$endbal);            
            }
        }else{
            $highest_stocks_details[] = array('No Data','No Data',0);            
        }
        echo json_encode($highest_stocks_details);        
    }

     function get_highest_stocks_partner($partner_id=null,$commodity_id)
    {        
        
        $firstdate = date('Y-m-d', strtotime("first day of previous month"));
        $lastdate = date('Y-m-d', strtotime("last day of previous month"));
        $conditions = '';
        if($partner_id==0){
            $conditions = '';
        }else{
            $conditions = "AND facilities.partner = '$partner_id'";
        }
        $sql = "SELECT DISTINCT facilities.facility_code, facilities.facility_name, districts.district,
                lab_commodity_details.closing_stock FROM  lab_commodity_details, facilities, districts
                WHERE   facilities.facility_code = lab_commodity_details.facility_code    
                AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
                AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
                AND lab_commodity_details.commodity_id = '$commodity_id' $conditions
                HAVING closing_stock > 0 
                ORDER BY lab_commodity_details.closing_stock DESC , facilities.facility_code ASC LIMIT 0,10";          
        $highest_stocks = $this->db->query($sql)->result_array();      
        if(count($highest_stocks)>0){
            for ($i=0; $i <count($highest_stocks) ; $i++) {            
                $mfl = $highest_stocks[$i]['facility_code'];                    
                $endbal = $highest_stocks[$i]['closing_stock'];                    
                $facility_name = $highest_stocks[$i]['facility_name'];                                
                $highest_stocks_details[$i] = array($mfl,$facility_name,$endbal);            
            }
        }
        echo json_encode($highest_stocks_details);        
    }

    function get_highest_expiries($county_id=null,$commodity_id)
    {
        //GEts the Expiries in 6 Months
        // $this->load->model("Lab_details_model",'lab_details');    
        $firstdate = date('Y-m-d', strtotime("first day of previous month"));
        $lastdate = date('Y-m-d', strtotime("last day of previous month"));      
        $conditions = '';
        if($county_id==0){
            $conditions = '';
        }else{
            $conditions = "AND districts.county = '$county_id'";
        }
       
        $sql = "SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
                FROM lab_commodity_details,facilities,districts
                WHERE   facilities.facility_code = lab_commodity_details.facility_code    
                AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
                AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate' $conditions
                AND lab_commodity_details.commodity_id = '$commodity_id' 
                having q_expiring>0 order by lab_commodity_details.q_expiring desc,facilities.facility_code asc limit 0,10";
        $highest_expiries = $this->db->query($sql)->result_array();        
        for ($i=0; $i <count($highest_expiries) ; $i++) {            
            $mfl = $highest_expiries[$i]['facility_code'];                    
            $expiries = $highest_expiries[$i]['q_expiring'];                    
            $facility_name = $highest_expiries[$i]['facility_name'];                                
            $highest_expiries_details[$i] = array($mfl,$facility_name,$expiries);            
        }
        
        echo json_encode($highest_expiries_details); 
    }

     function get_highest_expiries_partner($partner_id=null,$commodity_id)
    {
        //GEts the Expiries in 6 Months
        // $this->load->model("Lab_details_model",'lab_details');    
        $firstdate = date('Y-m-d', strtotime("first day of previous month"));
        $lastdate = date('Y-m-d', strtotime("last day of previous month"));      
        $conditions = '';
        if($partner_id==0){
            $conditions = '';
        }else{
            $conditions = "AND facilities.partner = '$partner_id'";
        }
       
        $sql = "SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
                FROM lab_commodity_details,facilities,districts
                WHERE   facilities.facility_code = lab_commodity_details.facility_code    
                AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
                AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate' $conditions
                AND lab_commodity_details.commodity_id = '$commodity_id' 
                having q_expiring>0 order by lab_commodity_details.q_expiring desc,facilities.facility_code asc limit 0,10";
        // echo $sql;die();
        $highest_expiries = $this->db->query($sql)->result_array();        
        for ($i=0; $i <count($highest_expiries) ; $i++) {            
            $mfl = $highest_expiries[$i]['facility_code'];                    
            $expiries = $highest_expiries[$i]['q_expiring'];                    
            $facility_name = $highest_expiries[$i]['facility_name'];                                
            $highest_expiries_details[$i] = array($mfl,$facility_name,$expiries);            
        }
        
        echo json_encode($highest_expiries_details); 
    }

    function get_commodity_usage(){
    // function get_commodity_usage($type,$county_partner){

        $firstdate = date('Y-m-d', strtotime("first day of previous month"));
        $lastdate = date('Y-m-d', strtotime("last day of previous month")); 
        // $conditions = '';
        // if($type=='national'){
        //     $conditions = '';
        // }else if($type=='county'){
        //     $conditions.=" AND and counties.id = '$county_partner'";
        // }else if($type=='partner'){
        //     $conditions.=" AND and facilities.partner = '$county_partner'";            
        // }
        // $sql = "SELECT counties.county,districts.district,facilities.facility_code, facilities.facility_name, lab_commodity_details.q_used
        //         FROM counties,districts,facilities,lab_commodity_details WHERE  lab_commodity_details.facility_code = facilities.facility_code AND facilities.district = districts.id  AND districts.county = counties.id        
        //             AND lab_commodity_details.commodity_id = 4
        //             AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'";
            $sql = "SELECT distinct counties.county,districts.district,facilities.facility_code, facilities.facility_name  FROM counties,districts,facilities,lab_commodity_details WHERE  lab_commodity_details.facility_code = facilities.facility_code AND facilities.district = districts.id  AND districts.county = counties.id AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'";

            $dets = $this->db->query($sql)->result_array();
            
            foreach ($dets as $key => $value) {
                $county = $value['county'];
                $district = $value['district'];            
                $facility_code = $value['facility_code'];            
                $facility_name = $value['facility_name'];                 
                $sqls = "select distinct q_used from lab_commodity_details where facility_code='$facility_code' and created_at between '$firstdate' and '$lastdate' and commodity_id='4'"; 

                $sqlc = "select distinct q_used from lab_commodity_details where facility_code='$facility_code' and created_at between '$firstdate' and '$lastdate' and commodity_id='5'"; 

                $sqlt = "select distinct q_used from lab_commodity_details where facility_code='$facility_code' and created_at between '$firstdate' and '$lastdate' and commodity_id='6'";                 

                $q_useds = $this->db->query($sqls)->result_array();                                                         
                $q_usedt = $this->db->query($sqlt)->result_array();                                         
                $q_usedc = $this->db->query($sqlc)->result_array();                                                   
                if(count($q_useds)>0){
                    $s = $q_useds[0]['q_used'];
                }else{
                    $s = 0;
                }

                if(count($q_usedt)>0){
                    $t = $q_usedt[0]['q_used'];
                }else{
                    $t = 0;
                }
                if(count($q_usedc)>0){
                    $c = $q_usedc[0]['q_used'];
                }else{
                    $c = 0;
                }   
                // $s = $q_useds[0]['q_used'];
                // $c = $q_usedc[0]['q_used'];
                // $t = $q_usedt[0]['q_used'];
                
                // $commodity_usage[] = array($q_useds,$q_usedc,$q_usedt);
                $output[] = array($county,$district,$facility_code,$facility_name,$s,$c,$t);

                
            }

            // die();
            // echo "<pre>";
            // print_r($output);// die();
            echo json_encode($output);
    }

    function get_county_options(){
        $option = '';
        $sql = "select * from counties";
        $counties = $this->db->query($sql)->result_array();
        foreach ($counties as $key => $value) {
            $id = $value['id'];
            $name = $value['county'];
            $option.='<option value="'.$id.'">'.$name.'</option>';
        }
        echo json_encode($option);
    }

    function get_partner_options(){
        $option = '';
        $sql = "select * from partners";
        $counties = $this->db->query($sql)->result_array();
        foreach ($counties as $key => $value) {
            $id = $value['ID'];
            $name = $value['name'];
            $option.='<option value="'.$id.'">'.$name.'</option>';
        }
        echo json_encode($option);
    }

    function get_stock_summary_details($county_id=null,$commodity_id,$first_date,$last_date){

        $conditions = '';
        if($county_id!=null){
            $conditions.=" and counties.id='$county_id'";
        }        

        $sql = "SELECT SUM(lab_commodity_details.beginning_bal) AS sum_opening,                    
                       SUM(lab_commodity_details.q_used) AS sum_used,
                SUM(lab_commodity_details.no_of_tests_done) AS sum_tests,
                SUM(lab_commodity_details.closing_stock) AS sum_closing_bal
            FROM
                lab_commodities,
                lab_commodity_details,
                facilities,
                districts,
                counties
            WHERE
                    lab_commodity_details.commodity_id = '$commodity_id'
                    AND lab_commodity_details.facility_code = facilities.facility_code
                    AND facilities.district = districts.id
                    AND districts.county = counties.id
                    AND lab_commodity_details.created_at BETWEEN '$first_date' AND '$last_date' $conditions"; 
        $result = $this->db->query($sql)->result_array();
        return $result[0];
    }

     function get_stock_summary_details_partner($partner_id=null,$commodity_id,$first_date,$last_date){

        $conditions = '';
        if($partner_id!=null){
            $conditions.=" and facilities.partner='$partner_id'";
        }        

        $sql = "SELECT SUM(lab_commodity_details.beginning_bal) AS sum_opening,                    
                       SUM(lab_commodity_details.q_used) AS sum_used,
                SUM(lab_commodity_details.no_of_tests_done) AS sum_tests,
                SUM(lab_commodity_details.closing_stock) AS sum_closing_bal
            FROM
                lab_commodities,
                lab_commodity_details,
                facilities,
                districts,
                counties
            WHERE
                    lab_commodity_details.commodity_id = '$commodity_id'
                    AND lab_commodity_details.facility_code = facilities.facility_code
                    AND facilities.district = districts.id
                    AND districts.county = counties.id
                    AND lab_commodity_details.created_at BETWEEN '$first_date' AND '$last_date' $conditions"; 
        $result = $this->db->query($sql)->result_array();
        return $result[0];
    
}
}
?>