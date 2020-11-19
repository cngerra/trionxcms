<?php
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userscontroller extends CI_COntroller
{
	
	function __construct()
	{
		error_reporting(E_ALL | E_STRICT);
		
		parent::__construct();
		$this->load->model('xcms-admin/adminusersmodel', '', TRUE);
		$this->load->helper('commonfunctions_helper');
	}

	function users($userType=''){

		$this->load->model('xcms-admin/adminusersmodel','', TRUE);
		
		if($this->session->userdata('logged_in')){

			$data['title']					= 'Users';
			$data['titleText']				= 'Users';
			$data['isBtnPresent'] 			= true;
			$data['btnText']				= 'Add New';

			$data['btnName']				= 'userModal';
			$data['btnFunction']			= 'addUserModal()';
			$data['modalBtnOnClickFunction']= 'addNewUser();';
			$data['modalBtnOnClickFuncPass']= 'updateUserPassword();';
			$this->load->view('header', $data);
			load_sidebar();
			$this->load->view('nav-header');

			//load all users
			if(isset($userType) && $userType != ''){
				$data['alluserrecords']	= $this->adminusersmodel->loadUsersAccordingToUserType($userType);
			}else{
				$data['alluserrecords']	= $this->adminusersmodel->loadAllUsers();
				$data['controlURL']				= 'users/';
			}

			//load all user types
			$data['allusertypes']	= $this->adminusersmodel->loadAllUserType();
			
			$this->load->view('xcms-admin/users/content-users', $data);
			$this->load->view('xcms-admin/footer-admin');
			
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function insertUser(){
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$fname		= $this->input->post('fname');
		$lname		= $this->input->post('lname');
		$email		= $this->input->post('email');
		$address	= $this->input->post('address');
		$zip_code	= $this->input->post('zip_code');
		$bdate		= $this->input->post('bdate');
		$type		= $this->input->post('type');

		$colors = array("black","yellow","red","green","darkgreen","purple","gray");
		$random = $colors[array_rand($colors)];

		$data = array(
			'username'		=> $username,
			'password'		=> md5($password),
			'fname'			=> ucwords($fname),
			'lname'			=> ucwords($lname),
			'email'			=> $email,
			'address'		=> ucwords($address),
			'zip_code'		=> $zip_code,
			'bdate'			=> $bdate,
			'status'		=> 'Active',
			'type'			=> $type,
			'ipaddress'		=> $_SERVER['REMOTE_ADDR'],
			'avatar_color'	=> $random
		);

		$this->security->xss_clean($data);
		$duplicateUsername	= $this->adminusersmodel->selectUser($username);

		if(isset($duplicateUsername["username"])){
			if($duplicateUsername["username"] == $username){
				$arrayReturn = array('status' => 'duplicate');
				echo json_encode($arrayReturn);
			}
		}else{
			$this->adminusersmodel->addNewUser($data);
			$arrayReturn = array('status' => 'success');
			echo json_encode($arrayReturn);
		}
		
	}

	function editUser($userID){

		if($this->session->userdata('logged_in')){			
			// $allusertypes	= $this->adminusersmodel->loadAllUserType();
			$data['records']	= $this->adminusersmodel->loadUsertoEdit($userID);
			$data['modalBtnOnClickFunction']= 'updateUser();';
			$data['modalBtnText']			= 'Update';
			$data['userNameDisabled']		= true;
			echo json_encode($data);
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function updateUser(){
		$id			= $this->input->post('id');
		// $password	= $this->input->post('password');
		// $verifypass	= $this->input->post('verifypassword');
		$fname		= $this->input->post('fname');
		$lname		= $this->input->post('lname');
		$email		= $this->input->post('email');
		$address	= $this->input->post('address');
		$zip_code	= $this->input->post('zip_code');
		$bdate		= $this->input->post('bdate');
		$status		= $this->input->post('status');
		$type		= $this->input->post('type');

		$data = array(
			// 'password'	=> md5($password),
			'fname'		=> $fname,
			'lname'		=> $lname,
			'email'		=> $email,
			'address'	=> $address,
			'zip_code'	=> $zip_code,
			'bdate'		=> $bdate,
			'status'	=> $status,
			'type'		=> $type
		);

		$this->security->xss_clean($data);

		// if($password == $verifypass){
		if($this->adminusersmodel->updateUser($id, $data)){
			$arrayReturn = array('status' => 'updated', 'msg' => 'Update success.');
			echo json_encode($arrayReturn);
		}else{			
			$arrayReturn = array('status' => 'errorUpdate', 'msg' => 'Update error.');
			echo json_encode($arrayReturn);
		}

	}

	function deleteUser($id){
		$this->adminusersmodel->deleteUser($id);
		echo 'success';
	}

	function userType($type){
		$type 	= str_replace("_", " ", $type);
		$type 	= ucwords($type);

		if($this->session->userdata('logged_in')){
			$data['title']	= $type .' | TrionX CMS';
			$this->load->view('header', $data);
			load_sidebar();
			
			$data['usertype']	= $this->adminusersmodel->selectUserType($type);
			$data['type']		= $type;
			$this->load->view('xcms-admin/users/content-users-type', $data);
			$this->load->view('footer');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}
}
