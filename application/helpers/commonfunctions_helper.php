<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('load_sidebar')){
	function load_sidebar(){
		
		//assigning the CodeIgniter object to a variable
		$CI =& get_instance();

		$session_data		= $CI->session->userdata('logged_in');
		$data['username']	= $session_data['username'];
		$data['fname']		= $session_data['fname'];
		$data['lname']		= $session_data['lname'];
		$data['id']			= $session_data['id'];
		$data['avatar_color']			= $session_data['avatar_color'];

		$CI->load->view('xcms-admin/sidebar-menus', $data);
	}
}
if(!function_exists('getAvatar')){
	function getAvatar($initials, $color, $additionalClass=""){
		$ret	= '';
		foreach (explode(' ', $initials, 2) as $word){
			$ret .= strtoupper($word[0]);
		}
		
		$wrapper = "<span class=\"avatar {$additionalClass}\" style=\"background-color: ".$color." \">".$ret."</span>";
		return $wrapper;
	}
}

if(!function_exists('imageUpload')){
	function imageUpload($image, $imageName, $fileName, $uploadPath){

		if(isset($image)){
			$config	= array(
				'upload_path'	=> $uploadPath,
				'allowed_types'	=> 'gif|jpg|jpeg|png',
				'file_name'		=> $fileName,
			);

			//assigning the CodeIgniter object to a variable
			$CI =& get_instance();

			$CI->load->library('upload', $config);

			if(!$CI->upload->do_upload($imageName))
			{
				echo $CI->upload->display_errors();
			}
			else
			{
				$data = $CI->upload->data();
			}
		}
	}
}

if(!function_exists('imageUploadThumb')){
	function imageUploadThumb($sourceImage, $newImage, $width, $height){

		//assigning the CodeIgniter object to a variable
		$CI =& get_instance();

		$configThumb = array(
			'image_library'	=> 'gd2',
			'source_image' 	=> $sourceImage, 
			'new_image'		=> $newImage,
			'create_thumb' 	=> TRUE, 
			'main_ratio'	=> TRUE,
			'width'			=> $width,
			'height'		=> $height
		);
		
		$CI->load->library('image_lib', $configThumb);
		$CI->image_lib->resize();
	}
}

if(!function_exists('deleteUploadedImage')){
	function deleteUploadedImage($uploadPath, $fileName){
		unlink('.'.$uploadPath.$fileName);
	}

}

if(!function_exists('editor')){
	function editor(){

		//assigning the CodeIgniter object to a variable
		$CI =& get_instance();

		//ckfinder path
		$ckFinderPath = base_url().'assets/js/ckfinder';

		//loading library for ckeditor
		$CI->load->library('ckeditor');
		$CI->load->library('ckFinder');

		//configure base path of ckeditor folder
		$CI->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$CI->ckeditor->config['toolbar'] = 'Full';
		$CI->ckeditor->config['language'] = 'en';
		$CI->ckeditor->config['width'] = '100px';

		//configure ckfinder with ckeditor config
		$CI->ckfinder->SetupCKEditor($CI->ckeditor, $ckFinderPath);
	}
}
	
if(!function_exists('titleSlug')){
	function titleSlug($title){
		$title 	= urldecode($title);
		$title 	= strtolower($title);
		$title 	= preg_replace('/[^A-Za-z0-9-]+/', '-', $title);

		return $title;
	}
}