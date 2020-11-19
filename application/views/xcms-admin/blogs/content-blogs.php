				<div class="content margint30 clear">
					<div class="alert margintb15 secret alert-success message-success">Blog successfully deleted.</div>
					<div class="alert margintb15 secret alert-danger message-error">Blog cannot be deleted.</div>
					<div class="panel panel-default margint20">
						<div class="panel-heading margint0 marginb0 h4">All Blogs</div>
						<div class="panel-body">

							<table class="table">
								<thead>
									<tr>							
										<th align="center" width="2%">
											<input type="checkbox" name="action" value="" class="flat parent-checkbox">
										</th>
										<th align="center" width="15%">Featured Image</th>
										<th align="center" width="33%">Title</th>
										<th align="center" width="15%">Posted By</th>
										<th align="center" width="10%">Date Posted</th>
										<th align="center" width="10%">Status</th>
										<th align="center" width="20%">Actions</th>
									</tr>
								</thead>					
								<tbody>
									
									<?php
										if(empty($allblogs)){
											echo "<tr>";
											echo "<td align=\"center\" colspan=\"7\"><strong>No Blog Records</strong></td>";
											echo "</tr>";
										}else{
											foreach ($allblogs as $records) {
												echo "<tr>";
												echo "<td align=\"center\"><input type=\"checkbox\" value=\"".$records->blog_id."\" class=\"flat checkbox\" name=\"action\"></td>";
												echo "<td><img src=\"".base_url()."uploads/blogs/thumbs/".$records->blog_image_thumb."\" alt=\"\"></td>";
												echo "<td>".$records->blog_title."</td>";
												echo "<td>".$records->blog_posted_by."</td>";
												echo "<td>".$records->blog_date_posted."</td>";
												echo "<td>".$records->blog_status."</td>";
												echo "<td><a href=\"blogs/edit/".$records->blog_id."\" class=\"btn btn-info btn-edit\">Edit</a>&nbsp;<button value=\"".$records->blog_id."\" onclick=\"deleteBlog(".$records->blog_id.")\" class=\"btn btn-danger\">Delete</button></td>";
												echo "</tr>";
											}
										}	
									?>							
								</tbody>
							</table>
						</div>
					</div>
				</div>					
			</div><!--right_col-->
		</div><!--main_container-->
	</div><!--container body-->
	
					<!-- Modal -->
					<div class="modal fade" id="blogWindow" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content border-radius-0">
								<form name="blogform" id="blogform" class="blogform" method="post" enctype="multipart/form-data">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title h4" id="blogModalLabel"></h4>
								</div>
								<div class="modal-body">
									<div class="form-group relative">
										<label>Title</label>
										<input type="text" name="blog_title" id="blog_title" class="form-control" value="" placeholder="Blog Title">
										<span id="slug" class="slug"></span>
									</div>
									<div class="form-group relative">
										<label>Category</label>
										<select name="blog_category" class="form-control">
											<option value="-1">Please select</option>
											<?php
												foreach ($allblogcategory as $blogcategory) {
													echo "<option value=\"".$blogcategory->blog_category."\">".$blogcategory->blog_category."</option>";
												}
											?>
										</select>
									</div>
									<div class="form-group relative">
										<label>Featured Image</label>
										<input type="file" name="blog_image" id="blog-image" class="btn btn-light" accept='image/*'>
									</div>
									<div class="form-group relative">
										<label>Content</label>
										<textarea class="textarea form-control clear" id="blog_post" name="blog_post"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light btn-close" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary btn-save" onclick="addBlogEntry()">Save</button>
									<input type="hidden" name="base-url" id="base-url" value="<?php echo base_url(); ?>">
								</div>
								</form>
							</div>
						</div>
					</div>
					<script>
						// $(document).ready(function(){
						// 	$(".launchBlogWindow").click(function(){
						// 		$("#BlogWindow").modal('show');
						// 		$("#blogModalLabel").html("Add New Blog");
						// 	});

						// 	CKEDITOR.replace('blog_post');

						// 	timer = setInterval(updateDiv,100);
							
						// 	function updateDiv(){
						// 		var editorText = CKEDITOR.instances.blog_post.getData();
						// 		$('#blog_post').html(editorText);
						// 	}

						// 	//blog-slug
						// 	$('#blog_title').change(function(){
						// 		var $blog_title = $(this).val();
						// 		createSlug($blog_title);
						// 	});
							
						// });
					</script>