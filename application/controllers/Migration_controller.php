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
    function migrate_orders()
    {

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