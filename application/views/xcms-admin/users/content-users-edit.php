	
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
							<form name="userform" id="userform" method="post">
								<?php foreach ($loadUsertoEdit as $records) {?>
								<div class="form-group relative">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?php echo $records->username; ?>" readonly>
								</div>
								<div class="form-group relative">
									<label>Password</label>
									<input type="password" name="password" class="form-control" value="" placeholder="Password">
								</div>
								<div class="form-group relative">
									<label>Verify Password</label>
									<input type="password" name="verifypassword" class="form-control" value="" placeholder="Verify Password">
								</div>
								<div class="form-group relative">
									<label>First Name</label>
									<input type="text" name="fname" class="form-control" value="<?php echo $records->fname; ?>" placeholder="First Name">
								</div>
								<div class="form-group relative">
									<label>Last Name</label>
									<input type="text" name="lname" class="form-control" value="<?php echo $records->lname; ?>" placeholder="Last Name">
								</div>
								<div class="form-group relative">
									<label>Email Address</label>
									<input type="text" name="email" class="form-control" value="<?php echo $records->email; ?>" placeholder="Email Address">
								</div>
								<div class="form-group relative">
									<label>Address</label>
									<input type="text" name="address" class="form-control" value="<?php echo $records->address; ?>" placeholder="Address">
								</div>
								<div class="form-group relative">
									<label>Country</label>
									<select id="country" name="country" class="form-control">
										<option value="<?php echo $records->country; ?>" selected><?php echo $records->country; ?></option>
									</select>
								</div>
								<div class="form-group relative">
									<label>State</label>
									<select name="state" id="state" class="form-control">
										<option value="<?php echo $records->state; ?>" selected><?php echo $records->state; ?></option>
									</select>
								</div>
								<div class="form-group relative">
									<label>Zip Code</label>
									<input type="text" name="zip_code" class="form-control" value="<?php echo $records->zip_code; ?>" placeholder="Zip Code">
								</div>
								<div class="form-group relative">
									<label>Date of Birth</label>
									<div class="row">
										<div class="col-xs-4 col-md-3 clear">
											<select id="month" class="form-control dob" name="month">
											</select>
										</div>
										<div class="col-xs-4 col-md-3">
											<select id="day" class="form-control dob" name="day">
											</select>
										</div>
										<div class="col-xs-4 col-md-3 year">
											<select id="year" class="form-control dob" name="year">
											</select>
										</div>
									</div>
								</div>
								<div class="form-group relative">
									<label>Status</label>
									<select name="status" class="form-control">
										<option value="-1">Please select</option>
										<?php
											$selected	= "selected";
											if($records->status == "Active"){												
												echo "<option value=\"Active\" ".$selected.">Active</option>";
												echo "<option value=\"Inactive\">Inactive</option>";
											}else{
												echo "<option value=\"Active\">Active</option>";
												echo "<option value=\"Inactive\" ".$selected.">Inactive</option>";
											}
										?>
									</select>
								</div>
								<div class="form-group relative">
									<label>User Type</label>
									<select name="type" class="form-control">
										<option value="-1">Please select</option>
										<?php
											foreach ($allusertypes as $recordOfUser) {
												if($recordOfUser->type == $records->type){
													$selected	= "selected";
													echo "<option value=\"".$recordOfUser->type."\"".$selected.">".$recordOfUser->type."</option>";
												}else{
													echo "<option value=\"".$recordOfUser->type."\">".$recordOfUser->type."</option>";
												}
											}
										?>
									</select>
									<input type="hidden" name="id" value="<?php echo $records->id; ?>">
									<div class="alert margint15 marginb0 secret alert-danger pass-error">Password did not match.</div>
								</div>
								<?php } ?>
								<div class="pull-right">
									<button type="button" class="btn btn-primary btn-save" onclick="updateUser()">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="update-user-success" title="Success">
		<p>Record successfully updated redirecting you to main users page.</p>
	</div>
	<script>
		$(document).ready(function(){
			populateCountries("country", "state");
		});
	</script>
