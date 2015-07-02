<?php

/**
* 
*/
class User_model extends CI_Model
{
	// private $username;
	// private $password;
	// private $hash_password;
	// public $fname;
	// public $lname;
	// public $full_name;
	// public $email;
	// public $telephone;
	// public $log_status;
	// public $district_id;
	// public $county_id;
	// public $partner;
	// public $facility;
 
	

	function login($username, $password)
	{		
		$hash_pass = $this->_encrypt_pass($password);
		$sql = "select * from user where email='$username' and password='$hash_pass' limit 0,1";				
		$x = $this->db->query($sql)->result_array();			
		return $x;		
		
	}

	private function _encrypt_pass($pass)
	{
		$salt = '#*seCrEt!@-*%';		
		$new_pass = (md5($salt.$pass));
		return $new_pass;
	}
	function get_national_users_conditions()
	{
		
		$sql = "select * from user limit 0,5";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function get_county_users($county_id)
	{
		
		$sql = "select * from user where county_id = '$county_id'";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function get_one_user($id)
	{
		
		$sql = "select * from user where id = $id";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function reset_password($user_id){
		$passW = '123456';
		$new_pass =$this->_encrypt_pass($passW);

		$sql = "update user set password='$new_pass' where id = '$user_id'";
	    $this->db->query($sql);
	}
	function deactivate_user($user_id){
		$sql = "update user set status='0' where id = '$user_id'";
	    $this->db->query($sql);
	}
}


?>