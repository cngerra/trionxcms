<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xcms extends CI_Controller{

	// function __construct()
	// {
		
	// }

	function index(){
		$this->load->helper('commonfunctions_helper');

		if($this->session->userdata('logged_in')){
			$data['title'] 			= "Back-end";
			$data['titleText'] 		= "Dashboard";
			$data['isBtnPresent'] 	= false;
			$this->load->view('header', $data);
			load_sidebar();
			$this->load->view('nav-header');
			$this->load->view('xcms-admin/content-dashboard');
			$this->load->view('footer');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('xcms-admin/login', 'refresh');
	}

	function login(){
		if($this->session->userdata('logged_in')){
			$session_data		= $this->session->userdata('logged_in');
			$data['username']	= $session_data['username'];
			$data['fname']		= $session_data['fname'];
			$data['lname']		= $session_data['lname'];
			$data['id']			= $session_data['id'];
			$data['avatar_color']			= $session_data['avatar_color'];
			redirect('xcms-admin', 'refresh');
			echo 'tye';
		}else{
			$this->load->helper(array('form'));

			$data['title'] = "TrionX CMS Login";
			$this->load->view('xcms-admin/login', $data);
		}
	}

}