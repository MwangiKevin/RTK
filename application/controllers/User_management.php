<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_management extends CI_Controller{

	function __construct() {
		parent::__construct();		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
 		$this->output->set_header("Pragma: no-cache");
		redirect('User/login');
	}

	function _submit_validate() 
	{

		$this->form_validation->set_rules('username', 'Username',
			'trim|required|callback_authenticate');

		$this->form_validation->set_rules('password', 'Password',
			'trim|required');

		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');

		return $this->form_validation->run();

	}


	function submit() 
	{
		if($this->input->post('username'))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];	
		}		
		
		$this->load->model("User_model",'user');
		$result = $this->user->login($username,$password);
		$count = count($result);
		
		if($count!=0)
		{			
			$user_id = $result[0]['id'];
			$fname = $result[0]['fname'];
			$lname = $result[0]['lname'];
			$full_name = $fname.' '.$lname;
			$email= $result[0]['email'];
			$partner= $result[0]['partner'];
			$district= $result[0]['district'];
			$county_id= $result[0]['county_id'];
			$telephone= $result[0]['telephone'];
			$usertype_id= $result[0]['usertype_id'];
			$facility= $result[0]['facility'];
			$session_data = array(
				'user_id'=>$user_id,
				'fname'=>$fname,
				'lname'=>$lname,
	       		'full_name'=>$full_name,
	       		'email' =>$email ,
	       		'partner'=>$partner,
	       		'district_id'=>$district,
	       		'county_id'=>$county_id,
	       		'telephone'=>$telephone,
	       		'usertype_id'=>$usertype_id,       		
	       		'facility'=>$facility,	     
	       		'log_status'=>$log_status);			
			$this ->session->set_userdata($session_data);
			redirect("Home_controller");
					
		}else
		{
			$this->session->set_flashdata('log_status', 'Username or Password Incorrect. Try Again');
			redirect("User/login");
			return;		
		}
		
	}
	
        
   



	// function _submit_validate() {

	// 	$this->form_validation->set_rules('username', 'Username',
	// 		'trim|required|callback_authenticate');

	// 	$this->form_validation->set_rules('password', 'Password',
	// 		'trim|required');

	// 	$this->form_validation->set_message('authenticate','Invalid login. Please try again.');

	// 	return $this->form_validation->run();

	// }

	// function authenticate($username) {

	// 	// get User object by username
	// 	if ($u = Doctrine::getTable('User')->findOneByUsername($this->input->post('username'))) {

	// 		// this mutates (encrypts) the input password
	// 		$u_input = new User();
	// 		$u_input->password = $this->input->post('password');

	// 		// password match (comparing encrypted passwords)
	// 		if ($u->password == $u_input->password) {
	// 			unset($u_input);
	// 			return TRUE;
	// 		}
	// 		unset($u_input);
	// 	}

	// 	return FALSE;
	// }
	
	
public function forgotpassword() {
		$data['title'] = "Register Users";
		$data['content_view'] = "moh/signup_v";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
	}
	
	public function sign_up() {
		$data['title'] = "Register Users";
		$data['content_view'] = "moh/registeruser_moh";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
	}
	public function district_signup(){
		$data['title'] = "Register Users";
		$data['content_view'] = "register_v";
		$data['banner_text'] = "Add Users";
		$data['level_l'] = Access_level::getAll2();
		$data['counties'] = Counties::getAll();
		
		//$data['r_name']='';
		
		
		$this -> load -> view("template", $data);
	}
	//district_signup
	public function dist_signup(){
		//get current district from session
		$district=$this -> session -> userdata('district1');
		
		$data['title'] = "Register Users";
		$data['content_view'] = "district_add_user";
		$data['banner_text'] = "Register Users";
		$data['quick_link'] = "signup_v";
		$data['level_l'] = Access_level::getAll1();
		$data['facility'] = Facilities::getFacilities($district);
		$this -> load -> view("template", $data);
	}
	//users list
	public function users_facility(){
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		
		$data['quick_link'] = "users_facility_v";
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	
	}
	//////// reset password /activate/ deactivate 
	public function reset_user_variable($title,$id){
		
		 $u= Doctrine::getTable('User')->find($id);

		$f_name=$u->fname;
		$l_name=$u->lname;
		
		switch ($title) {
			  case 'deactive':
				$status=  user::activate_deactivate_user($id,0);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been deactivated");
				}
				break;
				case 'active':
				
				$status=  user::activate_deactivate_user($id,1);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been activated");
				}
				break;
				
				case 'reset':
				$status=  user::reset_password($id);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name password has been reset");
				}
				break;	
				
				case 'delete':
				$status=  user::delete_user($id);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been deleted");
				}
				break;	

			  default:
				
				break;
		}
		
		
	}
	//////////////// checking the user email
	public function check_user_email($email=null){
		
		
		if($email !=''){
			$email=urldecode($email);
	$email_count=User::check_user_email($email);
	
	if($email_count==0){
		echo "User name is available";
	}
	else{
		echo "User name is already in use";
	}
		}
else{
	echo "Blank email";
}	
		
	}
	/// register facility users{}
	public function create_new_facility_user(){
		
		$password='123456';
		$redirect=false;
		$district_redirect=false;
		$county_redirect=false;
		$user_level="";
		$access_level="";
		$user_delegation="";
		$county_id="";
		$facility_code=$this -> session -> userdata('news');
		
		
		$access_level=access_level::get_access_level_name($this->input->post('user_type'));
		
		$access_level=$access_level['level'];
		
		if($facility_code!=null){
		$county_id=$this->input->post('county_id');
		$facility_code=$facility_code;
		$redirect=TRUE;	
		
		$facility_name=facilities::get_facility_name_($facility_code);
		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";
		
		}
		
		if($this->input->post('facility_code')){
			$county_id=$this->input->post('county_id');
			$facility_code=$this->input->post('facility_code');
			$district_redirect=true;
			$facility_name=facilities::get_facility_name_($facility_code);
		
		    $user_delegation="Facility: $facility_name[facility_name]";
		    $user_level="Facility Level";
		}
		
       
		
		
		
        if($this->input->post('user_name')){
            $user_name=$this->input->post('email');
                  }		
             else{
            $user_name=$this->input->post('user_name');
          }
		
		$f_name= $this->input->post('f_name');
		$other_name=$this->input->post('o_name');
		$phone=$this->input->post('phone_no');
		$phone=preg_replace('(^0+)', "254", $phone);
		$email=$this->input->post('email');
		
		$u = new User();
		if($this->input->post('district')){
$u->district =$this->input->post('district');
$u->county_id =$this->input->post('county');
$county_redirect=true;
$district_name=districts::get_district_name_($this->input->post('district'));
$user_level="District Level";		
$user_delegation="District: $district_name[district]";
}		
else{
    $u->district =$this -> session -> userdata('district1');
	$u->county_id =$county_id;
}
        
		$u->fname=$f_name;
		$u->lname=$other_name;
		$u->email = $email;
		$u->username = $email;
		$u->password = $password;
		$u->usertype_id =$this->input->post('user_type') ;
		$u->telephone =$phone;
		
		$u->facility = $facility_code;
		
		$u->save();
		
		 if($facility_code!=null && $facility_code!=0){
        	
 $q = Doctrine_Manager::getInstance()->getCurrentConnection()
 ->execute('update facilities f, (select  facility, min(`created_at`) 
 as date from user u where facility='.$facility_code.' group by facility) as temp set `using_hcmp`=1,
 `date_of_activation`=temp.date where unix_timestamp(`date_of_activation`)=0 
 and facility_code=temp.facility');
 
		}
		
		$message='Hello '.$f_name.',You have been registered. Check your email for login details. HCMP';
		$message_1='Hello '.$f_name.', <br> <br> Thank you for registering on the Health Commodities Management Platform (HCMP).
		<br>
		<br>
		Web link: http://health-cmp.or.ke/
		<br>
		<br>
		Please find your log in credentials below:
		<br>
		<br>
		'.$user_delegation.'
		<br> 
		User Level: '.$user_level.'
		<br>
		User Type: '.$access_level.'
		<br>
		User Name: '.$email.' 
		<br>
		Password: '.$password.'
		<br>
		<br>
		Kindly reset your password after logging in onto the system';
		
	    $subject="User Registration :".$f_name." ".$other_name;
	
	
		$this->send_sms($phone,$message);
		$this->send_email($email,$message_1,$subject);



  if($redirect){
  	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/users_manage");
  	
  }

  
  elseif($district_redirect){
  	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/dist_manage");
  
  }
   elseif($county_redirect){
   	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/moh_manage");
  	
  }
  else{
  	echo "$f_name $other_name has been registerd, your password is $password";
  }
 
	}


	
	/// register facility users{}
	public function edit_facility_user(){
		
		if($this->input->post('facility_code')){
			$facility_code=$this->input->post('facility_code');
		}
		else{
		$facility_code=$this -> session -> userdata('news');	
		}
		$district=$this -> session -> userdata('district1');
		$f_name= $this->input->post('f_name');
		$other_name=$this->input->post('o_name');
		$id= $this->input->post('id');
		
		
		$u = Doctrine::getTable('user')->findOneById($id);
		$u->fname=$f_name;
		$u->lname=$other_name;
		$u->email = $this->input->post('email');
		$u->username = $this->input->post('user_name');
		
		$u->usertype_id = $this->input->post('user_type');
		$u->telephone = $this->input->post('phone_no');
		$u->district = $district;
		$u->facility = $facility_code;
		$u->save();
		
		

 echo "$f_name $other_name details have been edited";
	}
	
//super admin

 public function create_user_super_admin(){
       $data['title'] = "Register Users";
		$data['content_view'] = "super_admin/create_user_v";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::get_all_users();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
}

	
	public function users_district(){
		$district=$this -> session -> userdata('district1');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district, $id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function users_moh(){
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	// facility users manage
	public function users_manage($pop_up_msg=NULL){
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['result'] = User::getAll2($facility,$id);
		$data['user_type']= Access_level::getAll1();
		$data['title'] = "User Management";
		$data['content_view'] = "facility/user_management/users_facility_v";
		$data['banner_text'] = "User Management";
		$data['pop_up_msg']=$pop_up_msg;
		$this -> load -> view("template", $data);
	}
	// district users manage
	public function dist_manage($pop_up_msg=NULL){
		$district=$this -> session -> userdata('district1');
		$id=$this -> session -> userdata('user_db_id');
		$data['user_type']= Access_level::getAll1();
		$data['facilities']= Facilities::getFacilities($district);
		$data['title'] = "User Management";
		$data['content_view'] = "district/user_management/users_district_v";
		$data['banner_text'] = "User Management";
		$data['pop_up_msg']=$pop_up_msg;
		$data['result'] = User::getAll5($district, $id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}

	public function moh_manage(){
		
		$data['title'] = "Manage Users";
		$data['moh_users']=user::get_all_moh_users();
		$data['user_type'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		$data['content_view'] = "moh/user_management/moh_hcmp_users";
		$data['banner_text'] = "Manage System Users";
		$this -> load -> view("template", $data);
	}
	
	public function user_details(){
		$use_id=$this->uri->segment(3);
		$data['title'] = "View Users";
		$data['content_view'] = "user_details_v";
		$data['banner_text'] = "Reset Password";
		$data['level_l'] = Access_level::getAll1();
		$data['detail_list']=User::getAll3($use_id);
		$data['detail_list1']=User::getAll4($use_id);
		$this -> load -> view("template", $data);
	}
	public function reset_pass(){
		$data['title'] = "View Users";
		$data['content_view'] = "reset_pass_v";
		$data['banner_text'] = "Reset Password";
		$this -> load -> view("template", $data);
	}

		public function forget_pass(){
		$this -> load -> view("forgotpassword_v");
	}
	public function password_recovery(){
		
		$email=$_POST['username'];
		
		
		if($email!=NULL):
		
		$password='123456';
		
		$mycount= User::check_user_exist($email);
		

		if ($mycount>0 ):
		$account_details=User::get_user_details($email)->toArray();
		
		
		$access_level=access_level::get_access_level_name($account_details[0]['usertype_id']);
		$access_level=$access_level['level'];
		
		switch ($account_details[0]['usertype_id']) {
			case 2:
		$facility_name=facilities::get_facility_name_($account_details[0]['facility']);		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";	
				break;
			case 5:
		$facility_name=facilities::get_facility_name_($account_details[0]['facility']);		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";	
				break;		
			case 3:
		$district_name=districts::get_district_name_($account_details[0]['district']);
        $user_level="District Level";		
        $user_delegation="District: $district_name[district]";		
				break;	
			
			default:
				
				break;
		}
		
		
		$subject="Password reset";
		$message='Hello '.$account_details[0]['fname'].'you requested for a password reset check you email address for more details (HCMP)';
		
		$message_1='Hello '.$account_details[0]['fname'].', <br> <br> You requested for a password reset on the Health Commodities Management Platform (HCMP).
		<br>
		<br>
		Web link: http://health-cmp.or.ke/
		<br>
		<br>
		Please find your log in credentials below:
		<br>
		<br>
		'.$user_delegation.'
		<br> 
		User Level: '.$user_level.'
		<br>
		User Type: '.$access_level.'
		<br>
		User Name: '.$email.' 
		<br>
		Password: '.$password.'
		<br>
		<br>';
			//hash then reset password
			$salt = '#*seCrEt!@-*%';
			$value=( md5($salt . $password));
			
			$updatep = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$updatep->execute("UPDATE user SET password='$value'  WHERE username='$email' or email='$email'; ");
			
			//send mail

			$response=$this->send_email($email,$message_1,$subject);
			$this->send_sms($account_details[0]['telephone'],$message);
			
			 $data['email']=$email;
			 $data['popup'] = "Successpopup";
	         $this -> load -> view("login_v",$data);
			
			
			
			
		    else: 
			$data['popup'] = "errorpopup";
			$this -> load -> view("forgotpassword_v",$data);
			endif;
else: 
	        $data['popup'] = "errorpopup";
			$this -> load -> view("forgotpassword_v",$data);
endif;

	
			
	}
	public function base_params($data) {
		$this -> load -> view("template", $data);
	}
	//facility activate/deactivate
	public function deactive(){
		$status=0;		
		$id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($id);
		$state->status=$status;
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function active(){
		$status=1;		
		$id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($id);
		$state->status=$status;
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//district activate/deactivate
	public function dist_deactive(){
		$status=0;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$district=$this -> session -> userdata('district1');
		//echo $district;
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district,$use_id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function dist_active(){
		$status=1;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$district=$this -> session -> userdata('district1');
		//echo $district;
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district,$use_id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//moh activate/deactivate
	public function moh_deactive(){
		$status=0;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	public function get_user_profile($user_id=null){
		
		$user_id_input=isset($user_id)? $user_id:$this -> session -> userdata('identity');
		
	
		
		$data['user_data']=user::getAllUser($user_id_input)->toArray();
		
		$this->load->view('facility/user_management/user_profile_v',$data);
		
	}
	public function moh_active(){
		$status=1;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//validates usernames
	public function username(){
		//$username=$_POST['username'];
		//for ajax
		$desc=$_POST['username'];
		$describe=user::getUsername($desc);
		$list="";
		foreach ($describe as $describe) {
			$list.=$describe->username;
		}
		echo $list;
	}
	public function user_reset(){
		$id=$this->uri->segment(3);
		$password='hcmp2012';
		
		$pass1=Doctrine::getTable('user')->findOneById($id);
		$name=$pass1->fname;
		$lname=$pass1->lname;
		$email=$pass1->email;
		$pass=Doctrine::getTable('user')->findOneById($id);
		//echo $pass->password
		$pass->password=$password;
		$pass->save();
		
		$fromm='hcmpkenya@gmail.com';
		$messages='Hallo '.$name .', Your password has been reset Please use '.$password.'. Please login and change. 
		
		Thank you';
	
  		$config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'hcmpkenya@gmail.com', // change it to yours
  'smtp_pass' => 'healthkenya', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
); 
		
        //$this->email->initialize($config);
		$this->load->library('email', $config);
 
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email); // change it to yours
  		
  		$this->email->subject('Password Reset:'.$name.' '.$lname);
 		$this->email->message($messages);
 
  if($this->email->send())
 {

 }
 else
{
 show_error($this->email->print_debugger());
}
		$this->session->sess_destroy();
		$data = array();
		$data['title'] = "System Login";
		
		$this -> load -> view("login_v", $data);
	}
	public function edit_user(){
		$use_id=$this->uri->segment(3);
		//echo $use_id;
		
		$data['title'] = "Reset Details";
		$data['content_view'] = "detail_reset_v";
		$data['banner_text'] = "Reset Details";
		$data['users_det']=User::getAllUser($use_id);
		$data['level_l'] = Access_level::getAll1();
		$data['counties'] = Counties::getAll();
		$data['link'] = "details_reset_v";
		$this -> load -> view("template", $data);
	}
	public function edit_facility(){
		$use_id=$_POST['user_id'];
		//echo $use_id;
		/*$myobj = Doctrine::getTable('user')->findOneById($use_id);
    	$disto=$myobj->district;
		$faci=$myobj->facility;
		$type=$myobj->usertype_id;
		$data['counties'] = Counties::getAll3($type);
		echo $faci;*/
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$tell=$_POST['tell'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$type=$_POST['type'];

		//$use_id=$_POST['user_id'];
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->fname=$fname;
		$state->lname=$lname;
		$state->telephone=$tell;
		$state->email=$email;
		$state->username=$username;
		$state->usertype_id=$type;
		
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['quick_link'] = "users_facility_v";
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template" , $data);
			}

			public function password_change(){
			echo json_encode('test');	
			exit;
		$initialpassword=$_POST['inputPasswordinitial'];
		$use_id=$this -> session -> userdata('user_id');
		$newpassword=$_POST['inputPasswordnew2'];
		
		//retrieve password and compare
		
		$getdata=User::getAllUser($use_id);
		$initpassword=$getdata[0]['password'];
		$salt = '#*seCrEt!@-*%';
		$value=( md5($salt . $newpassword));
		 
		//echo $value.'</br>';
		//echo $initpassword;
		if ($initpassword != $value) {
			echo $initpassword;
		} else {
			
		}
		

			}
			
			public function save_new_password() {
			$old_password=$_POST['old_password'];
			$new_password=$_POST['new_password'];		
			$user_id = $this -> session -> userdata('user_id');
			$valid_old_password = $this -> correct_current_password($old_password);

		//Check if old password is correct
		if ($valid_old_password == FALSE) {
			$response = array('msg' => 'You have entered a wrong password.','response'=> 'false');
			echo json_encode($response);
		}  else {
			$salt = '#*seCrEt!@-*%';
			$value=( md5($salt . $new_password));
			
			$updatep = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$updatep->execute("UPDATE user SET password='$value'  WHERE id='$user_id'; ");
			$response = array('msg' => 'Success!!! Your password has been changed.','response'=> 'true');
			$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			echo json_encode($response);
			//$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			//redirect('Home_Controller');
		}

		

	}

	private function _submit_validate_password() {
		// validation rules
		$this -> form_validation -> set_rules('old_password', 'Current Password', 'trim|required|min_length[6]|max_length[30]');
		$this -> form_validation -> set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[30]|matches[new_password_confirm]');
		$this -> form_validation -> set_rules('new_password_confirm', 'New Password Confirmation', 'trim|required|min_length[6]|max_length[30]');
		$temp_validation = $this -> form_validation -> run();
		if ($temp_validation) {
			$this -> form_validation -> set_rules('old_password', 'Current Password', 'trim|required|callback_correct_current_password');
			return $this -> form_validation -> run();
		} else {
			return $temp_validation;
		}

	}

	public function correct_current_password($pass) {
		$salt = '#*seCrEt!@-*%';
		$pass=( md5($salt . $pass));
		$user_id = $this -> session -> userdata('user_id');
		$getdata=User::getAllUser($user_id);
		$currentpassword=$getdata[0]['password'];
		
		if ($currentpassword != $pass) {
			$this -> form_validation -> set_message('correct_current_password', 'The current password you provided is not correct.');
			return FALSE;
			//echo "Dont match";
		} else {
			return TRUE;
			//echo "Yes match";
			
		}
		

	}
	function get_national_users()
	{
    $this->load->model('User_model','users_model');    
    // $this->load->model('Partners_model','partners_model');    
    $conditions = '';
    // if($zone!=0)
    // {
    //     $conditions.=" and facilities.zone = Zone '$zone'";
    // }
    // if($county_id!=0)
    // {
    //     $conditions.=" and counties.id = '$county_id'";
    // }
    // if($district_id!=0)
    // {
    //     $conditions.=" and districts.id = '$district_id'";        
    // }
    // if($partner!=0)
    // {
    //     $partner.=" and facilities.partner = '$partner'";        
    // }
    $users = $this->users_model->get_national_users_conditions($conditions);    
    foreach ($users as $key => $value) {
        $id = $value['id'];
        $first_name = $value['fname'];
        $last_name = $value['lname'];
        $email = $value['email'];
        $user_type = $value['usertype_id'];
        $status = $value['status'];
        $manage = "<a href=". base_url('Admin/user_profile/'.$id).">Edit<a/>";
        // echo "$manage";die;

        if ($user_type == 1) {
        	$user_type_txt = 'SCMLT';
        }
        else if ($user_type == 2) {
        	$user_type_txt = 'CLC';
        }
        else if ($user_type == 3) {
        	$user_type_txt = 'Partner';
        }
        else if ($user_type == 4) {
        	$user_type_txt = 'Partner Admin';
        }
        else if ($user_type == 5) {
        	$user_type_txt = 'RTK Manager ';
        }
        
        if ($status == 1) {
        	$status_txt = 'Active';
        }
        else if ($status == 2) {
        	$status_txt = 'Inactive';
        }
        // $partner_name = null;
        // if($partner_id!=0){
        //     $partner_dets= $this->partners_model->get_one_id($partner_id);
        //     $partner_name = $partner_dets['name'];
        // }else{
        //     $partner_name = 'N/A';
        // }
        // $set_non_reporting_link = base_url().'Admin_management/change_reporting_status/'.$facility_code.'/0';
        // $set_reporting_link = base_url().'Admin_management/change_reporting_status/'.$facility_code.'/1';
        // if($rtk_enabled==1){
        //     $status.= 'Reporting <a href="'.$set_non_reporting_link.'"><span class="glyphicon glyphicon-minus"></span></a>';
        //     $link = '<button id="'.$facility_code.'" class="edit_facility_link" value="'.$facility_code.'" data-toggle="modal" data-target="#edit_facility">Edit </button>';

        // }else if($rtk_enabled==0){
        //     $status.= 'Not Reporting <a href="'.$set_reporting_link.'"><span class="glyphicon glyphicon-plus"></span></a>';            
        //     $link = 'N/A';

        // }               
        $output[] = array($first_name,$last_name,$email,$user_type_txt,$status_txt,$manage);
    }
    // echo "<pre>";
    // print_r($output);die();
    echo json_encode($output);

}
function get_national_user_profile($id){
    $this->load->model('User_model','users_model');  
    $users = $this->users_model->get_one_user($id);  

    
        $id = $users[0]['id'];
        $first_name = $users[0]['fname'];
        $last_name = $users[0]['lname'];
        $email = $users[0]['email'];
        $user_type = $users[0]['usertype_id'];
        $phone = $users[0]['telephone'];
        $status = $users[0]['status'];
        $county_id = $users[0]['county_id'];
        $district_id = $users[0]['district'];
        $partner_id = $users[0]['partner'];
        $regions = '';

		if ($user_type == 1) {
        	$user_type_txt = 'SCMLT';
        	$sql = "select district from districts where id = '$district_id'";
        	$result = $this->db->query($sql)->result_array();
        // echo "<pre/>";print_r($result);
        	$regions = $result[0]['district'];
        }
        else if ($user_type == 2) {
        	$user_type_txt = 'CLC';
        	$sql = "select county from counties where id = '$county_id'";
        	$result = $this->db->query($sql)->result_array();
        	$regions = $result[0]['county'];
        }
        else if ($user_type == 3) {
        	$user_type_txt = 'Partner';        	
        }
        else if ($user_type == 4) {
        	$user_type_txt = 'Partner Admin';
        }
        else if ($user_type == 5) {
        	$user_type_txt = 'RTK Manager ';
        }
        
        if ($status == 1) {
        	$status_txt = 'Active';
        }
        else if ($status == 2) {
        	$status_txt = 'Inactive';
        }
       // echo "<pre>"; print_r($regions);
        $output[] = array('first_name'=>$first_name,"last_name"=>$last_name,"email"=>$email,"phone"=>$phone,
        			"user_type_txt"=>$user_type_txt,"status_txt"=>$status_txt, "regions"=> $regions);

    $output=str_replace('"', "'", $output);
    echo json_encode($output);

}
function reset_password(){
	$user_id = $_POST['user_id'];
    $this->load->model('User_model','users_model');    
    $users = $this->users_model->reset_password($user_id);  		
}

function deactivate_user(){
	$user_id = $_POST['user_id'];
    $this->load->model('User_model','users_model');    
    $users = $this->users_model->deactivate_user($user_id);  		
}

function get_regions_add_user($user_type){

	if ($user_type == 1) {
		$this->load->model("Districts_model",'districts_model');                                                        
	    $option = '';                                           
	    $districts = $this->districts_model->get_all();
	    foreach ($districts as $key => $value) {
	        $id = $value['id'];
	        $district = $value['district'];
	        $option='<option value="'.$id.'">'.$district.'</option>';
	    }
	    print_r($option);		
	}
	else if ($user_type == 2) {
		$this->load->model("Counties_model",'counties_model');                                                        
	    $option = '';                                           
	    $districts = $this->counties_model->get_all();
	    foreach ($districts as $key => $value) {
	        $id = $value['id'];
	        $county_name = $value['county'];
	        $option='<option value="'.$id.'">'.$county_name.'</option>';
    }

	}
	else if ($user_type == 5) {
		                                                
	    $option = '';                                           
	    $option='<option value="0">National</option>';
	}

    echo json_encode($option);
}

	
}

