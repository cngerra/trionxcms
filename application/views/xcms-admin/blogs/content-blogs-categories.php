	<div class="col-sm-8 col-md-9 col-lg-10 pull-right paddingtb30">
		<h1 class="inline-block margint0 marginb0 h1">Blog Categories</h1>
		<button type="button" name="BlogWindow" class="btn btn-light source-sans-600 marginl15 launchBlogWindow" data-toggle="modal" data-target="#blogWindow">Add New</button>
		<div class="content margint30">
			<div class="alert margintb15 secret alert-success message-success">Blog Category successfully deleted.</div>
			<div class="alert margintb15 secret alert-danger message-error">Blog Category cannot be deleted.</div>
			<div class="panel panel-default margint20">
				<div class="panel-heading margint0 marginb0 h4">Categories</div>
				<div class="panel-body">
					
					<table class="table">
						<thead>
							<tr>
								<th align="center" width="2%"><input type="checkbox" value="" class="parent-checkbox" name="action"></th>
								<th align="center" width="25%">Name</th>
								<th align="center" width="43%">Description</th>
								<th align="center" width="10%">Status</th>
								<th align="center" width="20%">Actions</th>
							</tr>
						</thead>
						<tbody>

							<?php
								if(empty($loadBlogCategories)){
									echo "<tr>";
									echo "<td align=\"center\" colspan=\"7\"><strong>No Blog Categories</strong></td>";
									echo "</tr>";
								}else{
									foreach ($loadBlogCategories as $records) {
										echo "<tr>";
										echo "<td align=\"center\"><input type=\"checkbox\" value=\"".$records->blog_cat_id."\" class=\"checkbox\" name=\"action\"></td>";
										echo "<td>".$records->blog_category."</td>";
										echo "<td>".$records->blog_description."</td>";
										echo "<td>".$records->blog_cat_status."</td>";
										echo "<td><a href=\"blog-categories/edit/".$records->blog_cat_id."\" class=\"btn btn-info btn-edit\">Edit</a>&nbsp;<button value=\"".$records->blog_cat_id."\" onclick=\"deleteBlogCat(".$records->blog_cat_id.")\" class=\"btn btn-danger\">Delete</button></td>";
										echo "</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="blogWindow" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content border-radius-0">
				<form name="blogform" id="blogform" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title h4" id="blogModalLabel"></h4>
					</div>
					<div class="modal-body">
						<div class="form-group relative">
							<label>Category</label>
							<input type="text" name="blog_category" id="blog_category" class="form-control" value="" placeholder="Blog Category">
							<span id="slug" class="slug"></span>
						</div>
						<div class="form-group relative">
							<label>Category Image</label>
							<input type="file" name="blog_cat_image" id="blog-cat-image" class="btn btn-light" accept='image/*'>
						</div>
						<div class="form-group relative">
							<label>Description</label>
							<textarea class="textarea form-control clear" name="blog_description"></textarea>
							<div class="alert margint15 marginb0 secret alert-danger message-duplicate">Blog category name is already added. Please add a new one.</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light btn-close" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary btn-save" onclick="addNewBlogCat()">Save</button>
						<input type="hidden" name="base-url" id="base-url" value="<?php echo base_url(); ?>">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dialog-confirm-delete-blog-cat" class="secret" title="Delete Blog Category?">
		<p>Are you sure you want to delete this entry?</p>
	</div>
	<script>
		$(document).ready(function(){
			$(".launchBlogWindow").click(function(){
				$("#BlogWindow").modal('show');
				$("#blogModalLabel").html("Add New Blog Category");
			});

			//blog-slug
			$('#blog_category').change(function(){
				var $blog_category = $(this).val();
				createSlug($blog_category);
			});
		});
	</script>
