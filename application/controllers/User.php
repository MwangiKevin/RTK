<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class User extends CI_Controller {

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
	function index()
	{		
		redirect('User/login');

	}

	function login()
	{	
		$log_status = $this->session->userdata('log_status');
		if(!empty($log_status)){
			redirect('Home');	
		}else{
			$data['title'] = 'Login';
			$data['banner_text'] = 'Rapid Test Kit System - Login';
			$data['content_view'] = 'login_v';
			$this->load->view('template/template',$data);
		}
		
	}

	function logout()
	{
		// $this->session->unset();
		$this->session->sess_destroy();		
		$this->db->cache_delete_all();
		redirect('User');
		
	}

	function change_password()
	{
		$this -> load -> view("ajax_view/change_password");
	}


	function edit_user_profile()
	{
	    $fname= $this->input->post('fname');
		$lname=$this->input->post('lname');
		$phone=$this->input->post('telephone');
		$phone=preg_replace('(^0+)', "254", $phone);
		$email=$this->input->post('email');
		$user_id=$this->input->post('user_id');	
		$updated_at = date('Y-m-d h:i:s');
		$sql = "UPDATE `user` SET `fname`='$fname',`lname`='$lname',`email`='$email',`telephone`='$phone',`updated_at`='$updated_at' WHERE id='$user_id'";
		if($this->db->query($sql))
		{
			$this->session->set_flashdata('system_success_message', "$fname,$lname details have been updated");
		}else
		{
		}    
		
		// switch ($access_level):
		// 	case 'moh':
		// 		$redirect_to='user_management/moh_manage';
		// 		break;
		// 	case 'district':
		// 		$redirect_to="user_management/dist_manage";
		// 		break;
		// 	case 'facility' || 'fac_user':
		// 	$redirect_to="report_management/facility_settings";
		// 		break;
		// 		endswitch;
	
	 //    redirect($redirect_to);
	}

}
