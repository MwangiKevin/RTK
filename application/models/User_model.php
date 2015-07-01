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
	function get_national_users_conditions($conditions = null)
	{
		if($conditions==0)
		{
			$conditions = '';
		}
		$sql = "select * from user";		 
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	
}


?>