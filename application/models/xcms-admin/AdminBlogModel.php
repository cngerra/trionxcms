<?php

class AdminBlogModel extends CI_Model{

	var $table = "blog";

	function addNewBlog($data){
		return $this->db->insert("blog", $data);
	}

	function addNewBlogCat($data){
		return $this->db->insert("blog_category", $data);
	}

	function addNewBlogComments($data){
		return $this->db->insert("blog_comments", $data);
	}

	function updateBlog($id, $data){
		$this->db->set($data);
		$this->db->where("blog_id", $id);
		$this->db->update("blog", $data);
		$this->db->close();
	}

	function updateBlogCat($id, $data){
		$this->db->set($data);
		$this->db->where("blog_cat_id", $id);
		$this->db->update("blog_category", $data);
		$this->db->close();
	}

	function updateBlogComments($id, $data){
		$this->db->set($data);
		$this->db->where("comment_id", $id);
		$this->db->update("blog_comments", $data);
		$this->db->close();
	}

	function loadBlog(){
		$this->db->select("*");
		$this->db->from("blog");

		$query	= $this->db->get();

		return $query->result();
	}

	function loadBlogToEdit($id){
		$this->db->select("*");
		$this->db->from("blog");
		$this->db->where("blog_id", $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->result();
	}

	function loadBlogCatToEdit($id){
		$this->db->select("*");
		$this->db->from("blog_category");
		$this->db->where("blog_cat_id", $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->result();
	}

	function loadSpecificBlogTitle($title){
		$this->db->select_max("blog_id");
		$this->db->select("blog_title");
		$this->db->from("blog");
		$this->db->where("blog_title", $title);

		$query	= $this->db->get();

		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row['blog_title'];
		}else{
			return false;
		}
	}

	function loadBlogCat(){
		$this->db->select("*");
		$this->db->from("blog_category");

		$query	= $this->db->get();

		return $query->result();
	}

	function loadSpecificBlogCat($category){
		$this->db->select("blog_category");
		$this->db->from("blog_category");
		$this->db->where("blog_category", $category);
		$this->db->limit(1);

		$query	= $this->db->get();

		if($query->num_rows() > 0){
			$row = $query->row_array();
			return $row;
		}
	}

	function loadBLogImage($id){
		$this->db->select("blog_image,blog_image_thumb");
		$this->db->from("blog");
		$this->db->where("blog_id", $id);
		$this->db->limit(1);

		$query	= $this->db->get();

		if($query->num_rows() > 0){
			$row = $query->row_array();

			return $row;
		}
	}

	function loadBlogComments(){
		$this->db->select("*");
		$this->db->from("blog_comments");

		$query	= $this->db->get();

		return $query->result();
	}

	function deleteBlog($id){
		return $this->db->delete("blog", "blog_id=".$id);
	}

	function deleteBlogCat($id){
		return $this->db->delete("blog_category", "blog_cat_id=".$id);
	}

	function deleteBlogComments($id){
		return $this->db->delete("blog_comments", "comment_id=".$id);
	}

}