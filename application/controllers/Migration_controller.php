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
        
    }
    function migrate_orders($a,$b)
    {
        ini_set('max_memory', -1);
        $sql_orders_old = "select distinct lab_commodity_orders_old.* from lab_commodity_orders_old order by id asc limit $a,$b";
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

    function migrate_details($a,$b)
    {
        ini_set('max_memory', -1);
        $sql_orders_old = "select distinct lab_commodity_orders.* from lab_commodity_orders order by id asc limit $a,$b";
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

    function migrate_users()
    {
        $sql = "select * from user_old where usertype_id in (7,8,11,13,14,15)";
        $result_users_old = $this->db->query($sql)->result_array();
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
            //new scmlt 1, Admin 5, allocation 6,clc 2, partner admin 3, partner super 4

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
                            VALUES ('$id','$fname','$lname','$email','$username','$password','$usertype_id_new','$telephone','$district','$partner','$facility','$created_at','$updated_at','$status','$county_id',0,'$verified')";

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