<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Migration_controller extends CI_Controller {

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
    function index()
    { 

    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'rtk' 
        AND ENGINE = 'MyISAM'";

    $rs = $this->db->query($sql)->result_array();

   // echo "<pree"; print_r($rs);die;
    foreach ($rs as $key => $value) {
        $tbl = $value['TABLE_NAME'];
        $sql2 = "ALTER TABLE `$tbl` ENGINE=INNODB";
         $rs2 = $this->db->query($sql2);
        // mysql_query($sql);
    }

    // while($row = mysql_fetch_array($rs))
    // {
    //     $tbl = $row[0];
    //     $sql = "ALTER TABLE `$tbl` ENGINE=INNODB";
    //     mysql_query($sql);
    // }

    }
    function migrate_orders($month)
    {
        ini_set('max_memory', -1);

        $year = substr($month, -4);
    // $month = date('m', strtotime('-0 month', time()));
    // $month_title = date('mY', strtotime('-1 month', time()));
    $month = substr($month, 0,2);
    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first = $year . '-' . $month . '-01';    
    $last = $year . '-' . $month .'-'. $num_days;      

        $sql_orders_old = "select distinct lab_commodity_orders_old.* from lab_commodity_orders_old where order_date between '$first' and '$last' order by id asc";
        $old_orders = $this->db->query($sql_orders_old)->result_array();
        foreach ($old_orders as $key => $value) {
            $old_id = $value['id'];
            $fcode = $value['facility_code'];
            $order_date = $value['order_date'];
            $vct = $value['vct'];
            $pitc = $value['pitc'];
            $pmtct = $value['pmtct'];
            $b_screening = $value['b_screening'];
            $other = $value['other'];
            $specification = $value['specification'];
            $rdt_under_tests = $value['rdt_under_tests'];
            $rdt_under_pos = $value['rdt_under_pos'];
            $rdt_btwn_tests = $value['rdt_btwn_tests'];
            $rdt_btwn_pos = $value['rdt_btwn_pos'];
            $rdt_over_pos = $value['rdt_over_pos'];
            $rdt_over_tests = $value['rdt_over_tests'];
            $micro_under_tests = $value['micro_under_tests'];
            $micro_under_pos = $value['micro_under_pos'];
            $micro_btwn_tests = $value['micro_btwn_tests'];
            $micro_btwn_pos = $value['micro_btwn_pos'];
            $micro_over_tests = $value['micro_over_tests'];
            $micro_over_pos = $value['micro_over_pos'];
            $beg_date = $value['beg_date'];
            $end_date = $value['end_date'];
            $explanation = $value['explanation'];
            $moh642 = $value['moh_642'];
            $moh643 = $value['moh_643'];
            $compiled_by = $value['compiled_by'];
            $approved_by = 'N/A';
            $created_at = $value['created_at'];
            $report_for = $value['report_for'];

            $explanation = str_replace("'","\'",$explanation);
            $compiled_by = str_replace("'","\'",$compiled_by);
            $specification = str_replace("'","\'",$specification);

            // $sql_facilities = "select facility_code from facilities";
            // $result_facilities = $this->db->query($sql_facilities)->result_array();
           // echo "<pre>"; print_r($result_facilities);die;

            $sql_new_orders = "INSERT INTO `lab_commodity_orders`(`id`, `old_id`, `facility_code`, `order_date`, `vct`, `pitc`, `pmtct`,
                     `b_screening`, `other`, `specification`, `rdt_under_tests`, `rdt_under_pos`, `rdt_btwn_tests`, `rdt_btwn_pos`,
                      `rdt_over_tests`, `rdt_over_pos`, `micro_under_tests`, `micro_under_pos`, `micro_btwn_tests`, `micro_btwn_pos`,
                       `micro_over_tests`, `micro_over_pos`, `beg_date`, `end_date`, `explanation`, `moh_642`, `moh_643`, `compiled_by`,
                        `created_at`, `approved_by`, `report_for`)
                         VALUES (null,'$old_id','$fcode','$order_date','$vct','$pitc','$pmtct','$b_screening','$other','$specification',
                            '$rdt_under_tests','$rdt_under_pos','$rdt_btwn_tests','$rdt_btwn_pos','$rdt_over_tests',
                            '$rdt_over_pos','$micro_under_tests','$micro_under_pos','$micro_btwn_tests','$micro_btwn_pos',
                            '$micro_over_tests','$micro_over_pos','$beg_date','$end_date','$explanation','$moh642','$moh643',
                            '$compiled_by','$approved_by','$created_at','$report_for')";
            
            $this->db->query($sql_new_orders);
            
            
        }
    }

    function migrate_details($month)
    {

        ini_set('max_memory', -1);
    // $month = date('mY', strtotime('-0 month',time()));    
    $year = substr($month, -4);
    // $month = date('m', strtotime('-0 month', time()));
    // $month_title = date('mY', strtotime('-1 month', time()));
    $month = substr($month, 0,2);
    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first = $year . '-' . $month . '-01';    
    $last = $year . '-' . $month .'-'. $num_days;      

    // echo "$first_date and $last_date"; die;
    // $month_title = date('m', strtotime('-1 month', time()));    
    // $date = date('F-Y', mktime(0, 0, 0, $month_title, 1, $year_title));   

        $sql_orders_old = "select distinct lab_commodity_orders.* from lab_commodity_orders where order_date between '$first' and '$last' order by id asc ";
        $old_orders = $this->db->query($sql_orders_old)->result_array();
        foreach ($old_orders as $key => $values) {
            $old_id = $values['old_id'];
            $sql_old_dets = "select * from lab_commodity_details_old where order_id = '$old_id'";
            $old_dets = $this->db->query($sql_old_dets)->result_array();
            foreach ($old_dets as $key => $value) {
                $facility_code = $value['facility_code'];                
                $commodity_id = $value['commodity_id'];                
                $beginning_bal = $value['beginning_bal'];                
                $q_received = $value['q_received'];                
                $q_used = $value['q_used'];                
                $no_of_tests_done = $value['no_of_tests_done'];                
                $losses = $value['losses'];                
                $positive_adj = $value['positive_adj'];                
                $negative_adj = $value['negative_adj'];                
                $closing_stock = $value['closing_stock'];                
                $q_expiring = $value['q_expiring'];                
                $days_out_of_stock = $value['days_out_of_stock'];                
                $q_requested = $value['q_requested'];                
                $created_at = $value['created_at'];                


                $sql_ins = "insert into lab_commodity_details (`id`,`order_id`,`facility_code`,`commodity_id`,`beginning_bal`,`q_received`,`q_used`,`no_of_tests_done`,`losses`,`positive_adj`,`negative_adj`,`closing_stock`,`q_expiring`,`days_out_of_stock`,`created_at`)
                values(null,'$old_id','$facility_code','$commodity_id','$beginning_bal','$q_received','$q_used','$no_of_tests_done','$losses','$positive_adj','$negative_adj','$closing_stock','$q_expiring','$days_out_of_stock','$created_at')";

                $this->db->query($sql_ins);
            }      
            
        }
    }
    function migrate_county()
    {
        ini_set('max_memory', -1);
        $sql_orders_old = "select distinct counties_old.* from counties_old order by id";
        $old_orders = $this->db->query($sql_orders_old)->result_array();
        foreach ($old_orders as $key => $value) {
            // $old_id = $values['id'];
            // $sql_old_dets = "select * from counties_old where id = '$old_id'";
            // $old_dets = $this->db->query($sql_old_dets)->result_array();
            // foreach ($old_dets as $key => $value) {
                $county = $value['county'];                
                $kenya_map_id = $value['kenya_map_id'];                
                $zone = $value['zone']; 
                $sql_ins = "insert into counties (`id`,`county`,`kenya_map_id`,`zone`)
                            values(null,'$county','$kenya_map_id','$zone')";

                $this->db->query($sql_ins);
            }      
            
        // }
    }
    function migrate_districts()
    {
        ini_set('max_memory', -1);
        $sql_orders_old = "select  districts_old.* from districts_old order by id";
        $old_orders = $this->db->query($sql_orders_old)->result_array();
        foreach ($old_orders as $key => $value) {

            // $old_id = $values['id'];
            // $sql_old_dets = "select * from counties_old where id = '$old_id'";
            // $old_dets = $this->db->query($sql_old_dets)->result_array();
            // foreach ($old_dets as $key => $value) {
            $old_id = $value['id'];                
            $county_id = $value['county'];                
            $district = str_replace("'", "", $value['district']);                
            $county = $value['county'];
            if ($county_id >0) {

                $sql_ins = "insert into districts (`id`,`district`,`county`,`old_id`)
                            values(null,'$district','$county','$old_id')";
                $this->db->query($sql_ins);
            }
                

            }      
            
        // }
    }
    function migrate_facilities()
    {
        ini_set('max_memory', -1);
        $sql_orders_old = "select distinct facilities_old.* from facilities_old order by id";
        $old_orders = $this->db->query($sql_orders_old)->result_array();
        foreach ($old_orders as $key => $value) {

            // $old_id = $values['id'];
            // $sql_old_dets = "select * from counties_old where id = '$old_id'";
            // $old_dets = $this->db->query($sql_old_dets)->result_array();
            // foreach ($old_dets as $key => $value) {
            $facility_code = $value['facility_code'];                
            $facility_name = str_replace("'", "", $value['facility_name']);                
            $district_old = $value['district'];
            $rtk_enabled = $value['rtk_enabled'];
            $partner = $value['partner'];
            $owner = $value['owner'];
            $type = $value['type'];
            $level = $value['level'];
            $pepfar_supported = $value['pepfar_supported'];
            $cd4_enabled = $value['cd4_enabled'];
            $date_of_activation = $value['date_of_activation'];
            $using_hcmp = $value['using_hcmp'];
            $drawing_rights = $value['drawing_rights'];
            $drawing_rights_balance = $value['drawing_rights_balance'];
            $contactperson = $value['contactperson'];
            $cellphone = $value['cellphone'];
            $targetted = $value['targetted'];
            // $district = $value['district'];

            $sql_titus = "select id from districts where old_id = '$district_old' limit 0,1";
            $result_tt = $this->db->query($sql_titus)->result_array();  
            if(count($result_tt)!=0){
                 $district = $result_tt[0]['id'];
            echo "$district";
            if ($district !=0) {

                $sql_ins = "INSERT INTO `facilities`(`id`, `facility_code`, `facility_name`, `district`, `rtk_enabled`, 
                    `partner`, `owner`, `type`, `level`, `pepfar_supported`, `cd4_enabled`, `date_of_activation`,
                     `using_hcmp`, `drawing_rights`, `drawing_rights_balance`, `contactperson`, `cellphone`, `targetted`) 
                            VALUES (null,'$facility_code','$facility_name','$district','$rtk_enabled','$partner','$owner',
                        '$type','$level','$pepfar_supported','$cd4_enabled','$date_of_activation','$using_hcmp','$drawing_rights',
                        '$drawing_rights_balance','$contactperson','$cellphone','$targetted')";
                $this->db->query($sql_ins);
            }
            }          
           
                

            }      
            
        // }
    }

    function migrate_users()
    {
        $sql = "select * from user_old where usertype_id in (7,8,11,13,14,15)";
        $result_users_old = $this->db->query($sql)->result_array();

        // echo "<pre>"; print_r($result_users_old);die;
        foreach ($result_users_old as $key => $value) {
            $id = $value['id'];
            $fname = $value['fname'];
            $lname = $value['lname'];
            $email = $value['email'];
            $username = $value['username'];
            $password = $value['password'];
            $usertype_id = $value['usertype_id'];
            $telephone = $value['telephone'];
            $district = $value['district'];
            $partner = $value['partner'];
            $facility = $value['facility'];
            $created_at = $value['created_at'];
            $county_id = $value['county_id'];
            $updated_at = $value['updated_at'];
            $status = $value['status'];

            if($lname==''){
                $lname='N/A';
            }
            if($telephone==''){
                $telephone='N/A';
            }

            if($facility==''){
                $facility=0;
            }
            $fname = str_replace("'", "\'", $fname);
            $lname = str_replace("'", "\'", $lname);
            $log_status = 0;
            $verified = 0;
            $usertype_id_new = 0;
            //old scmlt 7, Admin 8, allocation 11,clc 13, partner admin 14, partner super 15
            //new scmlt 1, Admin 5, allocation 6, clc 2,  partner admin 3,  partner super 4

            switch ($usertype_id) {
                case 7:
                    $usertype_id_new = 1;
                    break;
                case 8:
                    $usertype_id_new = 5;
                    $verified = 1;
                    break;
                case 11:
                    $usertype_id_new = 6;
                    $verified = 1;
                    break;
                case 13:
                    $usertype_id_new = 2;
                    break;
                case 14:
                    $usertype_id_new = 3;
                    break;
                case 15:
                    $usertype_id_new = 4;
                    break;
                
                default:
                    # code...
                    break;
            }



            $sql_insert = "INSERT INTO `user`(`id`, `fname`, `lname`, `email`, `username`, `password`, `usertype_id`, `telephone`, `district`, `partner`, `facility`, `created_at`, `updated_at`, `status`, `county_id`, `log_status`, `verified`) 
                            VALUES (null,'$fname','$lname','$email','$username','$password','$usertype_id_new','$telephone','$district','$partner','$facility','$created_at','$updated_at','$status','$county_id',0,'$verified')";

            // echo "$sql_insert";die();
            if($this->db->query($sql_insert)){
                echo 100;
            }else{
                echo 0;
            }
        }
    }


}
?>