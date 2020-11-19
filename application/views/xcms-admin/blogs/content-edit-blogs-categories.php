	
	<script src="<?php echo base_url();?>assets/js/countries.js"></script>
	<div class="col-sm-8 col-md-9 col-lg-10 pull-right paddingtb30">
		<h1 class="inline-block margint0 marginb0 h1">Edit User</h1>
		<div class="content margint30">
			<div class="alert margintb15 secret alert-success message-success">Record successfully deleted.</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading margint0 marginb0 h4">Details</div>
						<div class="panel-body">
							<form name="blogform" id="blogform" class="blogform" method="post" enctype="multipart/form-data">
								<?php foreach ($loadBlogToEdit as $records) {?>
								<div class="form-group relative">
									<label>Title</label>
									<input type="text" name="blog_title" id="blog_title" class="form-control" value="<?php echo $records->blog_title; ?>" placeholder="Blog Title">
								</div>
								<div class="form-group relative">
									<label>Category</label>
									<select name="blog_category" class="form-control">
										<option value="-1">Please select</option>
										<?php											
											foreach ($allblogcategory as $blogcategory) {
												if($blogcategory->blog_category == $records->blog_category){
													$selected	= "selected";
													echo "<option value=\"".$blogcategory->blog_category."\"".$selected.">".$blogcategory->blog_category."</option>";
												}else{
													echo "<option value=\"".$blogcategory->blog_category."\">".$blogcategory->blog_category."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group relative">
									<label>Featured Image</label>
									<span class="block">Current Image: <br>
									<img class="img-fluid margintb15" src="<?php echo base_url(); ?>uploads/blogs/thumbs/<?php echo $records->blog_image_thumb; ?>"></span>
									<input type="file" name="blog_image" id="blog-image" class="btn btn-light" accept='image/*'>
								</div>
								<div class="form-group relative">
									<label>Content</label>
									<textarea class="textarea form-control clear" id="blog_post" name="blog_post"><?php echo $records->blog_post; ?></textarea>
								</div>
								<?php } ?>
								<div class="pull-right">
									<input type="hidden" name="blog_id" value="<?php echo $records->blog_id; ?>">
									<button type="button" class="btn btn-primary btn-save" onclick="updateBlog()">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="update-success" title="Success">
		<p>Record successfully updated redirecting you to main blogs page.</p>
	</div>
	<script>
		$(document).ready(function(){
			CKEDITOR.replace('blog_post');
		});
	</script>
