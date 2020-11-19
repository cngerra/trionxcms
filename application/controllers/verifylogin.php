<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('xcms-admin/adminloginmodel','', TRUE);
	}

	function index(){
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() != FALSE){			
			//Go to private area
			redirect('xcms-admin/index', 'refresh');
		}
	}

	function check_database($password){
		$username = $this->input->post('username');

		$result = $this->adminloginmodel->adminLogin($username, $password);
		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' 			=> $row->id,
					'username' 		=> $row->username,
					'fname'			=> $row->fname,
					'lname'			=> $row->lname,
					'avatar_color'	=> $row->avatar_color
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}

			$session_data	= $this->session->userdata('logged_in');

			$date_today	= '%M %d, %Y - %h:%i %a';
			$date_time 	= mdate($date_today, time());
			$data 	= array('last_login' => $date_time);
			$this->adminloginmodel->updateLastLogin($data, $session_data['id']);

			echo 'success';
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database','Invalid username or password');
			echo 'failed';
			return FALSE;
		}

	}

}