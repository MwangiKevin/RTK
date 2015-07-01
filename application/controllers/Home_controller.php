<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Home_controller extends CI_Controller {

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
		$usertype_id = $this->session->userdata('usertype_id');				
		switch ($usertype_id) {
			case '1':
				redirect('Scmlt');				
				break;
			case '2':
				redirect('Clc');				
				break;
			case '3':
				redirect('Partner');				
				break;
			case '4':
				redirect('Partner_admin');				
				break;
			case '5':
				redirect('Admin');				
				break;
			case '6':
				redirect('Allocation');				
				break;
			case '7':
				redirect('Pepfar');				
				break;
			
			default:
				# code...
				break;
		}
	}
	
}
