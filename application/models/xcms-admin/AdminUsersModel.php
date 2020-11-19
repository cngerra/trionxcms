<?php

class AdminUsersModel extends CI_Model{
	
	function addNewUser($data){
		$this->db->insert("users", $data);
	}

	function updateUser($id, $data){
		$this->db->set($data);
		$this->db->where("id", $id);
		$this->db->update("users", $data);
		$this->db->close();

		return true;
	}

	function deleteUser($id){
		return $this->db->delete("users","id=".$id);
	}

	function selectUser($username){
		$this->db->select("username");
		$this->db->from("users");
		$this->db->where("username", $username);
		$this->db->limit(1);

		$query	= $this->db->get();

		// if($query->num_rows() > 0){
			return $query->row_array();
			// return $row;
		// }
	}

	function selectUserType($type){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("type", $type);

		$query	= $this->db->get();

		return $query->result();
	}

	function loadUsertoEdit($userID){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id", $userID);
		$this->db->limit(1);

		$query	= $this->db->get();

		return $query->row();
	}

	function loadAllUsers(){
		$query	= $this->db->get("users");

		return $query->result();
	}

	function loadAllUserType(){
		$this->db->select('*');
		$this->db->from("users_type");
		$query = $this->db->get();

		return $query->result();
	}

	function loadUsersAccordingToUserType($userType){
		$userType = str_replace("_", " ", $userType);
		
		$this->db->select('*');
		$this->db->from("users");
		$this->db->where("type", $userType);
		$query = $this->db->get();

		return $query->result();
	}

	function getLastID(){
		$this->db->select_max("id");
		$query	= $this->db->get("users");

		return $query->row_array();
	}
}