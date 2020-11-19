<?php

class Blogscontroller extends CI_COntroller
{

	var $blog_image_path		= "/uploads/blogs/";
	var $blog_thumb_image_path	= "/uploads/blogs/thumbs/";


	function __construct()
	{
		error_reporting(E_ALL | E_STRICT);

		parent::__construct();
		$this->load->model('xcms-admin/adminblogmodel', '', TRUE);
		$this->load->helper('commonfunctions_helper');

		//loading of the slug library
		$config = array(
			'field' => 'blog_title_slug',
			'title' => 'blog_title',
			'table' => 'blog',
			'id' 	=> 'blog_id',
		);
		
		$this->load->library('slug', $config);
	}

	function index(){

		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
		//Checking if uploads folder already there
		if (!is_dir('uploads/')){
			mkdir('./uploads', 0777, true);
		}

		if (!is_dir('uploads/blogs/')){
			mkdir('.'.$this->blog_image_path, 0777, true);
		}

		if (!is_dir('uploads/blogs/thumbs/')){
			mkdir('.'.$this->blog_thumb_image_path, 0777, true);
		}

		if($this->session->userdata('logged_in')){

			$data['title']					= 'Blogs';
			$data['titleText']				= 'Blogs';
			$data['isBtnPresent'] 			= true;
			$data['btnText']				= 'Add New';

			$data['btnName']				= 'blogModal';
			$data['btnFunction']			= 'addBlogModal()';
			$data['modalBtnOnClickFunction']= 'addNewBlog();';
			$this->load->view('header', $data);
			load_sidebar();
			$this->load->view('nav-header');

			//load all blog
			$data['allblogs']	= $this->adminblogmodel->loadBlog();

			//load all user types
			$data['allblogcategory']	= $this->adminblogmodel->loadBlogCat();

			$this->load->view('xcms-admin/blogs/content-blogs', $data);			
			$this->load->view('xcms-admin/footer-admin');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function addBlogSlug($blog_title, $blog_title_slug){

		//removing the %20 on the string
		$blog_title = urldecode($blog_title);

		$output = $this->slug->create_uri($blog_title);

		echo $output;
	}

	function insertBlog(){

		$blog_title			= $this->input->post('blog_title');
		$blog_category		= $this->input->post('blog_category');
		$blog_image			= $this->input->post('blog_image');
		$blog_title_slug	= $this->input->post('blog_title_slug');
		$blog_post			= htmlentities($this->input->post('blog_post'));
		$blog_date_posted	= mdate('%M %d, %Y');

		$session_data	= $this->session->userdata('logged_in');
		$fname			= $session_data['fname'];
		$lname			= $session_data['lname'];

		//changing the filename of the image to be uploaded
		$date_today		= mdate('%m%d%Y%h%i%s');
		$fileExtension	= explode(".", $_FILES["blog_image"]["name"]);
		$fileExtension 	= end($fileExtension);

		$fileName 		= $date_today;
		//data to be saved
		$data 	= array(
			'blog_title' 		=> $blog_title,
			'blog_post' 		=> $blog_post,
			'blog_title_slug'	=> $this->slug->create_uri($blog_title),
			'blog_category' 	=> $blog_category,
			'blog_posted_by' 	=> $fname.' '.$lname,
			'blog_date_posted' 	=> $blog_date_posted,
			'blog_image' 		=> $fileName.'.'.$fileExtension,
			'blog_image_thumb' 	=> $fileName.'_thumb.'.$fileExtension,
			'blog_status' 		=> 'Active',
		);

		$this->security->xss_clean($data);

		//checking if blog title already exist
		$loadSpecificBlogTitle 	= $this->adminblogmodel->loadSpecificBlogTitle($data['blog_title']);
		
		//uploading the blog image
		imageUpload($_FILES["blog_image"]["name"], 'blog_image', $fileName, '.'.$this->blog_image_path);

		//creating the thumbnail of the blog image
		imageUploadThumb('.'.$this->blog_image_path.$fileName.'.'.$fileExtension, '.'.$this->blog_thumb_image_path, 50, 50);

		//saving the data to database
		$this->adminblogmodel->addNewBlog($data);
		$this->db->close();
		echo 'success';
	}

	function deleteBlog($id){
		$blogImage		= $this->adminblogmodel->loadBLogImage($id);

		deleteUploadedImage($this->blog_image_path,$blogImage['blog_image']);
		deleteUploadedImage($this->blog_thumb_image_path,$blogImage['blog_image_thumb']);

		$this->adminblogmodel->deleteBlog($id);

		echo "success";
	}

	function editBlog($id){
		if($this->session->userdata('logged_in')){
			$data['title'] = "Edit Blog | Trion XCMS";
			$this->load->view('header', $data);
			load_sidebar();

			$data['loadBlogToEdit']		= $this->adminblogmodel->loadBlogToEdit($id);
			$data['allblogcategory']	= $this->adminblogmodel->loadBlogCat();
			$this->load->view('xcms-admin/blogs/content-edit-blog', $data);
			$this->load->view('footer');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function updateBlog(){
		$blog_id			= $this->input->post('blog_id');
		$blog_title			= $this->input->post('blog_title');
		$blog_category		= $this->input->post('blog_category');
		$blog_image			= $this->input->post('blog_image');
		$blog_post			= htmlentities($this->input->post('blog_post'));
		$blog_date_updated	= mdate('%M %d, %Y');
		$blog_status		= $this->input->post('blog_status');

		$session_data	= $this->session->userdata('logged_in');
		$fname			= $session_data['fname'];
		$lname			= $session_data['lname'];

		//checking if blog image is empty
		if(($_FILES['blog_image']['name'] == "") || ($_FILES['blog_image']['size'] == 0)){
			//data to be saved
			$data 	= array(
				'blog_title' 		=> $blog_title,
				'blog_title_slug'	=> $this->slug->create_uri($blog_title),
				'blog_post' 		=> $blog_post,
				'blog_category' 	=> $blog_category,
				'blog_updated_by' 	=> $fname.' '.$lname,
				'blog_date_updated' => $blog_date_updated,
				'blog_status' 		=> $blog_status,
			);
		}else{
			//loading blog image
			$blogImage		= $this->adminblogmodel->loadBLogImage($blog_id);

			//delete the previous featured image
			deleteUploadedImage($this->blog_image_path,$blogImage['blog_image']);
			deleteUploadedImage($this->blog_thumb_image_path,$blogImage['blog_image_thumb']);

			//changing the filename of the image to be uploaded
			$date_today			= mdate('%m%d%Y');
			$fileExtension		= explode(".", $_FILES["blog_image"]["name"]);
			$fileExtension 		= end($fileExtension);

			$fileName 			= strtolower(str_replace(" ", "_", $blog_title)).'_'.$date_today;

			$blog_image 		= $fileName.'.'.$fileExtension;
			$blog_image_thumb 	= $fileName.'_thumb.'.$fileExtension;

			//data to be saved
			$data 	= array(
				'blog_title' 		=> $blog_title,
				'blog_post' 		=> $blog_post,
				'blog_title_slug'	=> $this->slug->create_uri($blog_title),
				'blog_category' 	=> $blog_category,
				'blog_updated_by' 	=> $fname.' '.$lname,
				'blog_date_updated' => $blog_date_updated,
				'blog_image' 		=> $blog_image,
				'blog_image_thumb' 	=> $blog_image_thumb,
				'blog_status' 		=> $blog_status,
			);	

			//uploading the blog image
			imageUpload($_FILES["blog_image"]["name"], 'blog_image', $fileName, '.'.$this->blog_image_path);

			//creating the thumbnail of the blog image
			imageUploadThumb('.'.$this->blog_image_path.$fileName.'.'.$fileExtension, '.'.$this->blog_thumb_image_path, 50, 50);
		}

		$this->security->xss_clean($data);

		//saving the data to database
		$this->adminblogmodel->updateBlog($blog_id, $data);
		$this->db->close();
		echo 'success';
	}

	function blogCategories(){
		if($this->session->userdata('logged_in')){
			$data['title']	= 'Blog Categories | TrionX CMS';
			$this->load->view('header', $data);
			load_sidebar();

			$data['loadBlogCategories']	= $this->adminblogmodel->loadBlogCat();

			$this->load->view('xcms-admin/blogs/content-blogs-categories', $data);
			$this->load->view('footer');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function insertBlogCategory(){
		$blogCat 	= $this->input->post('blog_category');
		$blogDesc 	= $this->input->post('blog_description');

		$data = array(
			'blog_category' 	=> $blogCat,
			'blog_category_slug'=> $this->slug->create_uri($blogCat),
			'blog_description' 	=> $blogDesc,
			'blog_cat_status' 	=> 'Active'
		);
		$this->security->xss_clean($data);
		$duplicateCat	= $this->adminblogmodel->loadSpecificBlogCat($data['blog_category']);
		if($duplicateCat['blog_category'] == $blogCat){
			echo 'duplicate';
		}else{
			$this->adminblogmodel->addNewBlogCat($data);
			$this->db->close();
			echo 'success';
			redirect('xcms-admin/blogs/blog-categories', 'refresh');
		}
	}

	function editBlogCat($id){
		if($this->session->userdata('logged_in')){
			$data['title'] = "Edit Blog Categories | Trion XCMS";
			$this->load->view('header', $data);
			load_sidebar();

			$data['loadBlogCatToEdit']		= $this->adminblogmodel->loadBlogCatToEdit($id);

			$data['id']		= md5($id);
			$this->load->view('xcms-admin/blogs/content-edit-blogs-categories', $data);
			$this->load->view('footer');
		}else{
			redirect('xcms-admin/login', 'refresh');
		}
	}

	function deleteBlogCategory($id){
		$this->adminblogmodel->deleteBlogCat($id);
		echo "success";
	}

}
