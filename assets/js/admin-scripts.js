/*JS Document*/
$(document).ready(function(){

	//Sidebar
	$('.dropdown-wrapper').on("click", function(){
		$(this).parent('li').find('ul.dropdown').stop(true,true).delay(200).slideToggle();
		$(this).find('i').toggleClass('fa-caret-down fa-caret-up');
	});

	$('#username, #password').on('keyup', function(event) {
		if(event.keyCode == 13) { // 13 = Enter Key
			loginAdminUser();
		}
	});	
});

/*Login Function*/
function loginAdminUser(){
	var username = $("#username").val();
	var password = $("#password").val();
	
	var msg = {
		username : "Please enter your username",
		password : "Please enter your password"
	}
	
	$('.help-block').hide();
	$('.form-control').removeClass('has-error');
	
	var button = $('.btn-login');
	var button_str = button.html();
	startLoading(button, 'Processing');
	
	$('#login-form').validate({
		onkeyup: false,
		onfocusout: false,
		rules : {
			username: {
				required: true,
			},
			password: {
				required: true,
			}
		},
		messages : {
			username: {
				required: msg.username,
			},
			password: {
				required: msg.password,
			}
		},
		highlight: function(element) {
			$(element).addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				url: '/verifylogin',
				async: false,
				data: $('#login-form').serialize(),
				success: function(response){
					if(response == "success"){
					 $('.login-success').show().delay(3000).fadeOut(400, function(){
							window.location = "/xcms-admin";
						});
					}else{
						$('.login-error').show().delay(3000).fadeOut(400);
					}

					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$("#login-form").submit();
	}, 200);
	return false;
}

function togglePassword(passfieldTextField, toggleEye){
	var passfieldArr= passfieldTextField;
	var toggleEye	= document.getElementById(toggleEye);

	for(var x = 0; x < passfieldArr.length; x++){
		var passfield = document.getElementById(passfieldArr[x]);
		if(passfield.type == "password"){
			passfield.type = "text";
			toggleEye.classList.remove("fa-eye");
			toggleEye.classList.add("fa-eye-slash");
		}else{
			passfield.type = "password";
			toggleEye.classList.remove("fa-eye-slash");
			toggleEye.classList.add("fa-eye");
		}
	}
}

function addUserModal(){
	$('#trionForm').trigger('reset');
	$('.help-block').hide();
	$('#userModalLabel').text('Add User');
	$('[name="username"]').removeAttr('disabled');
	$('#userModal .btn-save').text('Save');
	$('.password-block').removeClass('d-none');
	$('.change-pass-block').addClass('d-none');	
	$('.status').addClass('d-none');
	$('[name="bdate"]').datepicker({format: 'yyyy-mm-dd',startDate: '1990-01-01', endDate: '2000-12-31'});
	$('.btn-save').attr('onclick', 'addNewUser();');

	$('#userModal').modal('show');
}

/*Users Function*/
function addNewUser(){
	var msg = {
		username : "Please enter your username",
		password : "Please enter your password",
		verifypassword : "Please verify your password",
		passwordmismatch : "Password did not match",
		fname : "Please enter your first name",
		lname : "Please enter your last name",
		email : "Please enter your email address",
		address : "Please enter your address",
		zip_code : "Please enter your zip code",
		bdate : "Enter your date of birth",
		type : "Please select user type",
	}

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button = $('.btn-save');
	var button_str = button.html();
	startLoading(button, 'Adding');

	$('#trionForm').validate({
		onkeyup: false,
		onfocusout: false,
		rules : {
			username: {
				required: true,
			},
			password: {
				required: true,
			},
			verifypassword: {
				required: true,
				equalTo: "#password",
			},
			fname: {
				nameRx : true,
				required : true
			},
			lname: {
				nameRx : true,
				required : true
			},
			email: {
				emailRx : true,
				required: true,
			},
			address: {
				selectBoxRx : true,
				required: true,
			},
			zip_code: {
				required: true,
			},
			bdate: {
				required: true,
			},
			type: {
				selectBoxRx : true,
				required: true,
			}
		},
		messages : {
			username: {
				required: msg.username,
			},
			password: {
				required: msg.password,
			},
			verifypassword: {
				required: msg.verifypassword,
				equalTo: msg.passwordmismatch,
			},
			fname: {
				nameRx : msg.fname,
				required : msg.fname
			},
			lname: {
				nameRx : msg.lname,
				required : msg.lname
			},
			email: {
				emailRx : msg.email,
				required: msg.email,
			},
			address: {
				selectBoxRx : msg.address,
				required: msg.address,
			},
			zip_code: {
				required: msg.zip_code,
			},
			bdate: {
				required: msg.bdate,
			},
			type: {
				selectBoxRx : msg.type,
				required: msg.type,
			}
		},		
		highlight: function(element) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.form-group').removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element).parents('.form-group');
			console.log(element);
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				url: '/userscontroller/insertuser',
				async: false,
				data: $('#trionForm').serialize(),
				dataType: "JSON",
				success: function(response){
					console.log(response);
					if(response.status == "success"){
						$('#trionForm').find('.btn-close').trigger('click');
						window.location = "/xcms-admin/users";
					}else if(response.status == 'duplicate'){
						$('#username').focus();
						$('.message-duplicate').show().delay(3000).fadeOut(400);
					}

					endLoading(button, button_str);
				},
				error: function(status) {
					endLoading(button, button_str);
				},
			});
			return false;
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$('#trionForm').submit();
	}, 200);
	return false;
}

function editUser(ID){
	$('#trionForm').trigger('reset');
	$('.help-block').hide();
	$('#userModalLabel').text('Edit User');
	$('.iradio_flat-green').removeClass('checked');
	$('.password-block').addClass('d-none');
	$('.change-pass-block').removeClass('d-none');	
	$('.status').removeClass('d-none');
	// $('.btn-save').attr('onclick', 'updateUser();');

	$.ajax({
		url: '/xcms-admin/users/edit/'+ID,
		type: 'GET',
		dataType: "JSON",
		success: function(status){
			console.log(status);

			$('[name="id"]').val(status.records.id);
			$('[name="username"]').val(status.records.username);
			$('[name="fname"]').val(status.records.fname);
			$('[name="lname"]').val(status.records.lname);
			$('[name="email"]').val(status.records.email);
			$('[name="address"]').val(status.records.address);
			$('[name="zip_code"]').val(status.records.zip_code);
			$('[name="bdate"]').val(status.records.bdate);
			$('[name="bdate"]').datepicker({format: 'yyyy-mm-dd',startDate: '', endDate: ''});
			$('[name="type"]').val(status.records.type);
			$('[name="status"][value="' + status.records.status + '"]').prop('checked', true);
			$('[name="status"][value="' + status.records.status + '"]').parents('.iradio_flat-green').addClass('checked');
			$('[name="username"]').attr('disabled', status.userNameDisabled);
			$('#userModal .btn-save').attr('onclick', status.modalBtnOnClickFunction);
			$('#userModal .btn-save').text(status.modalBtnText);
			
			// show bootstrap modal when complete loaded
			$('#userModal').modal('show');
		}
	});
}

function updateUser(){
	var msg = {
		username : "Please enter your username",
		fname : "Please enter your first name",
		lname : "Please enter your last name",
		email : "Please enter your email address",
		address : "Please enter your address",
		zip_code : "Please enter your zip code",
		bdate : "Enter your date of birth",
		status : "Please user status",
		type : "Please select user type",
	}

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button = $('.btn-save');
	var button_str = button.html();
	startLoading(button, 'Updating');

	$('#trionForm').validate({
		onkeyup: false,
		onfocusout: false,
		onclick: false,
		rules : {
			username: {
				required: true,
			},
			fname: {
				nameRx : true,
				required : true
			},
			lname: {
				nameRx : true,
				required : true
			},
			email: {
				emailRx : true,
				required: true,
			},
			address: {
				selectBoxRx : true,
				required: true,
			},
			zip_code: {
				required: true,
			},
			bdate: {
				required: true,
			},
			status: {
				selectBoxRx : true,
				required: true,
			},
			type: {
				selectBoxRx : true,
				required: true,
			}
		},
		messages : {
			username: {
				required: msg.username,
			},
			fname: {
				nameRx : msg.fname,
				required : msg.fname
			},
			lname: {
				nameRx : msg.lname,
				required : msg.lname
			},
			email: {
				emailRx : msg.email,
				required: msg.email,
			},
			address: {
				selectBoxRx : msg.address,
				required: msg.address,
			},
			zip_code: {
				required: msg.zip_code,
			},
			bdate: {
				required: msg.bdate,
			},
			status: {
				selectBoxRx : msg.status,
				required: msg.status,
			},
			type: {
				selectBoxRx : msg.type,
				required: msg.type,
			}
		},		
		highlight: function(element) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.form-group').removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element).parents('.form-group');
			console.log(element);
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				url: '/userscontroller/updateuser',
				async: false,
				data: $('#trionForm').serialize(),
				dataType:"JSON",
				success: function(response){
					console.log(response);
					if(response.status == "updated"){
						$('.return-message').html(response.msg);
						$('.return-message').show().delay(3000).fadeOut(400, function(){
							$('#userModal').modal('hide');
						});

					}else if(response.status == 'errorUpdate'){
						$('.return-message').html(response.msg);
						$('.return-message').show().delay(3000).fadeOut(400);
					}

					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;		
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$('#trionForm').submit();
	}, 200);
	return false;
}

function updateUserPassword(){
	var msg = {
		oldpassword : "Please enter your old password",
		password : "Please enter your new password",
		verifypassword : "Please verify your new password",
		passwordmismatch : "Password did not match",
	}

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button = $('.btn-save');
	var button_str = button.html();
	startLoading(button, 'Updating');

	$('#trionFormforPassword').validate({
		onkeyup: false,
		onfocusout: false,
		onclick: false,
		rules : {
			oldpassword: {
				required: true,
			},
			password: {
				required: true,
			},
			verifypassword: {
				required: true,
				equalTo: "#password",
			}
		},
		messages : {
			oldpassword: {
				required: msg.oldpassword,
			},
			password: {
				required: msg.password,
			},
			verifypassword: {
				required: msg.verifypassword,
				equalTo: msg.passwordmismatch,
			}
		},		
		highlight: function(element) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.form-group').removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element).parents('.form-group');
			console.log(element);
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				url: '/userscontroller/updateuser',
				async: false,
				data: $('#trionFormforPassword').serialize(),
				dataType:"JSON",
				success: function(response){
					console.log(response);
					if(response.status == "updated"){
						$('.return-message').html(response.msg);
						$('.return-message').show().delay(3000).fadeOut(400, function(){
							$('#userModal').modal('hide');
						});

					}else if(response.status == 'errorUpdate'){
						$('.return-message').html(response.msg);
						$('.return-message').show().delay(3000).fadeOut(400);
					}

					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;		
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$('#trionFormforPassword').submit();
	}, 200);
	return false;
}

function deleteUser($id){
	$('#dialog-confirm-delete-users').dialog({
		resizable: false,
		height: "auto",
		width: 400,
		modal: true,
		buttons: {
			"Delete": function(){
				$.ajax({
					type: 'POST',
					url: '/userscontroller/deleteuser/'+$id,
					async: false,
					success: function(response){
						if(response == "success"){
							$('#dialog-confirm-delete-users').dialog("close");
						 	$('.message-success').show().delay(3000).fadeOut(400);
						 	$('table.table tr#'+$id).remove();
						}else{
							$('#dialog-confirm-delete-users').dialog("close");
							$('.message-error').show().delay(3000).fadeOut(400);
						}
					}
				});
			},
			Cancel: function(){
				$(this).dialog("close");
			}
		}
	});
}


//Blog Entries
function addBlogEntry(){
	var msg = {
		blog_title : "Please enter you blog title",
		blog_title_duplicate : "Your blog entry title already in used",
		blog_category : "Please select one blog category",
		blog_image : "Please upload an image",
		blog_post : "Please enter you blog content",
	}

	var editor_data = CKEDITOR.instances.blog_post.getData();

	// alert(editor_data);

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button 		= $('.btn-save');
	var button_str 	= button.html();
	startLoading(button, 'Adding');

	$('#blogform').validate({
		onkeyup : false,
		onfocusout : false,
		onclick : false,
		rules : {
			blog_title : {
				required : true,
			},
			blog_category : {
				selectBoxRx : true,
				required : true,
			},
			blog_image : {
				required : true,
			},
			blog_post : {
				required : true,
			}
		},
		messages : {
			blog_title : {
				required : msg.blog_title,
			},
			blog_category : {
				selectBoxRx : msg.blog_category,
				required : msg.blog_category,
			},
			blog_image : {
				required : msg.blog_image,
			},
			blog_post : {
				required : msg.blog_post,
			}
		},
		highlight: function(element) {
			$(element).addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(form) {
			var formData = new FormData(form);
			$.ajax({
				url: "/blogscontroller/insertblog",
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData:false,
				success: function(response){
					if(response == "success"){
						$('.blogform').find('.btn-close').trigger('click');
						window.location = "/xcms-admin/blogs";
					}
					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$("#blogform").submit();
	}, 200);
	return false;
}
function updateBlog(){
	var msg = {
		blog_title : "Please enter you blog title",
		blog_title_duplicate : "Your blog entry title already in used",
		blog_category : "Please select one blog category",
		blog_image : "Please upload an image",
		blog_post : "Please enter you blog content",
	}

	var editor_data = CKEDITOR.instances.blog_post.getData();

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button 		= $('.btn-save');
	var button_str 	= button.html();
	startLoading(button, 'Updating');

	$('#blogform').validate({
		onkeyup : false,
		onfocusout : false,
		onclick : false,
		rules : {
			blog_title : {
				required : true,
			},
			blog_category : {
				selectBoxRx : true,
				required : true,
			},
			blog_post : {
				required : true,
			}
		},
		messages : {
			blog_title : {
				required : msg.blog_title,
			},
			blog_category : {
				selectBoxRx : msg.blog_category,
				required : msg.blog_category,
			},
			blog_post : {
				required : msg.blog_post,
			}
		},
		highlight: function(element) {
			$(element).addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(form) {
			var formData = new FormData(form);
			$.ajax({
				url: "/blogscontroller/updateblog",
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData:false,
				success: function(response){
					console.log(response);
					if(response == "success"){
						$('#update-success').dialog({
							resizable: false,
							height: "auto",
							width: 400,
							modal: true,
							buttons: {
								"OK": function(){
									// window.location = "/xcms-admin/blogs";
								}
							}
						});
						window.location = "/xcms-admin/blogs";
					}else if(response == 'duplicate'){
						$('#blog_title').focus();
						$('#blogform').validate().showErrors({"blog_title" : msg.blog_title_duplicate});
					}
					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$("#blogform").submit();
	}, 200);
	return false;
}

function deleteBlog($id){
	$('#dialog-confirm-delete-blog').dialog({
		resizable: false,
		height: "auto",
		width: 400,
		modal: true,
		buttons: {
			"Delete": function(){
				$.ajax({
					type: 'POST',
					url: '/blogscontroller/deleteblog/'+$id,
					async: false,
					success: function(response){
						if(response=="success"){
							$('#dialog-confirm-delete-blog').dialog("close");
							$('.message-success').show().delay(3000).fadeOut(400);
							location.reload();
						}else{
							$('#dialog-confirm-delete-blog').dialog("close");
							$('.message-error').show().delay(3000).fadeOut(400);
						}
					}
				});
			},
			Cancel: function(){
				$(this).dialog("close");
			}
		}
	});
}

function createSlug($title){
	$.ajax({
		type: 'POST',
		url: '/blogscontroller/addBlogSlug/'+$title+'/'+$title,
		async: false,
		success: function(response){
			alert(response);
			var base_url = $('#base-url').val();
			$('#slug').html(base_url+response);
		}
	});
}

function addNewBlogCat(){
	var msg = {
		category : "Please enter blog category",
		description : "Please enter blog category description",
	}

	$('.help-block').hide();
	$('.form-control').removeClass('has-error');

	var button = $('.btn-save');
	var button_str = button.html();
	startLoading(button, 'Adding');

	$('#blogform').validate({
		onkeyup: false,
		onfocusout: false,
		rules : {
			blog_category: {
				required: true,
			},
			blog_description: {
				required: true,
			}
		},
		messages : {
			blog_category: {
				required: msg.category,
			},
			blog_description: {
				required: msg.description,
			}
		},		
		highlight: function(element) {
			$(element).addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).removeClass('has-error');
		},
		errorElement: 'p',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(form) {
			$.ajax({
				type: 'POST',
				url: '/blogscontroller/insertblogcategory',
				async: false,
				data: $('#blogform').serialize(),
				success: function(response){
					if(response == "success"){
						$('.blogform').find('.btn-close').trigger('click');
						window.location = "/xcms-admin/blogs/blog-categories";
					}else if(response == 'duplicate'){
						$('#blog_category').focus();
						$('.message-duplicate').show().delay(3000).fadeOut(400);
					}

					endLoading(button, button_str);
				},
				error: function(response) {
					endLoading(button, button_str);
				},
			});
			return false;
		},
		invalidHandler: function() {
			endLoading(button, button_str);
		},
	});
	setTimeout(function() {
		$("#blogform").submit();
	}, 200);
	return false;
}

function deleteBlogCat($id){
	$('#dialog-confirm-delete-blog-cat').dialog({
		resizable: false,
		height: "auto",
		width: 400,
		modal: true,
		buttons: {
			"Delete": function(){
				$.ajax({
					type: 'POST',
					url: '/blogscontroller/deleteBlogCategory/'+$id,
					async: false,
					success: function(response){
						if(response=="success"){
							$('#dialog-confirm-delete-blog').dialog("close");
							$('.message-success').show().delay(3000).fadeOut(400);
							location.reload();
						}else{
							$('#dialog-confirm-delete-blog').dialog("close");
							$('.message-error').show().delay(3000).fadeOut(400);
						}
					}
				});
			},
			Cancel: function(){
				$(this).dialog("close");
			}
		}
	});
}