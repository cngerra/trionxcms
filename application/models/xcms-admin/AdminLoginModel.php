<?php

class AdminLoginModel extends CI_Model{
	
	//Admin Login function
	function adminLogin($username,$password){
		$this->db->select('id, username, password, fname, lname, type, avatar_color');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->where('status', 'Active');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1)
			return $query->result();
		else
			return false;
	}

	//Setting the Last Login Data to database
	function updateLastLogin($data, $id){
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
}